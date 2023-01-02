<?php


namespace App\Http\Controllers;


use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use Illuminate\Http\Request;
class TemplateController extends Controller
{
    protected $productRepository;
    protected $storeRepository;
    protected $categoryRepository;

    public function __construct(ProductRepository $productRepository,StoreRepository $storeRepository,CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->storeRepository = $storeRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function allProduct(Request $request)
    {
        $data = $request->all();
        $resultAll = $this->productRepository->getAllDataProduct($data);
        $result['all_product'] = $resultAll;
        return View('card.product_list',$result);
    }

    public function view_card()
    {
        return view('card.card');
    }

    public function add_to_card($id)
    {
        dd('add to card: ' .$id);
    }

    public function updateCard(Request $request)
    {


    }

    public function removeCard(Request $request)
    {

    }
}
