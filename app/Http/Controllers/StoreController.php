<?php


namespace App\Http\Controllers;


use App\Repository\StoreRepository;

class StoreController extends Controller
{
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }


}
