<?php


namespace App\Models;


class Warehouse extends BaseModel
{
    const COLUMN_PRODUCT_ID = 'product_id';
    const COLUMN_QUANTITY = 'quantity';
    const COLUMN_WAREHOUSE_NAME = 'warehouse_name';


    protected $table = 'warehouses';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
