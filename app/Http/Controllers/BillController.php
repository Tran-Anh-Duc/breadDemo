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

    public function show_bill($id)
    {

        $result['showBill'] = $this->billRepository->showBill();
        return Controller::sendResponse(Controller::HTTP_OK,'succes',$result);
    }


}
