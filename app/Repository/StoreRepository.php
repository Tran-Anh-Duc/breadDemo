<?php


namespace App\Repository;


use App\Models\Store;

class StoreRepository extends BaseRepository
{
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Store::class;
    }
}
