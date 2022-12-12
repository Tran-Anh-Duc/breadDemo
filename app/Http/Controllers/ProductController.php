<?php


namespace App\Http\Controllers;


use App\Repository\ProductRepository;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProduct()
    {
        $result = $this->productRepository->getAllDataProduct();
        if ($result){
            return Controller::sendResponse(Controller::HTTP_OK,'find all data succes',$result);
        }else{
            return Controller::sendResponse(Controller::HTTP_BAD_REQUEST,'find all data error',);
        }
    }
}
