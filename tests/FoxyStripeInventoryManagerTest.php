<?php

namespace Dynamic\FoxyStripe\Test;

use Dynamic\FoxyStripe\Test\TestProduct;
use SilverStripe\Forms\FieldList;

class FoxyStripeInventoryManagerTest extends FoxyStripeInventoryTest
{
    /**
     *
     */
    public function testUpdateCMSFields()
    {
        $object = $this->objFromFixture(TestProduct::class, 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
        $this->assertNotNull($fields->dataFieldByName('ControlInventory'));
    }

    /**
     *
     */
    public function testFoxyStripePurchaseForm()
    {
        $object = $this->objFromFixture(TestProduct::class, 'one');
        $controller = new TestProduct_Controller($object);
        $this->assertFalse($controller->PurchaseForm());
    }
}