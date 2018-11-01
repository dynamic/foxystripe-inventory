<?php

namespace Dynamic\FoxyStripe\Test\TestOnly;

use Dynamic\FoxyStripe\Model\OptionItem;
use Dynamic\FoxyStripe\ORM\FoxyStripeOptionInventoryManager;
use SilverStripe\Dev\TestOnly;

class TestOption extends OptionItem implements TestOnly
{
    /**
     * @var string
     */
    private static $table_name = 'FSITestOption';

    /**
     * @var array
     */
    private static $extensions = [
        FoxyStripeOptionInventoryManager::class
    ];
}
