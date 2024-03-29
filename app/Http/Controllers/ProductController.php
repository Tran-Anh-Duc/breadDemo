<?php


namespace App\Http\Controllers;


use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

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
    public function getAllProduct(Request $request)
    {
        $data = $request->all();
        $result = $this->productRepository->getAllDataProduct($data);
        if (!empty($result)){
            return Controller::sendResponse(Controller::HTTP_OK,'find all data succes',$result);
        }else{
            return Controller::sendResponse(Controller::HTTP_BAD_REQUEST,'find all data error');
        }
    }

    public function allDataProduct(Request $request)
    {
        $data = $request->all();
        $id = !empty($data['id']) ? $data['id'] : "";
        $resultAll = $this->productRepository->getAllDataProduct($data);
        $result['all_product'] = $resultAll;
        return View('product.list_product',$result);
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
            return Controller::sendResponse(Controller::HTTP_OK,'Cập nhật sản phẩm thành công',$result);
        }else{
             return Controller::sendResponse(Controller::HTTP_BAD_REQUEST,'Sản phẩm chưa được kích hoạt');
        }
    }
//update status product

    public function updateStatus($id)
    {
        $result = $this->productRepository->update_status($id);
        return Controller::sendResponse(Controller::HTTP_OK,'Cập nhật trạng thái  sản phẩm thành công',$result);
    }

    public function getAllDataProductStore()
    {
         $lead_warehouse = $this->productRepository->getAllDataProductStore();
         $result['product_store'] = $lead_warehouse;
         return view('warehouse.view_lead_all',$result);
    }
//view product_store
    public function createViewProductStore()
    {
        $lead_store = $this->storeRepository->getAllStore();
        $lead_product = $this->productRepository->getDataProduct();
        $result['lead_product'] =$lead_product;
        $result['lead_store'] = $lead_store;
        return view('warehouse.create_product_store',$result);
    }
// create product_store
    public function createProductAndStore(Request $request)
    {
        $data = $request->all();
        $result = $this->productRepository->createProductAndStore($data);
        if (!empty($result) && $result == 1){
            return Controller::sendResponse(Controller::HTTP_OK,' Thêm sản phẩm vào kho thành công',$result);
        }else{
            return Controller::sendResponse(Controller::HTTP_BAD_REQUEST,' Thêm sản phẩm vào kho thất bại(sản phẩm đã tồn tại trong kho)');
        }
    }

    public function test3($id)
    {
        //data = $request->all();
        //$result = $this->productRepository->test3();


        try {
            $result = DB::table('product')->where($id)->get();
        }catch (QueryException $e){
            echo "Lỗi truy vấn cơ sở dữ liệu: " . $e->getMessage();
        }

        return $result;
    }






}
