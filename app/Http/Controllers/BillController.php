<?php


namespace App\Http\Controllers;


use App\Repository\BillRepository;
use App\Repository\StoreRepository;
use Illuminate\Http\Request;

class BillController extends Controller
{
    protected $billRepository;
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository,BillRepository $billRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->billRepository = $billRepository;
    }

    public function create_bill_product(Request $request)
    {
        $data = $request->all();
        $result = $this->billRepository->createBill($data);
        return Controller::sendResponse(Controller::HTTP_OK,'succes',$result);
    }

    public function show_bill($bill_id)
    {
        $result['showBill'] = $this->billRepository->showBill($bill_id);
        return $result;
        //return Controller::sendResponse(Controller::HTTP_OK,'succes',$result);
    }

    public function delete_bill($bill_id)
    {
        $result = $this->billRepository->deleteBill($bill_id);
        return $result;
    }


    public function updateStore($id)
    {
        $result = $this->billRepository->updateProductStore($id);
        return $result;
    }

    public function get_all_data_bill()
    {
        $resultList = $this->billRepository->getAllDataBill();
        $result['resultList'] = $resultList;
        return view('bill.list_bill',$result);
    }

    public function view_detail_bill($id)
    {
        $result['findOneBill'] = $this->billRepository->find($id);
        $result['showBill'] = $this->billRepository->showBill($id);
        $result['id'] = $id;
        return view('bill.detail_one_bill',$result);
    }


}
