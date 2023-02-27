<?php


namespace App\Repository;


use App\Models\Bill;
use Illuminate\Support\Facades\DB;

class BillRepository extends  BaseRepository
{
    protected $billRepository;

    public function getModel()
    {
        return Bill::class;
    }

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

    public function showBill($billId)
    {
        $test = DB::table('bill_product')
            ->join('bills', 'bill_product.bill_id', '=', 'bills.id')
            ->join('product', 'bill_product.product_id', '=', 'product.id')
            ->select('product.name_product', 'bill_product.total', 'product.price','bills.created_by','bills.user')
            ->where('bill_product.bill_id','=',$billId)
            ->get();
        return $test;
    }




}
