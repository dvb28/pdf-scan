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


class UserImportJob implements ShouldQueue
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
        
        // Lưu dữ liệu pdf tạm thời
        $pdfTemp = [];

        // Loại bỏ các file lỗi
        for($i = 0; $i < count($this->data['pdfDataIndex']); $i++) {
            if($i === $this->data['pdfDataIndex'][$i]) {
                array_push($pdfTemp, $request->file('file_pdf')[$i]);
            }
        }

        // Chia nhỏ dữ liệu file pdf
        $pdfChunk = array_chunk($pdfTemp, 100);

        // Transaction, sẽ commit nếu tất cả các fill thành công, rollback nếu bất kỳ fill nào lỗi
        DB::transaction(function () use ($excelChunk, $pdfChunk) {

            // Insert dữ liệu file excel
            foreach($excelChunk as $excelList) {
                DB::table('users')->insert($excelList);
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



