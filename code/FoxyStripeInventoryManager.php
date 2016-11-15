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
        $fields->addFieldsToTab('Root.Inventory', array(
            CheckboxField::create('ControlInventory', 'Control Inventory?')
                ->setDescription('limit the number of this product available for purchase'),
            NumericField::create('PurchaseLimit')
                ->setTitle('Number Available')
                ->setDescription('add to cart form will be disabled once number available equals purchased'),
            ReadonlyField::create('NumberPurchased', 'Purchased', $this->getNumberPurchased()),
            NumericField::create('EmbargoLimit')
                ->setTitle('Embargo Time')
                ->setDescription('time in seconds to reserve an item once added to cart'),
        ));
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

    /**
     * @return bool
     */
    public function getIsProductAvailable()
    {
        return $this->owner->ControlInventory && $this->owner->PurchaseLimit != 0 && $this->owner->PurchaseLimit < $this->getNumberPurchased();
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
        }
    }
}