<?php

namespace Dynamic\FoxyStripe\Test\TestOnly;

use Dynamic\FoxyStripe\ORM\FoxyStripeInventoryManager;
use Dynamic\FoxyStripe\Page\ProductPage;
use SilverStripe\Dev\TestOnly;

class TestProduct extends ProductPage implements TestOnly
{
    /**
     * @var string
     */
    private static $table_name = 'FSITestProduct';

    /**
     * @var array
     */
    private static $extensions = [
        FoxyStripeInventoryManager::class
    ];
}