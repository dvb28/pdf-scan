@extends('upload::layouts.master')

@section('content')

{{-- Kiểm tra xem đã cài đặt plugin hay chưa --}}
<script>
    window.scannerjs_config = {
        // Hiển thị button cài đặt plugin khi chưa scan và ngược lại
        display_scan_ready_func: function() {
            setTimeout(() => {
                document.querySelector('.download_button').innerHTML = '<button class="download_plugin btn btn-success btn-sm mt-2 text-white"">Đã cài đặt plugin</button>'
            }, 500);
        }
    };
</script>

{{-- ScannerJS --}}
<script src="{{mix('/node_modules/scanner-js/dist/scanner.js')}}" type="text/javascript"></script>

{{-- Bootstrap --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

{{-- Css --}}
<style>

    html, body {
        overflow-y: hidden;
    }

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    
    iframe, #images {
        width: 70vw;
        height: 100vh;
        border: 0;
    }
    
    #scanner_root {
        height: 100%;
        display: flex;
        justify-content: space-between;
    }

    ul {
        list-style: none;
    }

    #scan_machine, #resolution {
        padding: 6px 25px 6px 12px;
        border: 0.8px solid rgb(221, 221, 221);
        border-radius: 2px;
        background-color: #fff;
        font-size: 14px;
        color: rgb(133, 133, 133);
    }

    #loader {
        margin-left: 7px;
        width: 15px;
        height: 15px;
        border: 2px solid royalblue;
        border-bottom-color: transparent;
        border-radius: 50%;
        display: inline-block;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
    }

    .setting_title, .upload_title {
        border-bottom: 1px solid rgb(238, 238, 238);
        border-top: 1px solid rgb(238, 238, 238);
    }

    .scanner_machine-title, .scanner_resolution-title,
    .scanner_pages, .scanner_color, .scanner_format, .scanner_format-title,
    .model-body {
        font-size: 13.6px;
    }

    .scanner_config {
        flex: 1;
        resize: horizontal;
        overflow: auto;
        border: 1px solid rgb(238, 238, 238);
    }

    .scanner_setting-title {
        border-bottom: 1px solid rgb(238, 238, 238);
    }

    .upload_select:hover .upload_select-options {
        display: flex;
    }

    .upload_select-options {
        content: '';
        display: none;
        justify-content: space-between;
        width: 100%;
        top: 100%;
        flex-direction: column;
        text-align: left;
        left: 0;
        border-radius: 3px;
        border: 1px solid rgb(238, 238, 238);
        font-size: 13.1px;
        color: #000;
        background-color: white;
    }

    .upload_select-options > span:not(:last-child) {
        border-bottom: 1px solid rgb(238, 238, 238);
    }

    .upload_select-options > span:hover {
        background-color: #007BFF;
        color: white;
    }

    .modal-title {
        flex: 1;
        text-align: center;
    }

    .model-heading {
        border-bottom: 1px solid rgb(238, 238, 238);
    }

    .model-body input, .model-body textarea, .model-body select {
        border: 1px solid rgb(238, 238, 238);
        padding: 6px 12px;
        border-radius: 3px;
        background-color: #fff;
    }

    @media only screen and (max-width: 1052px) {
        .scanner_root {
            flex-direction: column;
        }

        html, body {
            overflow-y: auto;
        }

        iframe, #images {
            width: 100vw;
        }
    }

    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    } 

</style>

