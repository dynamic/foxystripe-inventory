<?php

class FoxyStripeInventoryManager extends DataExtension
{
    /**
     * @var array
     */
    private static $db = [
        'ControlInventory' => 'Boolean',
        'PurchaseLimit' => 'Int',
        'EmbargoLimit' => 'Int',
    ];

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName(array(
            'PurchaseLimit',
            'EmbargoLimit',
            'NumberPurchased',
        ));

        $fields->addFieldsToTab('Root.Inventory', array(
            CheckboxField::create('ControlInventory', 'Control Inventory?')
                ->setDescription('limit the number of this product available for purchase'),
            DisplayLogicWrapper::create(
                NumericField::create('PurchaseLimit')
                    ->setTitle('Number Available')
                    ->setDescription('add to cart form will be disabled once number available equals purchased'),
                ReadonlyField::create('NumberPurchased', 'Purchased', $this->getNumberPurchased())//,
                /*
                NumericField::create('EmbargoLimit')
                    ->setTitle('Embargo Time')
                    ->setDescription('time in seconds to reserve an item once added to cart')
                */
            )->displayIf('ControlInventory')->isChecked()->end(),
        ));
    }

    /**
     * @return bool
     */
    public function getHasInventory()
    {
        return $this->owner->ControlInventory && $this->owner->PurchaseLimit != 0;
    }

    /**
     * @return bool
     */
    public function getIsProductAvailable()
    {
        if ($this->owner->getHasInventory()) {
            return $this->owner->PurchaseLimit > $this->getNumberPurchased();
        }
        return true;
    }

    public function getNumberAvailable()
    {
        if ($this->getIsProductAvailable()) {
            return (int)$this->owner->PurchaseLimit - (int)$this->getNumberPurchased();
        }

    }

    /**
     * @return int
     */
    public function getNumberPurchased()
    {
        $ct = 0;
        if ($this->getOrders()) {
            foreach ($this->getOrders() as $order) {
                $ct += $order->Quantity;
            }
        }

        return $ct;
    }

    /**
     * @return DataList
     */
    public function getOrders()
    {
        if ($this->owner->ID) {
            return OrderDetail::get()->filter('ProductID', $this->owner->ID);
        }
        return false;
    }
}

class FoxyStripeInventoryManagerExtension extends Extension
{
    /**
     * @param $form
     */
    public function updateFoxyStripePurchaseForm(&$form)
    {
        if (!$this->owner->getIsProductAvailable()) {
            $form = false;
            return;
        }

        if ($this->owner->getHasInventory()) {
            $quantityMax = $this->owner->getNumberAvailable();
            $count = 1;
            $quantity = array();
            while ($count <= $quantityMax) {
                $countVal = ProductPage::getGeneratedValue($this->owner->Code, 'quantity', $count, 'value');
                $quantity[$countVal] = $count;
                $count++;
            }
            $fields = $form->Fields();
            $fields->replaceField('quantity', DropdownField::create('quantity', 'Quantity', $quantity));
        }
    }
}