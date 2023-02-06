<?php


namespace App\Http\Controllers;


use App\Models\Product;
use App\Repository\CategoryRepository;
use App\Repository\NewsRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use http\Exception;
use Illuminate\Http\Request;
class TemplateController extends Controller
{
    protected $productRepository;
    protected $storeRepository;
    protected $categoryRepository;
    protected $newsRepository;

    public function __construct(ProductRepository $productRepository,StoreRepository $storeRepository,CategoryRepository $categoryRepository,
                                NewsRepository $newsRepository)
    {
        $this->productRepository = $productRepository;
        $this->storeRepository = $storeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->newsRepository = $newsRepository;
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

    //test
    public function test()
    {
         $result = $this->categoryRepository->getAllCate();
         return $result;
    }






}
