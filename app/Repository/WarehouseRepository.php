<?php


namespace App\Repository;


use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;

class WarehouseRepository extends BaseRepository
{
    protected $warehouse;

    public function getModel()
    {
         return Warehouse::class;
    }

//    public function getAllData()
//    {
////        $warehouses = DB::table('users')
////            ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
////            ->select('users.*', 'profiles.*')
////            ->get();
//
//        $warehouses = DB::table('warehouse')
//        ->leftJoin('product' , 'warehouses.id', '=' , 'product.warehouses_id')
//        ->select('warehouses.*','product.*')->get();
//        return $warehouses;
//    }

    public function createWarehouse($data)
    {
        $data1 = [
            Warehouse::COLUMN_WAREHOUSE_NAME => $data['warehouse_name'] ?? null,
            Warehouse::COLUMN_PRODUCT_ID => $data['product_id'] ?? null,
            Warehouse::COLUMN_QUANTITY  => $data['quantity'] ?? null
        ];
        $result = $this->model->create($data1);
        return $result;
    }
}
