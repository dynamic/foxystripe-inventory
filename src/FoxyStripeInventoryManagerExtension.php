<?php

namespace Dynamic\FoxyStripe\ORM;

use Dynamic\FoxyStripe\Page\ProductPage;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HeaderField;

/**
 * Class FoxyStripeInventoryManagerExtension
 * @package Dynamic\FoxyStripe\ORM
 *
 * @property ProductPage|\Dynamic\FoxyStripe\ORM\FoxyStripeInventoryManager $owner
 */
class FoxyStripeInventoryManagerExtension extends Extension
{
    /**
     * @param \SilverStripe\Forms\Form $form
     */
    public function updateFoxyStripePurchaseForm(&$form)
    {
        if ($this->owner->Available && !$this->owner->getIsProductAvailable()) {
            $form->setFields(FieldList::create([
                HeaderField::create('OutOfStock', 'Currently Out of Stock', 4),
            ]));
            if ($submit = $form->Actions()->fieldByName('')) {
                $submit->setAttribute('Disabled', true);
            }
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
