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
        $result = $this->model->where([Store::COLUMN_STATUS_STORE => Store::COLUMN_STATUS_ACTIVE])->get();
        return $result;
    }

    public function createStore($data)
    {
        $data1 = [
            Store::COLUMN_STORE_NAME => $data['store_name'] ?? null,
            Store::COLUMN_STORE_ADDRESS => $data['store_address'] ?? null,
            Store::COLUMN_STATUS_STORE => Store::COLUMN_STATUS_BLOCK
        ];
    }
}
