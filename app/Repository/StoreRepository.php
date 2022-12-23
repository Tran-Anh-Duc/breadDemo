<?php


namespace App\Repository;


use App\Models\Store;

class StoreRepository extends BaseRepository
{
    public function getModel()
    {
        return Store::class;
    }

    public function getAllStore()
    {
        $result = $this->model;
        $result->whereIn(Store::COLUMN_STATUS_STORE,[Store::COLUMN_STATUS_BLOCK,Store::COLUMN_STATUS_BLOCK]);
        return $result->orderby(Store::CREATED_AT,'DESC')->paginate(4);
    }

    public function createStore($data)
    {
        $data1 = [
            Store::COLUMN_STORE_NAME => $data['store_name'] ?? null,
            Store::COLUMN_STORE_ADDRESS => $data['store_address'] ?? null,
            Store::COLUMN_STATUS_STORE => Store::COLUMN_STATUS_BLOCK
        ];

        $result = $this->model->create($data1);
        return $result;
    }

    public function findOneStore($id)
    {
        $result = $this->model->where([Store::COLUMN_ID => $id])->first()->toArray();
        return $result;
    }

    public function updateStore($data,$id)
    {
        $result = [];
        if (isset($data['store_name'])){
            $result[Store::COLUMN_STORE_NAME] = $data['store_name'];
        }

        if (isset($data['store_address'])){
            $result[Store::COLUMN_STORE_ADDRESS] = $data['store_address'];
        }

        if (empty($result)){
            return false;
        }

        $result_update_store = $this->model
            ->whereIn(Store::COLUMN_STATUS_STORE, [1, 2])
            ->where([Store::COLUMN_ID => $id])
            ->update($result);
        return  $result_update_store;
    }
}
