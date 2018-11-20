<?php

namespace Dynamic\FoxyStripe\Extension;

use Dynamic\FoxyStripe\Page\ProductPage;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
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
}
