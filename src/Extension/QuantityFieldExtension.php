<?php

namespace Dynamic\FoxyStripe\Extension;


use SilverStripe\Core\Extension;

/**
 * Class QuantityFieldExtension
 * @package Dynamic\FoxyStripe\Extension
 *
 * @property-read \Dynamic\FoxyStripe\Form\QuantityField|\Dynamic\FoxyStripe\Extension\QuantityFieldExtension $owner
 */
class QuantityFieldExtension extends Extension
{

    public function onBeforeRender() {
        if (!$this->owner->getProduct()->getHasInventory()) {
            return;
        }
        $this->owner->setAttribute(
            'data-limit',
            $this->owner->getProduct()->getNumberAvailable()
        );
    }

    /**
     * @param $value
     */
    public function updateValue(&$value)
    {
        if (!$this->owner->getProduct()->getHasInventory()) {
            return;
        }

        if ($value >= $this->owner->getProduct()->getNumberAvailable()) {
            $value = $this->owner->getProduct()->getNumberAvailable();
        }
    }
}
