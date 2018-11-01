<?php

namespace Dynamic\FoxyStripe\ORM;

use Dynamic\FoxyStripe\Page\ProductPage;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\DropdownField;

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