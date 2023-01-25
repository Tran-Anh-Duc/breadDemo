<?php


namespace App\Models;


class News extends BaseModel
{
    protected $table = 'news';

    const COLUMN_NEWS_NAME = 'news_name';
    const COLUMN_NEWS_DESCRIPTION = 'news_description';
    const COLUMN_STATUS = 'status';
    const COLUMN_IMAGE = 'image';

    const COLUMN_STATUS_ACTIVE = 2;
    const COLUMN_STATUS_BLOCK = 1;
}
