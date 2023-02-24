<?php


namespace App\Repository;


use App\Models\bill;

class billRepository extends  BaseRepository
{
    protected $billRepository;

    public function getModel()
    {
        return bill::class;
    }


}
