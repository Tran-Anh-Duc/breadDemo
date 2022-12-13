<?php


namespace App\Repository;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function getModel()
    {
       return Product::class;
    }
//lấy tất cả các sản phẩm
    public function getAllDataProduct()
    {
        $result = $this->model->where([Product::COLUMN_STATUS_PRODUCT => Product::COLUMN_STATUS_ACTIVE])->get()->toArray();
        return $result;
    }
//tạo sản phẩm mới
    public function createProduct($data)
    {
        $data1 = [
            Product::COLUMN_PRODUCT_NAME => $data['name_product'] ?? null,
            Product::COLUMN_PRODUCT_DESCRIPTION => $data['product_description'] ?? null,
            Product::COLUMN_PRODUCT_IMAGE => $data['image'] ?? null,
            Product::COLUMN_STATUS_PRODUCT => Product::COLUMN_STATUS_BLOCK,
            Product::COLUMN_STORE_ID => $data['store_id'] ?? null,
            Product::COLUMN_CATEGORY_ID => $data['category_id'] ?? null,
        ];
        $result = $this->model->create($data1);
        return $result;
    }
//chi tiết 1 sản phẩm
//update 1 sản phẩm
    public function updateProduct($data,$id)
    {
        $ressult = [];
        $bool = false;
        $findProduct = $this->find($id);
        if (isset($data['name_product'])){
            $ressult[Product::COLUMN_PRODUCT_NAME] = $data['name_product'];
        }
        if (isset($data['product_description'])) {
            $ressult[Product::COLUMN_PRODUCT_DESCRIPTION] = $data['product_description'];
        }
        if (isset($data['image'])) {
            $ressult[Product::COLUMN_PRODUCT_IMAGE] = $data['image'];
        }
        if (isset($data['category_id'])) {
            $ressult[Product::COLUMN_CATEGORY_ID] = $data['category_id'];
        }
        if (isset($data['store_id'])) {
            $ressult[Product::COLUMN_STORE_ID] = $data['store_id'];
        }

        if (empty($ressult)){
            $bool = false;
        }
        if ($findProduct['status'] == 2){
            $result_product = $this->model->update([Product::COLUMN_ID => $id],$ressult);
            $bool = true;
        }else{
             $bool = false;
        }
        return  $bool;
    }

}
