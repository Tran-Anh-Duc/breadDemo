<?php


namespace App\Repository;


use App\Models\Category;

class CategoryRepository extends BaseRepository
{
        public function getModel()
        {
           return Category::class;
        }

    public function getAllCategory()
    {
        $result = $this->model->where([Category::COLUMN_STATUS_CATEGORY => Category::COLUMN_STATUS_ACTIVE])->get();
        return $result;
    }

    public function createCategory($data)
    {
        $data1 = [
            Category::COLUMN_CATEGORY_NAME => $data->category_name,
            Category::COLUMN_CATEGORY_DESCRIPTION => $data->category_description,
            Category::COLUMN_STATUS_CATEGORY => Category::COLUMN_STATUS_BLOCK,
            Category::COLUMN_CATEGORY_IMAGE => $data->category_image
        ];
        $result = $this->model->create($data1);
        return $result;
    }

    public function getOne($id)
    {
        $result = $this->model->where([Category::COLUMN_ID => $id])->first();
    }

    public function updateCategory($data,$id)
    {
        $result = [];
        if (isset($data['category_name'])){
            $result[Category::COLUMN_CATEGORY_NAME] = $data['category_name'];
        }

        if (isset($data['category_description'])){
            $result[Category::COLUMN_CATEGORY_DESCRIPTION] = $data['category_description'];
        }

        if (isset($data['category_image'])){
            $result[Category::COLUMN_CATEGORY_IMAGE] = $data['category_image'];
        }

        if (empty($result)){
            return false;
        }

        $result_category = $this->model->where([Category::COLUMN_ID => $id])->update($result);
        return $result_category;
    }
}
