<?php


namespace App\Models;


class Store extends BaseModel
{
    const COLUMN_STORE_NAME = 'name_category';
    const COLUMN_STORE_ADDRESS = 'store_address';
    const COLUMN_STATUS_STORE = 'status';

    const COLUMN_STATUS_ACTIVE = 1;
    const COLUMN_STATUS_BLOCK = 2;


    protected $table = 'category';
}
