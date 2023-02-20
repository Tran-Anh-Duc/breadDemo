<?php


namespace App\Http\Controllers;


use App\Models\Product;
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

    public function __construct(ProductRepository $productRepository,StoreRepository $storeRepository,CategoryRepository $categoryRepository,
                                NewsRepository $newsRepository,TableRepository $tableRepository)
    {
        $this->productRepository = $productRepository;
        $this->storeRepository = $storeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->newsRepository = $newsRepository;
        $this->tableRepository = $tableRepository;
    }

    public function allProduct(Request $request)
    {
        $data = $request->all();
        $user = session()->get('user');
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
        return view('card.card',compact("card"));
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
                'quantity' => 1
            ];
        }
        session()->put('card',$card);
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

    public function viewTable()
    {
        $export = true;
        $resultTable = $this->tableRepository->getAllTable($export);
        $result['resultTable'] = $resultTable;
        return view('card.openCardTable',$result);
    }

    public function detailTable($id,Request $request)
    {
        $data = $request->all();
        $resultTable = $this->tableRepository->findOneTable($id);
        $result['resultTable'] = $resultTable;
        $resultProduct = $this->productRepository->getAllDataProduct($data);
        $result['resultProduct'] = $resultProduct;
        $result['resultTable'] = $resultTable;
        $cardTable = session()->get('cardTable');
        $result['cardTable'] = $cardTable;
        $result['id'] = $id;
        return view('card.detailTable',$result);
    }

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
                'name_product' => $product['name_product'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
        //session()->put('cardTable',$cardTable);
        session()->put($tableName,$cardTable);
        return Controller::sendResponse(Controller::HTTP_OK,'create card succes');
    }

    public function updateCardTable(Request $request)
    {
        if ($request->id && $request->quantity){
            $cardTable = session()->get('cardTable');
            $cardTable[$request->id]['quantity'] = $request->quantity;
            session()->put('cardTable',$cardTable);
            $cardTable = session()->get('cardTable');
            $resultProduct = $this->productRepository->getAllDataProduct($request);
            $cardView = view('card.detailTable',compact('cardTable','resultProduct'))->render();
            return Controller::sendResponse(Controller::HTTP_OK,'update card succes',$cardView);
        }
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








    //test
    public function test()
    {
         $result = $this->categoryRepository->getAllCate();
         return $result;
    }






}
