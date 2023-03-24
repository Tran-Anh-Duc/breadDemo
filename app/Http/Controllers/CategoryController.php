<?php


namespace App\Http\Controllers;


use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use Cloudinary\Uploader;
use Cloudder;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;

    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function listCategory()
    {
        $result_category = $this->categoryRepository->getAllCategory();
        $result['category'] = $result_category;
        return view('category.list_category',$result);
    }


    public function view_create_category()
    {
        return view('category.create_category');
    }

    public function create_category(Request $request)
    {
        $data = $request->all();
        try{
            $result = $this->categoryRepository->createCategory($data);
            return Controller::sendResponse(Controller::HTTP_OK,'create category succes', $result);
        } catch (exception $e) {
            return Controller::sendResponse(Controller::HTTP_BAD_REQUEST,'create category errors');
        }
    }

    public function find_one($id)
    {
        $result_category = $this->categoryRepository->find($id);
        $result['category'] = $result_category;
        $result['id'] = $id;
        return view('category.detail_category',$result);
    }



    public function update_category(Request $request,$id)
    {
        $data = $request->all();
        $resultCategoryFindOne = $this->categoryRepository->find($id);
        if ($resultCategoryFindOne['status'] == 1 || $resultCategoryFindOne['status'] == 2 ){
            $result = $this->categoryRepository->updateCategory($data,$id);
            return Controller::sendResponse(Controller::HTTP_OK,'Cập nhật loại sản phẩm thành công',$result);
        }else{
            return Controller::sendResponse(Controller::HTTP_BAD_REQUEST,'Cập nhật loại sản phẩm thất bại');
        }
    }

    public function updateStatus($id)
    {
        $result = $this->categoryRepository->update_status($id);
        return Controller::sendResponse(Controller::HTTP_OK,'Cập nhật trạng thái loại sản phẩm thành công',$result);
    }

    public function test(Request $request)
    {
        $arrImage = [];
        if ($request->hasFile('image')) {
            $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            var_dump($response);die();
        }
        $a = array_push($response,$arrImage);
        var_dump($a);die();
        return $response;
    }
}
