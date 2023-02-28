$(document).ready(function() {
    // Các biến
    let excel_file, pdf_file;

    // Const
    const model = $('.import_message_model');
    const modelMessage = $('.message_body-text');
    const spinner = $("#spinner-border");
    const modalLoadingImport = $('.modal_loading-import');
    const pdfImportMessage = $('.import_box--message_pdf');
    const excelImportMessage = $('.import_box--message_excel');
    const inputExcel = $('input[name="file_excel"]');
    const inputPdf = $('input[name="file_pdf[]"]');

    // Vòng gửi dữ liệu của Ajax
    $(document).on({
        // Bắt đầu gửi
        ajaxStart: function() {
            modalLoadingImport.show();
            model.modal('show');
        },
        // Kết thúc gửi
        ajaxStop: function() {
            modalLoadingImport.hide();
            excelImportMessage.text('Tải lên file Excel có định dạng .xlsx hoặc .xls');
            pdfImportMessage.text('Tải lên các file PDF, tổng dung lượng phải dưới 1G');
        }
    })

    // Ajax Setup 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    
    // Hàm show ra thông báo lỗi
    function showErrorNotify(option, settings) {
        $.notify({
            icon: 'fa-solid fa-exclamation',
            title: 'Thông báo',
            ...option,
        }, {
            z_index: 9999,
            type: 'danger',
            ...settings
        });
    }

    // Hàm show ra thông báo lỗi
    function showSuccessNotify(option, settings) {
        $.notify({
            icon: 'fa-solid fa-check',
            title: 'Thông báo',
            ...option,
        }, {
            z_index: 9999,
            type: 'success',
            ...settings
        });
    }

    // Validate khi chọn file excel
    $('input[name="file_excel"]').on('change', function(event) {

        // Lấy ra files excel và gán vào biến excel_import
        excel_file = inputExcel.get(0).files[0];
        
        // Validate khi chọn file excel
        if(excel_file) {
            excelImportMessage.text(excel_file.name);
            if(!(excel_file.name.endsWith('.xls') || excel_file.name.endsWith('.xlsx'))) {
                showErrorNotify({
                    message: 'Vui lòng tải lên file Excel'
                });
                excel_file = null;
            }
        }

    })

    // Validate khi chọn file pdf
    $('input[name="file_pdf[]"]').on('change', function(event) {

        // Lấy ra files pdf và gán vào biến pdf_import
        pdf_file = inputPdf.get(0).files;

        // Validate khi chọn file pdf
        if(pdf_file.length != 0) {

            pdfImportMessage.text(`Đã tải lên ${pdf_file.length} files`);

            // Tính tổng size
            let sizes = Array.from(pdf_file).reduce((temp, item) => {
                return temp += item.size;
            }, 0);
            

            // Kiểm tra dung tổng dung lượng file
            if(sizes > 1000000000) {
                showErrorNotify({
                    message: 'Kích thước tổng các file PDF phải dưới 1G'
                })
                pdf_file = null;
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

            // Lấy ra token đẻ gửi dữ liệu
            let submitToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Add các file vào formData để gửi đi
            // Thêm file excel vào formData
            formData.append('file_excel', excel_file);

            // Thêm file pdf vào formData
            pdf_file.length > 0 && Array.from(pdf_file).forEach(item => {
                formData.append('file_pdf[]', item);
            });

            // Thêm token để gửi file
            formData.append('_token', submitToken);

            // Gửi file excel bằng Ajax
            $.ajax({
                url: 'importexcel/submit-data',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {

                    // Nếu validate thành công, submit form
                    if(data.hasError) {
                        showSuccessNotify({
                            message: `Import thành công ${pdf_file.length - data.hasError} / ${pdf_file.length} files, bị lỗi ${data.hasError} file!`
                        });
                    } else {
                        showSuccessNotify({
                            message: `Import thành công ${pdf_file.length} / ${pdf_file.length} files`
                        })
                        setTimeout(() => {
                            model.modal('hide');
                        }, 1000);
                    }
                },
                error: function(xhr) {
                    // Hiển thị lỗi validation
                    let err = JSON.parse(xhr.responseText);

                    let errMessages = err.errorMessage;

                    // Nếu có lỗi từ server thì in ra
                    if(err.validateFormError === true) {
                        if(errMessages['file_excel']) {
                            showErrorNotify({
                                message: errMessages['file_excel'].join('')
                            })
                        }
                    }
                    // Nếu có lỗi thư mục thì in ra
                    if(err.dirError) {
                        err.dirError && showErrorNotify({message: err.dirError})
                    }
                    
                }
            })
        } else {
            showErrorNotify({
                message: 'Vui lòng kiểm tra lại các file tải lên'
            } )
        }
    })
});