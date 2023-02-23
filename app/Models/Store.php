<?php


namespace App\Models;


class Store extends BaseModel
{
    const COLUMN_STORE_NAME = 'store_name';
    const COLUMN_STORE_ADDRESS = 'store_address';
    const COLUMN_STATUS_STORE = 'status_store';

    const COLUMN_STATUS_ACTIVE = 2;
    const COLUMN_STATUS_BLOCK = 1;


    protected $table = 'store';

    public function products()
    {
         return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
