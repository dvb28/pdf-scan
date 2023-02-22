<?php

namespace Modules\ImportExcel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\ImportExcel\Http\Requests\ImportRequest;
use Modules\ImportExcel\Jobs\UserImportJob;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;


class ImportExcelController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('importexcel::index');
    }

    public function import(ImportRequest $request) {

        $directory = rtrim($request->file('file_excel')->getClientOriginalName(), '.xlsx');

        // Kiểm tra xem đã tồn tại folder đó hay chưa
        if(!Storage::exists($directory)) {

            // Lưu dữ liệu các fill excel nhận được request
            $excelFill = Excel::toArray(new UsersImport, $request->file('file_excel'))[0];

            // Lưu dữ liệu file pdf nhận được từ request
            $pdfFile = $request->file('file_pdf'); 

            // Lưu dữ liệu pdf file sau khi đã check
            $scPdfDataIndex = [];

            // Lưu dữ liệu pdf file sau khi đã check
            $errPdfDataIndex = [];

            // Lưu dữ liệu pdf file sau khi đã check
            $scExcelData = [];

            // Lọc fill của file excel
            for($i = 0; $i < count($excelFill); $i++) {
                $tempValue = '';
                $index = 0;
                $data = [];
                if(isset($pdfFile[$i]) && strpos($pdfFile[$i]->getClientOriginalName(), '.pdf') !== false) {
                    array_push($scPdfDataIndex, $i);
                    foreach($excelFill[$i] as $fillItem) {
                        if($index < 46) {
                            if($index === 45) {
                                $tempValue = $directory;
                            } else if($fillItem == null) {
                                $tempValue = 'Trống';
                            } else {
                                $tempValue = $fillItem;
                            }
                            $data += ["htn_$index" => $tempValue];
                            $index++;
                        }
                    }
                    array_push($scExcelData, $data);
                } else {
                    array_push($errPdfDataIndex, $i);
                }
            }

            $sendingData = [
                'excelData' => $scExcelData,
                'pdfDataIndex' => $scPdfDataIndex,
                'pdfDir' => $directory
            ];

            // Gọi tới chức năng insert trong đối tượng users và gửi dư liệu excel và pdf
            dispatch(new UserImportJob($sendingData));

            // Return Json
            if($errPdfDataIndex) {
                return response()->json(['hasError' => count($errPdfDataIndex)], 200);
            } else {
                return response()->json(['success' => 'Import thành công'], 200);
            }


        } else {
            return response()->json(['dirError' => 'Hồ sơ này đã tồn tại trên hệ thống'], 422);
        }
    }

}
