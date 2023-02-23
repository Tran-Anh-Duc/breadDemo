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
        $result_store = $this->storeRepository->getAllStore();
        $result['store'] = $result_store;
        return view('store.list_store',$result);
    }

    public function view_store()
    {
        return view('store.create_store');
    }

    public function create_store(Request $request)
    {
        $data = $request->all();
        $result = $this->storeRepository->createStore($data);
        return Controller::sendResponse(Controller::HTTP_OK,'Tạo mới cửa hàng thành công', $result);
    }

    public function find_one_store($id)
    {
        $result_detail = $this->storeRepository->findOneStore($id);
        $result['detail'] = $result_detail;
        $result['id'] = $id;
        return view('store.detail_store',$result);
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

    public function updateStatus($id)
    {
        $result = $this->storeRepository->update_status($id);
        return Controller::sendResponse(Controller::HTTP_OK,'Cập nhật trạng thái cửa hàng thành công',$result);
    }

//    public function test($storeId,Request $request)
//    {
//        $data = $request->all();
//        $result = $this->storeRepository->createProductAndStore($storeId,$data);
//        return $result;
//    }

//    public function test1($storeId,Request $request)
//    {
//        $data = $request->all();
//        $result = $this->storeRepository->test1($storeId,$data);
//        return $result;
//    }

    public function test2()
    {
        $result = $this->storeRepository->getAllDataStore();
        return $result;
    }



}
