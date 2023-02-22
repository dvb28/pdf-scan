<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $excelData = [];
            
        // Lọc fill của file excel
        $tempValue = '';
        $index = 0;
        $data = [];
        foreach($row as $fillItem) {
            if($index < 45) {
                if($fillItem == null) {
                    $tempValue = 'Trống';
                } else {
                    $tempValue = $fillItem;
                }
                $data += ["htn_$index" => $tempValue];
                $index++;
            }
        }
        array_push($excelData, $data);

        return new User($data);
    }

    public function chunkSize(): int
    {
        return 1000; // Số lượng dòng dữ liệu chèn một lần
    }
}
