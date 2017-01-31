<?php

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
        'TestProduct',
        'TestOption',
    ];
}

class TestProduct extends ProductPage implements TestOnly
{
    private static $extensions = ['FoxyStripeInventoryManager'];
}

class TestProduct_Controller extends ProductPage_Controller
{
    private static $extensions = ['FoxyStripeInventoryManagerExtension'];
}

class TestOption extends OptionItem implements TestOnly
{
    private static $extensions = ['FoxyStripeOptionInventoryManager'];
}