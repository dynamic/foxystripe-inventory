<?php

class FoxyStripeOptionInventoryManagerTest extends FoxyStripeInventoryTest
{
    /**
     *
     */
    public function testUpdateCMSFields()
    {
        $object = $this->objFromFixture('TestOption', 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
    }
}