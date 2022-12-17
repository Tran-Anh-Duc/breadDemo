<?php


namespace App\Models;


class Category extends BaseModel
{
    const COLUMN_CATEGORY_NAME = 'name_category';
    const COLUMN_CATEGORY_DESCRIPTION = 'category_description';
    const COLUMN_STORE_ID = 'store_id';
    const COLUMN_PRODUC_ID = 'product_id';
    const COLUMN_STATUS_CATEGORY = 'status';
    const COLUMN_CATEGORY_IMAGE = 'image';

    const COLUMN_STATUS_ACTIVE = 2;
    const COLUMN_STATUS_BLOCK = 1;


    protected $table = 'category';

    public function product()
    {
        return $this->belongsTo('App\product', Category::COLUMN_PRODUC_ID);
    }
}
