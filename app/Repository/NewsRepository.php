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
        $result = $this->model;
        $result = $result->whereIn(News::COLUMN_STATUS, [News::COLUMN_STATUS_ACTIVE, News::COLUMN_STATUS_BLOCK]);

        return $result->orderBy(News::COLUMN_ID,self::DESC)
                      ->paginate(5);
    }

    public function updateNews($data,$id)
    {
        $result = [];
        if (isset($data['news_name'])){
            $result[News::COLUMN_NEWS_NAME] = $data['news_name'];
        }
        if (isset($data['news_description'])){
            $result[News::COLUMN_NEWS_DESCRIPTION] = $data['news_description'];
        }

        if (empty($result)){
            return false;
        }

        $resultNews = $this->model->where([News::COLUMN_ID => $id])->update($result);
        return  $resultNews;
    }

    public function updateStatus($id)
    {
        $result = $this->model->find($id);
        if (!empty($result) && $result['status'] == 1){
            $resultActive = $this->model->where([News::COLUMN_ID => $id])->update([News::COLUMN_STATUS => News::COLUMN_STATUS_ACTIVE]);
        }elseif(!empty($result) && $result['status'] == 2){
            $resultActive = $this->model->where([News::COLUMN_ID => $id])->update([News::COLUMN_STATUS => News::COLUMN_STATUS_BLOCK]);
        }
        return $resultActive;
    }

    public function getAllDatanew()
    {
        $result = $this->model;
        $result = $result->whereIn(News::COLUMN_STATUS, [News::COLUMN_STATUS_ACTIVE]);

        return $result->orderBy(News::COLUMN_ID,self::DESC)
            ->get();
    }


}
