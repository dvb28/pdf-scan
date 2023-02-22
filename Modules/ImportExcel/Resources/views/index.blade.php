@extends('importexcel::layouts.master')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .import_root {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .import_module {
        display: inline-block;
        border: 1px solid rgba(171, 171, 171, 0.57);
        border-radius: 3px;
        padding: 20px 30px;
        margin: 20px
    }

    #import_file {
        display: inline-flex;
        flex-direction: column;
    }

    .import_box {
        border: 1px dashed #acacac;
        display: inline;
        padding: 3px;
        border-radius: 3px;
        width: 450px;
    }

    .form-label {
        margin: 0;
        width: 100%;
        padding: 8px 0;
        cursor: pointer;
    }

    .form-label .import_label--button {
        color: #1572e8;
        padding: 8px 20px;
        border: 1px solid rgb(233, 231, 231);
        border-radius: 3px;
    }

    .import_box--message_excel, .import_box--message_pdf {
        color: rgba(109, 109, 109, 0.57);
        margin: 0 12px;
    }

</style>

@section('content')
<div class="import_root">
    <div class="import_module">
        <div>
            <form id="import_file" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 import_box">
                    <label for="file_excel" class="form-label">
                        <span class="import_label--button">
                            <i class="fa-regular fa-file"></i>
                            <span class="pl-2">Tải file lên</span>
                        </span>
                        <span class="import_box--message_excel">File tải lên phải là file Excel</span>
                    </label>
                    <input class="form-control d-none" name="file_excel" type="file" id="file_excel">
                </div>
                <div class="mb-3 import_box">
                    <label for="file_pdf[]" class="form-label">
                        <span class="import_label--button">
                            <i class="fa-regular fa-folder"></i>
                            <span class="pl-2">Tải file lên</span>
                        </span>
                        <span class="import_box--message_pdf">File tải lên không được quá 1GB</span>
                    </label>
                    <input class="form-control d-none" name="file_pdf[]" type="file" id="file_pdf[]" directory webkitdirectory multiple="multiple">
                </div>
                <span>
                    <button type="submit" class="import_btn btn btn-primary">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <span class="px-2">Tải lên</span>
                    </button>
                </span>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="import_message_model modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="import_message_dialog modal-dialog modal-dialog-centered" role="document">
        <div class="import_message_content modal-content">
            <div class="import_message_body modal-body">
                <button type="button" class="close d-flex align-items-center" data-dismiss="modal" aria-label="Close">
                    <span class="close_import_model" style="font-size: 25px;" aria-hidden="true">&times;</span>
                </button>
                <div class="message_body-text"></div>
                <div class="d-flex justify-content-center">
                    <div id="spinner-border" class="spinner-border text-primary" style="font-size: 10px;width: 25px; height: 25px; display: none;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        // Các biến
        let excel_file, pdf_file;

        var ajaxValidate = {
            excel: false,
            pdf: false,
            message: ''
        }

        // Const
        const model = $('.import_message_model');
        const modelMessage = $('.message_body-text');
        const importBtn = $('.import_btn');
        const spinner = $("#spinner-border");
        const closeModel = $('.close_import_model');
        const pdfImportMessage = $('.import_box--message_pdf');
        const excelImportMessage = $('.import_box--message_excel');
        const inputExcel = $('input[name="file_excel"]');
        const inputPdf = $('input[name="file_pdf[]"]');

        function showModalMessage(type, message) {
            if(type === 'show') {
                modelMessage.text(message);
            }
            model.modal(type);
        }

        // Vòng gửi dữ liệu của Ajax
        $(document).on({
            // Bắt đầu gửi
            ajaxStart: function() {
                spinner.show();
                modelMessage.text('');
                model.modal('show');
            },
            // Kết thúc gửi
            ajaxStop: function() {
                spinner.hide();
                excelImportMessage.text('File tải lên phải là file Excel');
                pdfImportMessage.text('File tải lên không được quá 1GB');
            }
        })

        // Ajax Setup 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        
        // Validate khi chọn file excel
        $('input[name="file_excel"]').on('change', function(event) {

            // Lấy ra files excel và gán vào biến excel_import
            excel_file = inputExcel.get(0).files[0];
            
            // Validate khi chọn file excel
            if(excel_file) {
                if(!(excel_file.name.endsWith('.xls') || excel_file.name.endsWith('.xlsx'))) {
                    showModalMessage('show', 'Vui lòng tải lên file Excel');
                    excel_file = null;
                } else {
                    excelImportMessage.text(excel_file.name);
                }
            }

        })

        // Validate khi chọn file pdf
        $('input[name="file_pdf[]"]').on('change', function(event) {

            // Lấy ra files pdf và gán vào biến pdf_import
            pdf_file = inputPdf.get(0).files;

            // Validate khi chọn file pdf
            if(pdf_file.length != 0) {

                // Tính tổng size
                let sizes = Array.from(pdf_file).reduce((temp, item) => {
                    return temp += item.size;
                }, 0);
                

                // Kiểm tra dung tổng dung lượng file
                if(sizes > 1000000000) {
                    showModalMessage('show', 'Kích thước tổng các file PDF phải dưới 1G');
                    pdf_file = null;
                } else {
                    pdfImportMessage.text(`Đã tải lên ${pdf_file.length} files`);
                }

            }
        })

        // Sự kiện khi submit
        $('#import_file').on('submit', function(event) {
            
            // Dừng hoạt động submit mặc định của thẻ form
            event.preventDefault();

            // Hàm xử lý nếu validate thành công
            if(excel_file && pdf_file) {

                // Tạo đối tượng formData để gửi dữ liệu
                let formData = new FormData();

                // Add các file vào formData để gửi đi
                // Thêm file excel vào formData
                formData.append('file_excel', excel_file);

                // Thêm file pdf vào formData
                pdf_file.length > 0 && Array.from(pdf_file).forEach(item => {
                    formData.append('file_pdf[]', item);
                });

                // Thêm token để gửi file
                formData.append('_token', '{{ csrf_token() }}');

                // Gửi file excel bằng Ajax

                $.ajax({
                    url: '{{ route('submit-data') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {

                        let html;
                        // Nếu validate thành công, submit form
                        if(data.hasError) {
                            modelMessage.html(`
                                <div>Đã import thành công ${pdf_file.length - data.hasError}</div>
                                <div>Bị lỗi ${data.hasError} file! Vui lòng kiểm tra lại</div>
                            `);
                        } else {
                            modelMessage.html(`<div>Import thành công ${pdf_file.length} file</div>`);
                            setTimeout(() => {
                                model.modal('hide');
                            }, 1000);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Hiển thị lỗi validation
                        let err = JSON.parse(xhr.responseText);

                        let errMessages = err.errorMessage;

                        let errResult;

                        // Nếu có lỗi từ server thì in ra
                        if(err.validateFormError === true) {
                            if(errMessages['file_excel']) {
                                modelMessage.html(`<div>${errMessages['file_excel'].join('')}</div>`)
                            }
                        }
                        // Nếu có lỗi thư mục thì in ra
                        if(err.dirError) {
                            err.dirError && modelMessage.html(`<div>${err.dirError}</div>`)
                        }
                        
                    }
                })

            } else {
                showModalMessage('show', 'Vui lòng kiểm tra lại các file tải lên');
            }
        })
    })
</script>
@endsection

