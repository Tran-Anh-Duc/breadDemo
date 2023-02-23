<?php


namespace App\Repository;


use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

class StoreRepository extends BaseRepository
{
    protected $productRepository;

    public function getModel()
    {
        return Store::class;
    }

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllStore()
    {
        $result = $this->model;
        $result->whereIn(Store::COLUMN_STATUS_STORE,[Store::COLUMN_STATUS_BLOCK,Store::COLUMN_STATUS_BLOCK]);
        return $result->orderby(Store::CREATED_AT,'DESC')->paginate(4);
    }

    public function createStore($data)
    {
        $data1 = [
            Store::COLUMN_STORE_NAME => $data['store_name'] ?? null,
            Store::COLUMN_STORE_ADDRESS => $data['store_address'] ?? null,
            Store::COLUMN_STATUS_STORE => Store::COLUMN_STATUS_BLOCK
        ];

        $result = $this->model->create($data1);
        return $result;
    }

    public function findOneStore($id)
    {
        $result = $this->model->where([Store::COLUMN_ID => $id])->first()->toArray();
        return $result;
    }

    public function updateStore($data,$id)
    {
        $result = [];
        if (isset($data['store_name'])){
            $result[Store::COLUMN_STORE_NAME] = $data['store_name'];
        }

        if (isset($data['store_address'])){
            $result[Store::COLUMN_STORE_ADDRESS] = $data['store_address'];
        }

        if (empty($result)){
            return false;
        }

        $result_update_store = $this->model
            ->whereIn(Store::COLUMN_STATUS_STORE, [1, 2])
            ->where([Store::COLUMN_ID => $id])
            ->update($result);
        return  $result_update_store;
    }

    //update status product(cập nhật trạng thái của loại sản phẩm)
    public function update_status($id)
    {
        $result = $this->model->find($id);
        if (!empty($result) && $result['status_store'] == 1){
            $resultActive = $this->model->where([Store::COLUMN_ID => $id])->update([Store::COLUMN_STATUS_STORE => Store::COLUMN_STATUS_ACTIVE ]);
        }elseif(!empty($result) && $result['status_store'] == 2){
            $resultActive = $this->model->where([Store::COLUMN_ID => $id])->update([Store::COLUMN_STATUS_STORE => Store::COLUMN_STATUS_BLOCK ]);
        }
        return $resultActive;
    }

    public function test($storeId,$productId)
    {
        $findId = $this->productRepository->find($productId);
        $store = Store::find($storeId);
        $store->products()->attach($productId,['total' => [$findId['total']]]);
        return $store;
    }

    public function test1($storeId,$data)
    {
        if (!empty($data)){
            foreach ($data['data'] as $key => $value){
                $productId = $value['product_id'];
                $total = $value['total'];
                $product = Store::find($storeId);
                $product->products()->updateExistingPivot($productId, ['total'=>$total]);
            }
        }
        $result = DB::table('product_store')->where('store_id','=',$storeId)->distinct()->get();
        return $result;
    }

    public function test2($id)
    {
//        $test = DB::table('product')
//            ->where('product.id','=',$id)
//            ->leftJoin('product_store', 'product.id', '=', 'product_store.product_id')
//            ->get();

        $test = DB::table('product_store')
            //->where('product_store.id', '=', $id)
            ->fullOuterJoin('product', 'product_store.product_id', '=', 'product.id')
            //->select('name_product','total','product_store.product_id')
            ->select('name_product','total','product.id')
            ->get();

        return $test;
    }
}
