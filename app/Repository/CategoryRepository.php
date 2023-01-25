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
        $result = $this->model;
        $result = $result->whereIn(Category::COLUMN_STATUS_CATEGORY, [Category::COLUMN_STATUS_ACTIVE, Category::COLUMN_STATUS_BLOCK]);
        return $result->orderby(Category::CREATED_AT, 'DESC')
            ->paginate(4);
    }

    public function createCategory($data)
    {
        $data1 = [
            Category::COLUMN_CATEGORY_NAME => $data['name_category'] ?? null,
            Category::COLUMN_CATEGORY_DESCRIPTION => $data['category_description'] ?? null,
            Category::COLUMN_STATUS_CATEGORY => Category::COLUMN_STATUS_BLOCK ,
            Category::COLUMN_CATEGORY_IMAGE => $data['image'] ?? null
        ];
        $result = $this->model->create($data1);
        return $result;
    }



    public function updateCategory($data,$id)
    {
        $result = [];
        if (isset($data['name_category'])){
            $result[Category::COLUMN_CATEGORY_NAME] = $data['name_category'];
        }

        if (isset($data['category_description'])){
            $result[Category::COLUMN_CATEGORY_DESCRIPTION] = $data['category_description'];
        }

        if (isset($data['image'])){
            $result[Category::COLUMN_CATEGORY_IMAGE] = $data['image'];
        }

        if (empty($result)){
            return false;
        }

        $result_category = $this->model->where([Category::COLUMN_ID => $id])->update($result);
        return $result_category;

    }

    //update status product(cập nhật trạng thái của loại sản phẩm)
    public function update_status($id)
    {
        $result = $this->model->find($id);
        if (!empty($result) && $result['status'] == 1){
            $resultActive = $this->model->where([Category::COLUMN_ID => $id])->update([Category::COLUMN_STATUS_CATEGORY => Category::COLUMN_STATUS_ACTIVE ]);
        }elseif(!empty($result) && $result['status'] == 2){
            $resultActive = $this->model->where([Category::COLUMN_ID => $id])->update([Category::COLUMN_STATUS_CATEGORY => Category::COLUMN_STATUS_BLOCK ]);
        }
        return $resultActive;
    }

    public function getAllCate()
    {
         $result = $this->model->whereIn(Category::COLUMN_STATUS_CATEGORY, [Category::COLUMN_STATUS_ACTIVE, Category::COLUMN_STATUS_BLOCK])->get();
         return $result;
    }
}
