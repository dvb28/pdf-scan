import { saveAs } from 'file-saver';

$(document).ready(function() {

    
    // Tạo Quill Editor
    var quill = new Quill('#editor', {
        modules: {
            imageResize: {
                displaySize: true
            },
            toolbar: {
                container:
                [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'], 
                    [{ 'size': [ ] }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['link', 'image'],
                    ['blockquote', 'code-block'],
                    [{ 'header': 1 }, { 'header': 2 }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'direction': 'rtl' }],
                    [{ 'font': [] }],
                    [{ 'align': [] }],
                    ['download'],
                    ['clean'],
                ]
            }
        },
        placeholder: 'Nhập nội dung...',
        theme: 'snow'
    });
    
    const qlDownload = $('.ql-download');
    // Thêm icon cho qlDownload
    qlDownload.html("<i class='fa-solid fa-download'></i>");

    const createfileBtn = $('.createfile_btn');
    const editorFileName = $('input[name="editor-filename"]');
    const editorFileType = $('select[name="editor-filetype"] option:selected');
    
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
    
    // Sự kiện tải xuống file 
    // Tải file đã tạo về máy
    qlDownload.on('click', function(e) {
        if(editorFileName.val()) {
            // Tải file xuống
            const quillContent = quill.getContents();
            
            let jsonString = JSON.stringify(quillContent);
            
            var blog = new Blob([jsonString], {type: 'aplication/json'});
    
            saveAs(blog, `${editorFileName.val()}.editor`);

            showSuccessNotify({message:'Tải xuống file thành công!'});
        } else {
            showErrorNotify({message: "Vui lòng nhập tên file muốn lưu!"});
        }
    });

    // Ajax Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    // Vòng gửi dữ liệu của Ajax
    $(document).on({
        // Bắt đầu gửi
        ajaxStart: function() {},
        // Kết thúc gửi
        ajaxStop: function() {

        }
    })

    // Tạo file và import lên database
    createfileBtn.on('click', function(e) {

        e.preventDefault();

        if(editorFileName.val()) {
            
            // Tạo đối tượng formData để gửi dữ liệu
            let formData = new FormData();

            // Thêm dữ liệu vào formData
            formData.append('editor-filename', editorFileName.val());
            formData.append('editor-filetype', editorFileType.val());


            console.log(formData)
            // Gửi dữ liệu đi bằng ajax
            $.ajax({
                url: 'createfile/create',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    showSuccessNotify({message: 'Tạo file thành công!'})

                },
                error: function(xhr) {
                    showErrorNotify({message: 'Tạo file thất bại, vui lòng kiểm tra lại'})
                }
            });
        } else {
            showErrorNotify({message: "Vui lòng nhập tên file muốn lưu!"});
        }
    });
})