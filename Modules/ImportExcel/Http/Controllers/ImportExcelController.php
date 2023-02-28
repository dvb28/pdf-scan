<?php

namespace Modules\ImportExcel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\ImportExcel\Http\Requests\ImportRequest;
use Modules\ImportExcel\Jobs\ImportExcelJob;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Carbon\Carbon;


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
            
            // Lưu dữ liệu các field excel nhận được request
            $excelField = Excel::toArray(new UsersImport, $request->file('file_excel'))[0];

            // Lưu dữ liệu file pdf nhận được từ request
            $pdfFile = $request->file('file_pdf'); 

            // Lưu dữ liệu pdf file sau khi đã check
            $scPdfDataIndex = [];

            // Lưu dữ liệu pdf file sau khi đã check
            $errPdfDataIndex = [];

            // Lưu dữ liệu pdf file sau khi đã check
            $scExcelData = [];

            // Lọc field của file excel
            for($i = 0; $i < count($excelField); $i++) {
                $index = 2;
                $data = [];
                if(isset($pdfFile[$i]) && strpos($pdfFile[$i]->getClientOriginalName(), '.pdf') !== false) {
                    array_push($scPdfDataIndex, $i);
                    // Thêm các fields cần thiết vào mảng data
                    $data += [
                        'parent_id' => 4,
                        'document_type' => 1,
                        'ext' => substr(strstr($pdfFile[$i]->getClientOriginalName(), '.'), 1),
                        'slug' => Carbon::now()->format('YmdHis') . '_' . $pdfFile[$i]->getClientOriginalName(),
                        'htn_1' => $pdfFile[$i]->getClientOriginalName()
                    ];
                    // Lặp qua các fields trong file excel và push vào mảng data
                    foreach($excelField[$i] as $fieldKey => $fieldData) {
                        if($fieldData) {
                            if($fieldKey != 'stt') {
                                $data += ["htn_$index" => $fieldData];
                            } else {
                                continue;
                            }
                        }
                        $index++;
                    }
                    array_push($scExcelData, $data);
                } else {
                    array_push($errPdfDataIndex, $i);
                }
            }

            // Gọi tới chức năng insert trong đối tượng users và gửi dư liệu excel và pdf
            dispatch(new ImportExcelJob([
                'excelData' => $scExcelData,
                'pdfDataIndex' => $scPdfDataIndex,
                'pdfDir' => $directory
            ]));

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