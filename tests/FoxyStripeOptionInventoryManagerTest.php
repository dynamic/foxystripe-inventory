<?php

namespace Dynamic\FoxyStripe\Test;
use Dynamic\FoxyStripe\Test\TestOption;
use SilverStripe\Forms\FieldList;





class FoxyStripeOptionInventoryManagerTest extends FoxyStripeInventoryTest
{
    /**
     *
     */
    public function testUpdateCMSFields()
    {
        $object = $this->objFromFixture(TestOption::class, 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }
}