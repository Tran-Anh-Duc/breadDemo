<?php


namespace App\Http\Controllers;


use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Cloudinary\Uploader;
//use Cloudinary;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Validator;

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
        $validate = Validator::make($data,[
            'name_category' => 'required',
            'category_description' => 'required',
        ],
            [
                'name_category.required' => "Tên loại sản phẩm không được để trống",
                'category_description.required' => "Mô tả loại sản phẩm không được để trống",
            ]
        );
        if ($validate->fails()) {
            return  Controller::sendResponse(Controller::HTTP_BAD_REQUEST,$validate->errors());
        }
        try{
            $result = $this->categoryRepository->createCategory($data);
            return Controller::sendResponse(Controller::HTTP_OK,'create category succes', $result);
        } catch (exception $e) {
            return Controller::sendResponse(Controller::HTTP_BAD_REQUEST,'create category errors');
        }
    }

    public function find_one($id)
    {
        $result_category = $this->categoryRepository->find($id)->toArray();
        $result['category'] = $result_category;
        $result['image_category'] = json_decode($result_category['image']);
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
//upload multiple image trên cloundinary
    public function uploadImage(Request $request)
    {
        $arrImage = [];
        $images = $request->file('image');
        foreach ($images as $image){
            $imagePath  = $image->getRealPath();
            $result = Cloudinary::upload($imagePath);
            if (!empty($result->getFileName())){
                $name = time().'.'.rand(1,100).'.'.'media';
            }
            $arrImage[] = [ 'path' =>$result->getPath() ,'name' => $name];
        }
        return Controller::sendResponse(Controller::HTTP_OK,'updaload image success',$arrImage);
    }

    public function test(Request $request)
    {
        $arrImage = [];
        $images = $request->file('image');
        foreach ($images as $image){
            $imagePath  = $image->getRealPath();
            $result = Cloudinary::upload($imagePath);
            if (!empty($result->getFileName())){
                $name = time().'.'.rand(1,100).'.'.'media';
            }
            $arrImage[] = [ 'path' =>$result->getPath() ,'name' => $name];
        }
        return Controller::sendResponse(Controller::HTTP_OK,'updaload image success',$arrImage);
    }
}
