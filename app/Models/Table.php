<?php


namespace App\Models;


class Table extends BaseModel
{
    const COLUMN_NUMBER_TABLE = 'number_table';
    const COLUMN_IMAGE_TABLE = 'image_table';
    const COLUMN_COLOR_TABLE = 'color_table';
    const COLUMN_STATUS = 'status';

    const COLUMN_STATUS_ACTIVE = 2;
    const COLUMN_STATUS_BLOCK = 1;

    const COLUMN_COLOR_ACTIVE = 2;
    const COLUMN_COLOR_BLOCK = 1;
}
