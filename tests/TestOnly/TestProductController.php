<?php

namespace Dynamic\FoxyStripe\Test\TestOnly;

use Dynamic\FoxyStripe\ORM\FoxyStripeInventoryManagerExtension;
use Dynamic\FoxyStripe\Page\ProductPageController;
use SilverStripe\Dev\TestOnly;

/**
 * Class TestProductController
 * @package Dynamic\FoxyStripe\Test\TestOnly
 *
 * @mixin \Dynamic\FoxyStripe\ORM\FoxyStripeInventoryManager
 * @mixin \Dynamic\FoxyStripe\Page\ProductPage
 * @mixin FoxyStripeInventoryManagerExtension
 */
class TestProductController extends ProductPageController implements TestOnly
{
    /**
     * @var array
     */
    private static $extensions = [
        FoxyStripeInventoryManagerExtension::class
    ];
}
