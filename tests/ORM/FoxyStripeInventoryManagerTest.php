<?php

namespace Dynamic\FoxyStripe\Test;

use Dynamic\FoxyStripe\Test\TestOnly\TestOption;
use Dynamic\FoxyStripe\Test\TestOnly\TestProduct;
use Dynamic\FoxyStripe\Test\TestOnly\TestProductController;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;

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
     * @var array
     */
    protected static $extra_controllers = [
        TestProductController::class,
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
        /** @var TestProduct $object */
        $object = $this->objFromFixture(TestProduct::class, 'one');
        /** @var TestProductController $controller */
        $controller = TestProductController::create($object);
        $form = $controller->PurchaseForm();
        $this->assertInstanceOf(Form::class, $form);
    }
}
