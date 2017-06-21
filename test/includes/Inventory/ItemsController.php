<?php

namespace Waredesk\Tests\Inventory;

use Waredesk\Models\Inventory\Item;
use Waredesk\Tests\BaseTest;

class ItemsController
{
    /**
     * @var BaseTest
     */
    protected $baseTest;

    public function __construct(BaseTest $baseTest)
    {
        $this->baseTest = $baseTest;
    }

    public function createItem()
    {
        $defaultProduct = $this->baseTest->productsController->getDefaultProduct();

        $item = new Item();
        $item->setVariant($defaultProduct->getVariants()->first()->getId());

        $attribute = new Item\Attribute();
        $attribute->setItemAttribute($defaultProduct->getVariants()->first()->getItemsAttributes()->first()->getId());
        $attribute->setValue('override value');
        $item->getAttributes()->add($attribute);

        return $item;
    }
}
