<?php


namespace App\Http\Controllers;


use App\Repository\StoreRepository;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function getAllStore()
    {
        $result = $this->storeRepository->getAllStore();
        return Controller::sendResponse(Controller::HTTP_OK,'find all succes', $result);
    }

    public function create_store(Request $request)
    {
        $data = $request->all();
        $result = $this->storeRepository->createStore($data);
        return Controller::sendResponse(Controller::HTTP_OK,'creat data store succes', $result);
    }

    public function find_one_store($id)
    {
        $result = $this->storeRepository->findOneStore($id);
        return Controller::sendResponse(Controller::HTTP_OK,'find one store succes',$result);
    }

    public function update_store(Request $request,$id)
    {
        $data = $request->all();
        $resultOneStore = $this->storeRepository->findOneStore($id);
        if ($resultOneStore['status_store'] == 1 || $resultOneStore['status_store'] == 2 ){
            $result =  $this->storeRepository->updateStore($data,$id);
            return Controller::sendResponse(Controller::HTTP_OK,'update store succes',$result);
        }else{
            return Controller::sendResponse(Controller::HTTP_OK,'update store error');
        }
    }



}
