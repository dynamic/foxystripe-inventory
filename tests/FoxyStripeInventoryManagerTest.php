<?php

class FoxyStripeInventoryManagerTest extends SapphireTest
{
    /**
     * @var array
     */
    protected static $fixture_file = array(
        'foxystripe-inventory/tests/fixtures.yml',
    );

    /**
     * @var array
     */
    protected $extraDataObjects = [
        'TestProduct',
    ];

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

class TestProduct extends ProductPage implements TestOnly
{
    private static $extensions = ['FoxyStripeInventoryManager'];
}

class TestProduct_Controller extends ProductPage_Controller
{
    private static $extensions = ['FoxyStripeInventoryManagerExtension'];
}