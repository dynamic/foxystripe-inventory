<?php

namespace Dynamic\FoxyStripe\Extension;

use Dynamic\FoxyStripe\Model\ProductCartReservation;
use Dynamic\FoxyStripe\Page\ProductPage;
use SilverStripe\Core\Extension;
use SilverStripe\Dev\Debug;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\HiddenField;

/**
 * Class ProductFormExtension
 * @package Dynamic\Sheeps\ProductCartExpiry\Extension
 */
class PurchaseFormExtension extends Extension
{
    public function updatePurchaseFormFields(FieldList $fields)
    {
        if ($this->owner->getProduct()->CartExpiration) {
            $fields->insertBefore(
                'quantity',
                HiddenField::create('expires')
                    ->setValue(
                        ProductPage::getGeneratedValue(
                            $this->owner->getProduct()->Code,
                            'expires',
                            $this->owner->getProduct()->ExpirationMinutes,
                            'value'
                        )
                    )
            );
        }
    }

    /**
     * @param FieldList $fields
     */
    public function updateFoxyStripePurchaseFormActions(FieldList $fields)
    {
        if ($this->owner->getProduct()->ControlInventory) {
            $reserved = ProductCartReservation::get()
                ->filter([
                    'Code' => $this->owner->getProduct()->Code,
                    'Expires:GreaterThan' => date('Y-m-d H:i:s', strtotime('now')),
                ])->count();
            $sold = $this->owner->getProduct()->getNumberPurchased();

            if ($reserved + $sold >= $this->owner->getProduct()->PurchaseLimit) {
                $fields->replaceField(
                    'action_',
                    HeaderField::create('OutOfStock', 'Out of stock')
                        ->setHeadingLevel(3)
                );
            }
        }
    }
}
