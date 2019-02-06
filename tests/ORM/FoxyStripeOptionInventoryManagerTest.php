<?php

namespace Dynamic\FoxyStripe\Test;

use Dynamic\FoxyStripe\Model\OptionItem;
use Dynamic\FoxyStripe\Model\Order;
use Dynamic\FoxyStripe\Model\OrderDetail;
use Dynamic\FoxyStripe\Test\TestOnly\TestOption;
use Dynamic\FoxyStripe\Test\TestOnly\TestProduct;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class FoxyStripeOptionInventoryManagerTest extends SapphireTest
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
        $object = $this->objFromFixture(TestOption::class, 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }

    /**
     *
     */
    public function testGetHasInventory()
    {
        /** @var TestOption $option */
        $option = $this->objFromFixture(TestOption::class, 'one');

        $option->ControlInventory = false;
        $option->PurchaseLimit = 0;
        $this->assertFalse($option->getHasInventory());

        $option->ControlInventory = true;
        $option->PurchaseLimit = 0;
        $this->assertFalse($option->getHasInventory());

        $option->ControlInventory = false;
        $option->PurchaseLimit = 10;
        $this->assertFalse($option->getHasInventory());

        $option->ControlInventory = true;
        $option->PurchaseLimit = 10;
        $this->assertTrue($option->getHasInventory());
    }

    /**
     *
     */
    public function testGetIsOptionAvailable()
    {
        /** @var TestOption $option */
        $option = $this->objFromFixture(TestOption::class, 'one');
        $option->write();

        // no inventory control
        $option->ControlInventory = false;
        $option->PurchaseLimit = 0;
        $this->assertTrue($option->getIsOptionAvailable());

        // inventory control, no limit
        $option->ControlInventory = true;
        $option->PurchaseLimit = 0;
        $this->assertTrue($option->getIsOptionAvailable());

        // inventory control, with limit
        $option->ControlInventory = true;
        $option->PurchaseLimit = 10;
        $this->assertTrue($option->getIsOptionAvailable());

        /** @var OrderDetail $detail */
        $detail = OrderDetail::create();
        $detail->Quantity = 10;
        $detail->write();
        $detail->OptionItems()->add($option);

        // inventory control, no inventory left
        $option->ControlInventory = true;
        $option->PurchaseLimit = 10;
        $this->assertFalse($option->getIsOptionAvailable());
    }

    /**
     *
     */
    public function testGetNumberPurchased()
    {
        /** @var TestOption $option */
        $option = $this->objFromFixture(TestOption::class, 'one');
        $option->write();

        $this->assertEquals(0, $option->getNumberPurchased());

        /** @var OrderDetail $detail */
        $detail = OrderDetail::create();
        $detail->Quantity = 10;
        $detail->write();
        $detail->OptionItems()->add($option);

        $this->assertEquals(10, $option->getNumberPurchased());
    }

    /**
     *
     */
    public function testGetOrders()
    {
        /** @var TestOption $option */
        $option = $this->objFromFixture(TestOption::class, 'one');
        $option->write();

        $this->assertEquals(0, $option->getOrders()->Count());

        /** @var OrderDetail $detail */
        $detail = OrderDetail::create();
        $detail->Quantity = 10;
        $detail->write();
        $detail->OptionItems()->add($option);

        echo 'Detail Count: ' . print_r(OrderDetail::get()->Count(), true);

        $this->assertEquals(1, $option->getOrders()->Count());
    }
}