<div id="scanner_root" class="scanner_root">

    {{-- Nơi hiển thị tài liệu đã scan --}}
    <div id="images">
        <iframe id="scanned" class="scanned"></iframe>
    </div>
    
    <div class="scanner_config">
        {{-- Nơi cài đặt các setting trước khi scan --}}
        <div class="scanner_setting mb-3">
            <div class="setting_title pl-5">
                <h4 class="text-primary py-3 font-weight-normal mb-0">THIẾT LẬP</h4>
            </div>
            <div class="setting_config pl-5 mt-4">
                <div class="scanner_machine mb-2">
                    <span class="scanner_machine-title pr-1">Máy scan</span>
                    <select name="scan_machine-select" id="scan_machine" style="width: 180.067px">
                        <option value="" disabled selected hidden>Chưa chọn</option>
                    </select>
                    <span id="spinner">
                        <span id="loader"></span>
                    </span>
                </div>
    
                {{-- Chọn màu scan --}}
                <ul class="scanner_color mb-2 d-flex">
                    <li class="pr-2">
                        <input type="radio" name="scanColor" id="bw" value="TWPT_BW">
                        <label for="bw">Đen trắng</;>
                    </li>
                    <li class="pr-2">
                        <input type="radio" name="scanColor" id="gray" value="TWPT_GRAY">
                        <label for="gray">Xám</;>
                    </li>
                    <li class="pr-2">
                        <input type="radio" name="scanColor" id="color" value="TWPT_RGB" checked>
                        <label for="color">Màu</;>
                    </li>
                </ul>
    
                {{-- Chọn độ phân giải scan --}}
                <div class="scanner_resolution mb-2">
                    <span class="scanner_resolution-title pr-1">Độ phân giải (DPI)</span>
                    <select class="scanner_resolution-select" id="resolution" name="resolution" style="width: 170.067px">
                        <option>300</option>
                        <option>200</option>
                        <option>150</option>
                        <option>100</option>
                    </select>
                </div>
    
                {{-- Chọn scan nhiều lần hay một lần một --}}
                <div class="scanner_pages">
                    <span class="scanner_pages-more">
                        <input type="radio" name="scanner_prompt" id="prompt_scan_more" value="more">
                        <label for="prompt_scan_more">Scan nhiều tệp</label>
                    </span>
                    <span class="scanner_pages-less">
                        <input type="radio" name="scanner_prompt" id="prompt_scan_less" value="less" checked>
                        <label for="prompt_scan_less">Scan một tệp một</label>
                    </span>
                </div>
    
                <di class="d-flex">
                    {{-- Bắt đầu scan --}}
                    <span id="start_scanner" class="pr-1"></span>
    
                    {{-- Xóa scan --}}
                    <span id="clear_scanner" class="pl-1"></span>
                </di >
    
                {{-- Tải plugin (Chỉ hiện khi chưa cài plugin) --}}
                <span class="download_button">
                    <a download="htnpluggin.exe" href="htnpluggin.exe" class="download_plugin btn btn-danger btn-sm mt-2 text-white">Tải plugin và cài đặt trước khi sử dụng</a>
                </span>
                <div id="current_direct_path" style="user-select: none; visibility: hidden;">{{getcwd()}}</div>
            </div>
        </div>
        {{-- Mục tải lên, sẽ hiển thị sau khi scan xong --}}
        <div class="scanner_upload">
            <div class="upload_title pl-5">
                <h4 class="text-primary py-3 font-weight-normal mb-0">TẢI LÊN</h4>
            </div>
        </div>
        {{-- Các config khi upload --}}
        <div class="upload_config pl-5 my-4">
            {{-- Chọn định dạng muốn upload --}}
            {{-- <ul class="scanner_format mb-2 d-flex">
                <div class="scanner_format-title pr-2">Định dạng: </div>
                <li class="pr-2">
                    <input type="radio" name="scanFormat" id="scan_format-pdf" value="pdf" checked>
                    <label for="scan_format-pdf">PDF</;>
                </li>
                <li class="pr-2">
                    <input type="radio" name="scanFormat" id="scan_format-jpg" value="jpg">
                    <label for="scan_format-jpg">JPG</;>
                </li>
            </ul> --}}
            {{-- Lưu về máy, Tải lên --}}
            <div class="upload_select btn btn-primary btn-sm position-relative">
                <span class="upload_select-title">Tải file lên</span>
                <div class="upload_select-options position-absolute">
                    <span class="pl-1 py-1" data-toggle="modal" data-target="#exampleModalCenter">Kho lưu trữ</span>
                    <span class="pl-1 py-1" data-toggle="modal" data-target="#exampleModalCenter">File cá nhân</span>
                    <span class="pl-1 py-1" data-toggle="modal" data-target="#exampleModalCenter">File chia sẻ</span>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="model-heading d-flex py-3">
                            <span class="modal-title">Tải lên file đã quét</span>
                            <button type="button" class="close pr-2" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="model-body px-3 py-4">
                            <form action="{{route('upload_savefile')}}" method="POST">
                                <div class="d-flex justify-content-between mb-4">
                                    <span>Loại file</span>
                                    <select name="file_type" id="file_type" style="width: 88%;">
                                        <option value="Văn bản">Văn bản</option>
                                        <option value="Chưa xác định">Chưa xác định</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                  <label>Tên file</label>
                                  <input required type="text" name="upload_filename" id="upload_filename" style="width: 88%;">
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                  <label>Mô tả</label>
                                  <textarea rows="4" name="upload_filedesc" id="upload_filedesc" style="width: 88%;"></textarea>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <label>Nơi lưu</label>
                                    <input type="email" name="upload_filepath" id="upload_filepath" style="width: 88%;">
                                </div>
                                <button type="submit" onclick="alert('Lưu thành công')" class="btn btn-success btn-sm float-right">Xong</button>
                                @csrf
                              </form>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary btn-sm" onclick="">Lưu về máy</button>
        </div>
    </div>    
