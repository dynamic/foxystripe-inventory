<?php

class FoxyStripeInventoryManagerTest extends FoxyStripeInventoryTest
{
    /**
     *
     */
    public function testUpdateCMSFields()
    {
        $object = $this->objFromFixture('TestProduct', 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
        $this->assertNotNull($fields->dataFieldByName('ControlInventory'));
    }

    /**
     *
     */
    public function testFoxyStripePurchaseForm()
    {
        $object = $this->objFromFixture('TestProduct', 'one');
        $controller = new TestProduct_Controller($object);
        $this->assertFalse($controller->PurchaseForm());
    }
}