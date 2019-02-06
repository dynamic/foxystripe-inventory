<?php

namespace Dynamic\FoxyStripe\Test\TestOnly;

use Dynamic\FoxyStripe\ORM\FoxyStripeInventoryManager;
use Dynamic\FoxyStripe\Page\ProductPage;
use SilverStripe\Dev\TestOnly;

/**
 * Class TestProduct
 * @package Dynamic\FoxyStripe\Test\TestOnly
 *
 * @mixin \Dynamic\FoxyStripe\ORM\FoxyStripeInventoryManager
 */
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
