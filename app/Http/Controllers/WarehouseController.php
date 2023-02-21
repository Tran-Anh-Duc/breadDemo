<?php


namespace App\Http\Controllers;


use App\Repository\WarehouseRepository;
use Illuminate\Http\Request;

class WarehouseController extends  Controller
{
    protected $warehouseRepository;

    public function __construct(WarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function test()
    {
        return $test = $this->warehouseRepository->getAllData();
    }

    public function createWarehouse(Request $request)
    {
        $data = $request->all();
        $result = $this->warehouseRepository->createWarehouse($data);
        return Controller::sendResponse(Controller::HTTP_OK,'create success',$result);
    }

}
