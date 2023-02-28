<?php

namespace Modules\ImportExcel\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\ImportExcel\Jobs\PDFImportJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;


class ImportExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {

        // Đặt số lượng import trong mỗi lần
        $chunkSize = 50;

        // Tách file excel
        $excelChunk = array_chunk($this->data['excelData'], 100);

        $pdfTemp = [];

        // Lọc các file lỗi
        foreach($this->data['pdfDataIndex'] as $item) {
            array_push($pdfTemp, $request->file('file_pdf')[$item]);
        }

        // Chia nhỏ dữ liệu file pdf
        $pdfChunk = array_chunk($pdfTemp, 100);

        // Transaction, sẽ commit nếu tất cả các fill thành công, rollback nếu bất kỳ fill nào lỗi
        DB::transaction(function () use ($excelChunk, $pdfChunk) {

            // Insert dữ liệu file excel
            foreach($excelChunk as $excelList) {
                DB::table('htn_stg_file')->insert($excelList);
            }
            
            // Lưu các file pdf tải lên vào storage
            foreach($pdfChunk as $pdfList) {
                foreach($pdfList as $pdfItem) {
                    Storage::putFileAs(
                        $this->data['pdfDir'], $pdfItem, $pdfItem->getClientOriginalName()
                    );
                }
            }
        });
    }
}



