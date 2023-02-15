<?php


namespace App\Http\Controllers;


use App\Repository\TableRepository;
use Illuminate\Http\Request;

class TableController extends Controller
{
    protected $tableRepository;

    public function __construct(TableRepository $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }

    public function getDataTable()
    {
        $result = $this->tableRepository->getAllTable();
        return view('table.list_table',compact('result'));
    }

    public function view_create_table()
    {
        return view('table.create_table');
    }

    public function createTable(Request $request)
    {
        $data = $request->all();
        $result = $this->tableRepository->createTable($data);
        return Controller::sendResponse(Controller::HTTP_OK,'Tạo mới thành công',$result);
    }

    public function find_one_table($id)
    {
        $result = $this->tableRepository->findOneTable($id);
        return Controller::sendResponse(Controller::HTTP_OK,'Xem chi tiết thành công',$result);
    }

    public function update_status($id)
    {
        $result = $this->tableRepository->updateStatus($id);
        return Controller::sendResponse(Controller::HTTP_OK,'cập nhật trạng thái thành công',$result);
    }


}
