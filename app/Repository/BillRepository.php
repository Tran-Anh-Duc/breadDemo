<?php


namespace App\Repository;


use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Support\Facades\DB;

class BillRepository extends  BaseRepository
{
    protected $billRepository;

    public function getModel()
    {
        return Bill::class;
    }
//tạo phiếu thanh toán
    public function createBill($data)
    {
        $data1 = [
            Bill::COLUMN_CREATED_BY =>  !empty($data['created_by']) ? $data['created_by'] : 'trananhducty@gmail.com',
            Bill::COLUMN_COUPON => $data['coupon'] ?? null,
            Bill::COLUMN_USER => 'GM'.random_int(0,99).time(),
            Bill::COLUMN_TOTAL => $data['total'] ?? null
        ];
        $resultBill = $this->model->create($data1)->toArray();
        $result['resultBill'] = $resultBill;
        $result['id'] = $resultBill['id'];
        $bill = Bill::find($result['id']);
        $arr_sync = [];
        for ($i = 0; $i < count($data['data']); $i++) {
            $price = $data['data'][$i]['price'];
            $total = $data['data'][$i]['total'];
            $product_id = $data['data'][$i]['product_id'];
            $key = $data['data'][$i]['product_id'];
            $value = [
                'total' => $total,
                'price' => $price
            ];
            $arr_sync[$key] = $value;
            $bill->products()->sync($arr_sync);
        }
        return $result;
    }
//hiển thị chi tiết phiếu thanh toán
    public function showBill($billId)
    {
        $test = DB::table('bill_product')
            ->join('bills', 'bill_product.bill_id', '=', 'bills.id')
            ->join('product', 'bill_product.product_id', '=', 'product.id')
            ->select('product.name_product', 'bill_product.total', 'product.price','bills.created_by','bills.user','product.id')
            ->where('bill_product.bill_id','=',$billId)
            ->get();
        return $test;
    }
//hủy phiếu thanh toán
    public function deleteBill($bill_id)
    {
        $result = DB::table('bill_product')->where('bill_product.bill_id','=',$bill_id)->get();
        if ($result){
            foreach ($result as $key => $value){
                $billId = $value->bill_id;
                $idBill = $value->id;
                $resultDele = DB::table('bill_product')->delete($idBill);
            }
            $this->model->where([Bill::COLUMN_ID => $billId])->delete();
        }
        return $resultDele;
    }
//cập nhật số lượng trong kho
    public function updateProductStore($billId)
    {
       $resultBill =  $this->showBill($billId);
        foreach ($resultBill as $key => $value){
            $total = $value->total;
            $idProduct = $value->id;
            $findOneProduct = DB::table('product')->where('product.id','=',$idProduct)->first();
            $totalCurent = $findOneProduct->total - $total;
            $data = [
                'name_product' => $findOneProduct->name_product,
                'product_description' => $findOneProduct->product_description,
                'category_id' => $findOneProduct->category_id,
                'status' => $findOneProduct->status,
                'image' => $findOneProduct->image,
                'price' => $findOneProduct->price,
                'click_id' => $findOneProduct->click_id,
                'total' => $totalCurent,
                'store_id' => $findOneProduct->store_id,
            ];
            $resultUpdateTotalProduct = DB::table('product')->where('product.id','=',$idProduct)->update($data);
        }
       return $resultUpdateTotalProduct;
    }

//danh sách tất cả phiếu thanh toán
    public function getAllDataBill()
    {
        $result = $this->model->get()->toArray();
        return $result;
    }


//lấy tổng số tiền và ; lấy tổng số sản phẩm cùng bill_id
    public function sumPriceAndTotal($bill_id)
    {
        $result['data_result'] =DB::table('bill_product')->where('bill_product.bill_id','=',$bill_id)
                                               ->select('bill_id')
                                               ->selectRaw("SUM(price) as price")
                                               ->selectRaw("SUM(total) as total")
                                               ->groupBy('bill_product.bill_id')->get();
        return $result;
    }

//    public function updateCardTableId($idTable, $data)
//    {
//        $tableName = "table-" . $idTable;
//        if (!empty($data)) {
//            $cardTable = session()->get($tableName) ?? [];
//            if (!empty($data['data'])){
//                foreach ($data['data'] as $key => $value) {
//                    $a = $cardTable[$value['id']];
//                    $checkIdProduct = $cardTable[$value['id']]['idProduct'];
//                    $checkQuantity = $cardTable[$value['id']]['quantity'];
//                    if ($value['id'] == $checkIdProduct) {
//                        $checkQuantity = $value['quantity'];
//                    }
//                    $cardTable[$value['id']] = [
//                        'idProduct' => $a['idProduct'],
//                        'name_product' => $a['name_product'],
//                        'price' => $a['price'],
//                        'quantity' => $checkQuantity
//                    ];
//                }
//            }else{
//                return false;
//            }
//
//            session()->put($tableName, $cardTable);
//        }
//        session()->has($tableName);
//        return  true;
//    }






}
