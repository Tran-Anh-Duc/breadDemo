<?php


namespace App\Repository;

use App\Models\bill;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository
{
    protected $category;

    public function getModel()
    {
       return Product::class;

    }



//lấy tất cả các sản phẩm
    public function getAllDataProduct($data)
    {
        $result = $this->model;
        if (!empty($data['status'])) {
            $result = $result->where(Product::COLUMN_STATUS_PRODUCT, $data['status']);
        }

        if (!empty($data['name_product'])) {
            $result = $result->where(Product::COLUMN_PRODUCT_NAME, 'LIKE', '%' . $data['name_product'] . '%');
        }

        if (!empty($data['category_id'])) {
            $result = $result->where(Product::COLUMN_CATEGORY_ID, $data['category_id']);
        }

        $result = $result->
        whereIn(
            Product::COLUMN_STATUS_PRODUCT,
            [Product::COLUMN_STATUS_ACTIVE, Product::COLUMN_STATUS_BLOCK]);
        return $result
            ->orderBy(Product::CREATED_AT, self::DESC)
            ->paginate(9);

    }
//tạo sản phẩm mới
    public function createProduct($data)
    {
        $data1 = [
            Product::COLUMN_PRODUCT_NAME => $data['name_product'] ?? null,
            Product::COLUMN_PRODUCT_DESCRIPTION => $data['product_description'] ?? null,
            Product::COLUMN_PRODUCT_IMAGE => $data['image'] ?? null,
            Product::COLUMN_STATUS_PRODUCT => Product::COLUMN_STATUS_BLOCK,
            Product::COLUMN_STORE_ID => $data['store_id'] ?? null,
            Product::COLUMN_CATEGORY_ID => $data['category_id'] ?? null,
            Product::COLUMN_PRICE =>  !empty($data['price']) ? $data['price'] : 0,
            Product::COLUMN_TOTAL => !empty($data['total']) ? $data['total'] : 0,
            Product::COLUMN_CLICK_ID => !empty($data['click_id']) ? $data['click_id'] : 0,
        ];
        $result = $this->model->create($data1);
        return $result;
    }
//update 1 sản phẩm
    public function updateProduct($data,$id)
    {
        $result = [];
        $bool = false;
        $findProduct = $this->find($id);
        if (isset($data['name_product'])){
            $result[Product::COLUMN_PRODUCT_NAME] = $data['name_product'];
        }
        if (isset($data['product_description'])) {
            $result[Product::COLUMN_PRODUCT_DESCRIPTION] = $data['product_description'];
        }
        if (isset($data['image'])) {
            $result[Product::COLUMN_PRODUCT_IMAGE] = $data['image'];
        }
        if (isset($data['category_id'])) {
            $result[Product::COLUMN_CATEGORY_ID] = $data['category_id'];
        }
        if (isset($data['store_id'])) {
            $result[Product::COLUMN_STORE_ID] = $data['store_id'];
        }
        if (empty($result)){
            $bool = false;
        }
        if ($findProduct['status'] == 2){
            $result_product = $this->model->where([Product::COLUMN_ID => $id])->update($result);
            $bool = true;
        }else{
             $bool = false;
        }
        return  $bool;
    }

//update status product(cập nhật trạng thái của sản phẩm)
    public function update_status($id)
    {
        $result = $this->model->find($id);
        if (!empty($result) && $result['status'] == 1){
            $resultActive = $this->model->where([Product::COLUMN_ID => $id])->update([Product::COLUMN_STATUS_PRODUCT => Product::COLUMN_STATUS_ACTIVE ]);
        }elseif(!empty($result) && $result['status'] == 2){
            $resultActive = $this->model->where([Product::COLUMN_ID => $id])->update([Product::COLUMN_STATUS_PRODUCT => Product::COLUMN_STATUS_BLOCK ]);
        }
        return $resultActive;
    }


//lấy tất cả các bản ghi có số lần click nhiều nhất (click_id)
    public function getDataCLick()
    {
        $result = $this->model->orderBy('click_id','DESC')->limit(3)->get();
        return $result;
    }

    public function findId($id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    public function getAllDataProductStore()
    {
        $test = DB::table('product_store')
                //->where('store.id','=',1)
                ->join('product','product_store.product_id','=','product.id')
                ->join('store','product_store.store_id','=','store.id')
                ->select('name_product','store_name','product.total','product.price')
                ->paginate(10);
        return $test;
    }

    //theem sản phẩm và cửa hàng vào bảng product_store
    public function createProductAndStore($data)
    {
        $bool = false;
        $arrProductStore = [];
        $arrData = [];
        if ($data['store_id']){
            $stores = DB::table('product_store')->where('product_store.store_id','=',$data['store_id'])->get();
            foreach ($stores as $key => $value){
                $arrData[] = $value->product_id;
            }
        }
        if($data['data']){
            foreach ($data['data'] as $ke => $va){
                $arrProductStore[] = $va['product_id'];
            }
        }
        if (!empty($arrProductStore)){
            $test = DB::table('product_store')
            ->where('store_id','=',$data['store_id'])
            ->whereIn('product_id', $arrProductStore)->get();
            if (!empty($test) && count($test) != 0) {
                return false;
            } else {
                foreach ($arrProductStore as $k => $v) {
                    $productId = $v;
                    $store = Store::find($data['store_id']);
                    $store->products()->attach($productId);
                    $bool = true;
                }
            }
        }
        return $bool;
    }

    public function getDataProduct()
    {
        $result = $this->model->get()->toArray();
        return $result;
    }

    public function createBillProduct($billId)
    {
//        $bill = bill::find($billId);
//        $bill->products()->attach($productId);

        $bill = Bill::find(1);
        $bill->products()->sync([2, 3]);


        return $bill;
    }

    //lấy tất cả số sản phẩm đang tòn kho theo số lượng yêu cầu
    public function getDataPoductLimit($data)
    {
        //$result = $this->model->where(Product::COLUMN_TOTAL ,'>',(int)$data['total'])->get();

        $result = DB::table('product')
        ->select('name_product','id','product_description','price',DB::raw('sum(total) as total'))
        ->groupBy('name_product','id','product_description','price')
        ->having('total','>',$data['total'])->get();
        return $result;
    }

    //test try catch
    public function test3()
    {
        try {
            $result = DB::table('product')->get();
        }catch (Exception $e){
            echo "Lỗi truy vấn cơ sở dữ liệu: " . $e->getMessage();
        }

    }











}
