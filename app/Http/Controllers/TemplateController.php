<?php


namespace App\Http\Controllers;


use App\Models\Product;
use App\Repository\BillRepository;
use App\Repository\CategoryRepository;
use App\Repository\NewsRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use App\Repository\TableRepository;
use http\Exception;
use Illuminate\Http\Request;
class TemplateController extends Controller
{
    protected $productRepository;
    protected $storeRepository;
    protected $categoryRepository;
    protected $newsRepository;
    protected $tableRepository;
    protected $billRepository;

    public function __construct(ProductRepository $productRepository,StoreRepository $storeRepository,CategoryRepository $categoryRepository,
                                NewsRepository $newsRepository,TableRepository $tableRepository,BillRepository $billRepository)
    {
        $this->productRepository = $productRepository;
        $this->storeRepository = $storeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->newsRepository = $newsRepository;
        $this->tableRepository = $tableRepository;
        $this->billRepository = $billRepository;
    }

    public function allProduct(Request $request)
    {
        $data = $request->all();
        $user = session()->get('user');
        $result['loginUser'] = !empty($user) ? $user->email : '';
        $resultAll = $this->productRepository->getAllDataProduct($data);
        $result['all_product'] = $resultAll;
        $result['user'] = $user;
        $resultClick = $this->productRepository->getDataCLick();
        $result['resultClick'] = $resultClick;
        $resultCategory = $this->categoryRepository->getAllCate()->toArray();
        $result['resultCategory']  = $resultCategory;
        $resultNews = $this->newsRepository->getAllDatanew();
        $result['news'] = $resultNews;
        return View('card.product_list',$result);
    }


    public function searchLikeProduct(Request $request)
    {
        $data = $request->all();
        $id = !empty($data['id']) ? $data['id'] : "";
        $resultAll = $this->productRepository->getAllDataProductLike($data);
        $result['all_product'] = $resultAll;
        return View('master',$result);
    }

    public function view_card()
    {
        $card = session()->get('card');
        $resultUser = session()->get('user');
        $loginUser = !empty($resultUser) ? $resultUser->email : '';
        return view('card.card',compact("card","loginUser"));
    }

    public function add_to_card($id)
    {
        $card = session()->get('card');
        $product = $this->productRepository->find($id);
        if (isset($card[$id])){
            $card[$id]['quantity'] = $card[$id]['quantity'] + 1;
        }else{
            $card[$id] = [
                'name_product' => $product['name_product'],
                'price' => $product['price'],
                'quantity' => 1,
                'product_id' => $id
            ];
        }
        $a = session()->put('card',$card);
        return Controller::sendResponse(Controller::HTTP_OK,'create card succes');
    }

    public function updateCard(Request $request)
    {
        if ($request->id && $request->quantity){
            $cards = session()->get('card');
            $cards[$request->id]['quantity'] = $request->quantity;
            session()->put('card',$cards);
            $cards = session()->get('card');
            $cardView = view('card.card',compact("cards"))->render();
            return Controller::sendResponse(Controller::HTTP_OK,'update card succes',$cardView);
        }
    }

    public function removeCard(Request $request)
    {
        if ($request->id){
            $cards = session()->get('card');
            unset($cards[$request->id]);
            session()->put('card',$cards);
            $cards = session()->get('card');
            $cardView = view('card.card',compact("cards"))->render();
            return Controller::sendResponse(Controller::HTTP_OK,'update card succes',$cardView);
        }
    }