</div>

<script>
    // Get Element
    const scanned = document.getElementById('scanned');
    const scannerMachine = document.getElementById('scan_machine');
    const spinner = document.getElementById('spinner');
    const loader = document.getElementById('loader');
    const scannerButton = document.getElementById('start_scanner');
    const clearScannerButton = document.getElementById('clear_scanner');
    const currentPath = document.getElementById('current_direct_path').innerHTML;
    document.getElementById('current_direct_path').remove();

    // Bắt đầu scan
    function scanWithoutAspriseDialog() {
        let color, page;
        let sourceName = scannerMachine.value;
        let resolutionDPI = document.getElementById('resolution').value;
        let scanColors = document.querySelectorAll('input[name="scanColor"]');
        let scanPagesType = document.querySelectorAll('input[name="scanner_prompt"]');
        
        Array.from(scanColors).forEach(item => {if(item.checked) color = item.value;})
        Array.from(scanPagesType).forEach(item => {if(item.checked) page = item.value;})

        if(sourceName && resolutionDPI) {
            // Cài đặt config cho máy scan
            scanner.scan(displayImagesOnPage,
                    {
                        "prompt_scan_more": page === 'less' ? false : true,
                        'source_name': `${sourceName}`,
                        "use_asprise_dialog": false,
                        "output_settings": [
                            {
                                "type": "save",
                                "format": "pdf",
                                "save_path": `${currentPath}//storage//temp//temp-file.pdf`
                            },
                            {
                                "type": "return-base64",
                                "format": "pdf"
                            }
                        ],
                        "twain_cap_setting" : {
                            "ICAP_PIXELTYPE" : `${color}`, // Color
                            "ICAP_XRESOLUTION" : `${resolutionDPI}`, // DPI
                            "ICAP_YRESOLUTION" : `${resolutionDPI}`, // DPI
                            "ICAP_SUPPORTEDSIZES" : "TWSS_A4" // Paper size: TWSS_USLETTER, TWSS_A4, ...
                        },
                        "config": {
                            "scan_info_window_bring_front": false
                        }
                    }
            );
        }

    }

    // Xử lý hình ảnh sau khi scan
    function displayImagesOnPage(successful, mesg, response) {
        if(!successful) { // On error
            console.error('Failed: ' + mesg);
            return;
        }

        if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
            console.info('User cancelled');
            return;
        }

        var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
        for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
            var scannedImage = scannedImages[i];
            processScannedImage(scannedImage);
        }

    }

    // Lấy ra danh sách các máy scan đã được kết nối

    (() => {
        scanner.listSources(async (successful, mesg, result) => {
            let listSources = JSON.parse(result);
            let options = [];
            await listSources.forEach(item => item.connected && options.push(`<option>${item.ProductName}</option>`));
            if(options.length !== 0) {
                scannerMachine.innerHTML = options;
            } else {
                if(!document.querySelector('.download_plugin')) {
                    scannerMachine.innerHTML = `<option value="" disabled selected hidden">Chưa cài đặt plugin</option>`;
                } else {
                    scannerMachine.innerHTML = `<option value="" disabled selected hidden">Chưa kết nối máy scan</option>`;
                }
            }
            scannerLoading();
        }, false, "connected", true, false);
    })();

    // Kiểm tra xem đã kết nối thiết bị scan chưa
    function scannerLoading() {
        if(scannerMachine.value) {
            loader.classList.toggle('d-none');
            scannerButton.innerHTML = '<button type="button" class="d-block mt-2 btn btn-primary btn-sm" onclick="scanWithoutAspriseDialog();">Bắt đầu Scan</button>';
            clearScannerButton.innerHTML = '<button type="button" class="d-block mt-2 btn btn-danger btn-sm" onclick="clearScanner();">Xóa Scan</button>';
        } else {
            loader.classList.toggle('d-none');
            spinner.innerHTML = '<span class="close" style="float: none; color: red;">&times</span>';
        }
    }

    // Hình ảnh đã scan
    var imagesScanned = [];

    // Hiển thị ảnh lên trình duyệt
    function processScannedImage(scannedImage) {
        imagesScanned.push(scannedImage);
        scanned.src = scannedImage.src;
    }


    // Clear Scan
    function clearScanner() {
        scanned.src = '';
    }

    function uploadFile() {
        document.execCommand("SaveAs"); 
    }
</script>

@endsection
    