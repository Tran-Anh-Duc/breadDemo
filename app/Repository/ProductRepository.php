<?php


namespace App\Repository;


use App\Models\Category;
use App\Models\Product;
use App\Models\Store;

class ProductRepository extends BaseRepository
{
    protected $product;
    protected $category;
    protected $store;

    public function __construct(Product $product,Category $category,Store $store)
    {
          $this->product = $product;
          $this->product = $category;
          $this->product = $store;
    }

    public function getAllDataProduct()
    {
        $result = $this->product->where([Product::COLUMN_STATUS_PRODUCT => Product::COLUMN_STATUS_ACTIVE])->get()->toArray();
        return $result;
    }
}
