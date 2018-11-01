<?php

namespace Dynamic\FoxyStripe\Test;

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
}