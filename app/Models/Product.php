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

    const COLUMN_STATUS_ACTIVE = 1;
    const COLUMN_STATUS_BLOCK = 2;


    protected $table = 'product';
}
