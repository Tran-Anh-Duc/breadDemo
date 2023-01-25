<?php


namespace App\Repository;


use App\Models\News;

class NewsRepository extends BaseRepository
{

    public function getModel()
    {
        return News::class;
    }


    public function createNews($data)
    {
        $data1 = [
          News::COLUMN_NEWS_NAME => $data['news_name'] ?? null,
          News::COLUMN_NEWS_DESCRIPTION => $data['news_description'] ?? null,
          News::COLUMN_STATUS => News::COLUMN_STATUS_BLOCK,
          News::COLUMN_IMAGE => $data['image'],
        ];
        $result = $this->model->create($data1);
        return $result;
    }


    public function getAll()
    {
        $result = $this->model->get()->toArray();
        return $result;
    }

}
