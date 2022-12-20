<?php


namespace App\Http\Controllers;


use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
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
//lấy tất cả các sản phẩm
    public function getAllProduct()
    {
        $result = $this->productRepository->getAllDataProduct();
        if (!empty($result)){
            return Controller::sendResponse(Controller::HTTP_OK,'find all data succes',$result);
        }else{
            return Controller::sendResponse(Controller::HTTP_BAD_REQUEST,'find all data error',);
        }
    }

    public function allDataProduct()
    {
        $resultAll = $this->productRepository->getAllDataProduct();
        $result['all_product'] = $resultAll;
        return View('product.list_product',compact("resultAll"));
    }

//view create
    public function viewProduct()
    {
        $category = $this->categoryRepository->getAllCategory();
        $store = $this->storeRepository->getAllStore();
        return view('product.create_product',compact("category","store"));
    }

//tạo sản phẩm mới
    public function create_product(Request $request)
    {
        $data = $request->all();
        $result = $this->productRepository->createProduct($data);
        return Controller::sendResponse(Controller::HTTP_OK, 'create data succes', $result);
    }
//chi tiết 1 sản phẩm
    public function find_one($id)
    {
        $category = $this->categoryRepository->getAllCategory();
        $store = $this->storeRepository->getAllStore();
        $result_one = $this->productRepository->find($id);
        $result['detail'] = $result_one;
        $result['category'] = $category;
        $result['store'] = $store;
        $result['id'] = $id;
        return view('product.detail_product', $result);
    }
//update 1 sản phẩm
    public function update_product(Request $request,$id)
    {
        $data = $request->all();
        $find_product = $this->productRepository->find($id);
        if ($find_product['status'] == 2){
            $result = $this->productRepository->updateProduct($data,$id);
            return Controller::sendResponse(Controller::HTTP_OK,'update data succes',$result);
        }else{
             return Controller::sendResponse(Controller::HTTP_BAD_REQUEST,'update data error');
        }
    }


}
