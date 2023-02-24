<?php


namespace App\Models;


class Product extends BaseModel
{
    const COLUMN_PRODUCT_NAME = 'name_product';
    const COLUMN_PRODUCT_DESCRIPTION = 'product_description';
    const COLUMN_STORE_ID = 'store_id';
    const COLUMN_CATEGORY_ID = 'category_id';
    const COLUMN_STATUS_PRODUCT = 'status';
    const COLUMN_PRODUCT_IMAGE = 'image';
    const COLUMN_PRICE = 'price';
    const COLUMN_CLICK_ID = 'click_id';
    const COLUMN_TOTAL = 'total';
    const COLUMN_WAREHOUSE_ID = 'warehouse_id';

    const COLUMN_STATUS_ACTIVE = 2;
    const COLUMN_STATUS_BLOCK = 1;


    protected $table = 'product';

    public function category()
    {
        return $this->hasMany('App\category',Product::COLUMN_CATEGORY_ID);
    }

    public function stores()
    {
         return $this->belongsToMany(Store::class);
    }

    public function bills()
    {
        return $this->belongsToMany(bill::class)->withPivot('total','price')->withTimestamps();
    }





}