    public function detailProduct($id)
    {
        $result = $this->productRepository->find($id);
        if (!empty($result)){
            $click = $result['click_id'] + 1;
            $this->productRepository->update($id,[Product::COLUMN_CLICK_ID => $click]);
        }
        return view('card.detailProduct',compact('result'));
    }
//
    public function viewTable()
    {
        $export = true;
        $resultTable = $this->tableRepository->getAllTable($export);
        $result['resultTable'] = $resultTable;
        return view('card.openCardTable',$result);
    }
//
    public function detailTable($id,Request $request)
    {
        $data = $request->all();
        $resultTable = $this->tableRepository->findOneTable($id);
        $result['resultTable'] = $resultTable;
        $resultProduct = $this->productRepository->getAllDataProduct($data);
        $result['resultProduct'] = $resultProduct;
        $result['resultTable'] = $resultTable;
        $tableName = "table-" . $id;
        $cardTable = session()->get($tableName) ?? [];
        $result['cardTable'] = $cardTable;
//        echo("<pre>");
//        print_r($cardTable);
//        echo("<pre>");
//        die();
        $result['idTable'] = $id;
//        session()->flush();
        return view('card.detailTable',$result);
    }
//
    public function addCardTable($idProduct,$idTable)
    {
        $tableName = "table-" . $idTable;
        //$order = session()->get($tableName) ?? [];
        $cardTable = session()->get($tableName) ?? [];
        //$cardTable = session()->get('cardTable');
        $product = $this->productRepository->find($idProduct);
        if (isset($cardTable[$idProduct])) {
            $cardTable[$idProduct]['quantity'] = $cardTable[$idProduct]['quantity'] + 1;
        } else {
            $cardTable[$idProduct] = [
                'idProduct' => $idProduct,
                'name_product' => $product['name_product'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
        session()->put($tableName,$cardTable);
        return Controller::sendResponse(Controller::HTTP_OK,'create card succes');
    }

    public function updateCardTable($idTable,Request $request)
    {
        $data = $request->all();
//        if (!empty($data)){
//            $this->billRepository->updateCardTableId($idTable,$data);
//        }else{
//            return Controller::sendResponse(Controller::HTTP_BAD_REQUEST,'create card error');
//        }
//        return Controller::sendResponse(Controller::HTTP_OK,'create card succes');


        $tableName = "table-" . $idTable;
        if (!empty($data)) {
            $cardTable = session()->get($tableName) ?? [];
            if (!empty($data['data'])){
                foreach ($data['data'] as $key => $value) {
                    $a = $cardTable[$value['id']];
                    $checkIdProduct = $cardTable[$value['id']]['idProduct'];
                    $checkQuantity = $cardTable[$value['id']]['quantity'];
                    if ($value['id'] == $checkIdProduct) {
                        $checkQuantity = $value['quantity'];
                    }
                    $cardTable[$value['id']] = [
                        'idProduct' => $a['idProduct'],
                        'name_product' => $a['name_product'],
                        'price' => $a['price'],
                        'quantity' => $checkQuantity
                    ];
                }
            }else{
                return Controller::sendResponse(Controller::HTTP_BAD_REQUEST,'update card error');
            }

            session()->put($tableName, $cardTable);
        }
        session()->has($tableName);

        return Controller::sendResponse(Controller::HTTP_OK,'update card succes');

    }

    public function paymentOneTable($idTable)
    {
          $tableName = 'table-' . $idTable;
          $delete = session()->forget($tableName);
          $result = $this->tableRepository->statusOrder($idTable);
          return Controller::sendResponse(Controller::HTTP_OK,'update card succes',$result);
    }

    public function updateStatusOrder($id)
    {
         $result = $this->tableRepository->statusOrder($id);
         return Controller::sendResponse(Controller::HTTP_OK,'update status order succes',$result);
    }

    public function viewDetailBill($id)
    {
        $result['findOneBill'] = $this->billRepository->find($id);
        $result['showBill'] = $this->billRepository->showBill($id);
        $result['id'] = $id;
        return view('bill.detail_bill',$result);
    }

    public function createBill(Request $request)
    {
        $data = $request->all();
        $result = $this->billRepository->createBill($data);
        $delete = session()->forget('card');
        return Controller::sendResponse(Controller::HTTP_OK,'create succes',$result);
    }


    public function delete_bill($bill_id)
    {
        $result = $this->billRepository->deleteBill($bill_id);
        $delete = session()->forget('card');
        return Controller::sendResponse(Controller::HTTP_OK,'Hủy phiếu thanh toán thành công',$result);
    }

    public function update_store($id)
    {
        $result = $this->billRepository->updateProductStore($id);
        return Controller::sendResponse(Controller::HTTP_OK,'thanh toán thành công',$result);
    }





    //test
    public function test()
    {
         $result = $this->categoryRepository->getAllCate();
         return $result;
    }






}
