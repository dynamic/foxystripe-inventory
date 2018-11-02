## FoxyStripe Inventory Manager
The FoxyStripeInventoryManager should be applied to ProductPage or a subclass.
It will add an options to enable inventory control and add a purchase limit to the product.
```yml
Dynamic\FoxyStripe\Page\ProductPage
  extensions:
    - Dynamic\FoxyStripe\ORM\FoxyStripeInventoryManager
```

## FoxyStripe Inventory Manager Extension
The FoxyStripeInventoryManagerExtension should be applied to ProductPageController or  ssubclass.
When used in addition to FoxyStripeInventoryManager on ProductPage it will hide the purchase form if the product of out of stock.
```yml
Dynamic\FoxyStripe\Page\ProductPageController
  extensions:
    - Dynamic\FoxyStripe\ORM\FoxyStripeInventoryManagerExtension
```

## FoxyStripe Option Inventory Manager
The FoxyStripeOptionInventoryManager should be applied to OrderOption or a subclass.
It will add an options to enable inventory control and add a purchase limit to the product option.
```yml
Dynamic\FoxyStripe\Model\OrderOption
  extensions:
    - Dynamic\FoxyStripe\ORM\FoxyStripeOptionInventoryManager
```
