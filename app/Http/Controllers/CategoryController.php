<?php


namespace App\Http\Controllers;


use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;

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
        return view('category/list_category',$result);
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
        $result = $this->categoryRepository->getOne($id);
        return Controller::sendResponse(Controller::HTTP_OK , 'find one succes', $result);
    }

    public function update_category(Request $request,$id)
    {
        $data = $request->all();
        $resultCategoryFindOne = $this->categoryRepository->getOne($id);
        if ($resultCategoryFindOne['status'] == 1){
            $result = $this->categoryRepository->updateCategory($data,$id);
            return Controller::sendResponse(Controller::HTTP_OK,'update success',$result);
        }else{
            return Controller::sendResponse(Controller::HTTP_BAD_REQUEST,'update error');
        }
    }
}
