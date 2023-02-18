<?php


namespace App\Repository;


use App\Http\Controllers\Controller;
use App\Models\Table;

class TableRepository extends BaseRepository
{
    public function getModel()
    {
        return Table::class;
    }

    public function getAllTable($export = false)
    {
        $result = $this->model;
        $result->whereIn(Table::COLUMN_STATUS,[Table::COLUMN_STATUS_BLOCK,Table::COLUMN_STATUS_ACTIVE]);
        if (!empty($export)){
            return $result->orderby(Table::CREATED_AT,'DESC')->get();
        }else{
            return $result->orderby(Table::CREATED_AT,'DESC')->paginate(10);
        }

    }

    public function createTable($data)
    {
        $data1 = [
          Table::COLUMN_NUMBER_TABLE => $data['number_table'] ?? null,
          Table::COLUMN_STATUS => Table::COLUMN_STATUS_BLOCK,
          Table::COLUMN_IMAGE_TABLE => $data['image_table'] ?? null,
          Table::COLUMN_COLOR_TABLE => Table::COLUMN_COLOR_BLOCK
        ];
        $result = $this->model->create($data1);
        return $result;
    }

    public function findOneTable($id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    public function updateStatus($id)
    {
        $result = $this->model->find($id);
        if (!empty($result) && $result['status'] == 1 && $result['color_table'] == 1){
            $resultActive = $this->model->where([Table::COLUMN_ID => $id])->update([Table::COLUMN_STATUS => Table::COLUMN_STATUS_ACTIVE,Table::COLUMN_COLOR_TABLE => Table::COLUMN_COLOR_ACTIVE]);
        }elseif(!empty($result) && $result['status'] == 2 && $result['color_table'] == 2){
            $resultActive = $this->model->where([Table::COLUMN_ID => $id])->update([Table::COLUMN_STATUS => Table::COLUMN_STATUS_BLOCK,Table::COLUMN_COLOR_TABLE => Table::COLUMN_COLOR_BLOCK]);
        }
        return $resultActive;
    }




}
