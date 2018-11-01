<?php

namespace Dynamic\FoxyStripe\Test;

use Dynamic\FoxyStripe\Model\OptionItem;
use Dynamic\FoxyStripe\Page\ProductPage;
use Dynamic\FoxyStripe\Page\ProductPageController;
use Dynamic\FoxyStripe\Test\TestProduct;
use Dynamic\FoxyStripe\Test\TestOption;
use SilverStripe\Dev\SapphireTest;
use Dynamic\FoxyStripe\ORM\FoxyStripeInventoryManager;
use SilverStripe\Dev\TestOnly;
use Dynamic\FoxyStripe\ORM\FoxyStripeInventoryManagerExtension;
use Dynamic\FoxyStripe\ORM\FoxyStripeOptionInventoryManager;

class FoxyStripeInventoryTest extends SapphireTest
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
        TestProduct::class,
        TestOption::class,
    ];
}

class TestProduct extends ProductPage implements TestOnly
{
    private static $extensions = [FoxyStripeInventoryManager::class];
}

class TestProduct_Controller extends ProductPageController
{
    private static $extensions = [FoxyStripeInventoryManagerExtension::class];
}

class TestOption extends OptionItem implements TestOnly
{
    private static $extensions = [FoxyStripeOptionInventoryManager::class];
}