<?php

namespace Dynamic\FoxyStripe\Test\TestOnly;


use Dynamic\FoxyStripe\ORM\FoxyStripeInventoryManagerExtension;
use Dynamic\FoxyStripe\Page\ProductPageController;

class TestProductController extends ProductPageController
{
    /**
     * @var array
     */
    private static $extensions = [
        FoxyStripeInventoryManagerExtension::class
    ];
}