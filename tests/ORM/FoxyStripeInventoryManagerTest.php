<?php

namespace Dynamic\FoxyStripe\Test;

use Dynamic\FoxyStripe\Test\TestOnly\TestOption;
use Dynamic\FoxyStripe\Test\TestOnly\TestProduct;
use Dynamic\FoxyStripe\Test\TestOnly\TestProductController;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\HeaderField;

class FoxyStripeInventoryManagerTest extends SapphireTest
{
    /**
     * @var array
     */
    protected static $fixture_file = array(
        '../fixtures.yml',
    );

    /**
     * @var array
     */
    protected static $extra_dataobjects = [
        TestProduct::class,
        TestOption::class,
    ];

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
        $controller = new TestProductController($object);
        $form = $controller->PurchaseForm();
        $this->assertInstanceOf(Form::class, $form);
    }
}
