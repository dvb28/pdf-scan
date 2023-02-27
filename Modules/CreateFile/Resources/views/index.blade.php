@extends('createfile::layouts.master')

@section('content')

    <style>

        .createfile_editor {
            flex: 1;
        }

        .createfile {
            display: flex;
        }

        .ql-editor {
            height: 100vh;
        }

    </style>

    <div class="d-flex">
        <div class="createfile_editor">
            <div id="editor"></div>
        </div>
        <form method="POST" id="createfile_upload" class="px-4 mx-3">
            @csrf
            <div class="form-group px-0">
                <label for="squareSelect">Loại tài liệu</label>
                <select name="editor-filetype" class="form-control input-square d-inline" id="squareSelect">
                    <option value="editor">Chưa xác định</option>
                    <option value="doc">Văn bản</option>
                </select>
            </div>
            <div class="form-group px-0">
                <label for="squareInput">Tên tài liệu</label>
                <input type="text" name="editor-filename" class="form-control input-square" id="squareInput" placeholder="Nhập tên tài liệu">
            </div>
            <div class="d-flex justify-content-end mt-2">
                <button class="createfile_btn btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    <span class="pl-1">Tạo tài liệu</span>
                </button>
            </div>
        </form>
    </div>
    <script type="module" src="{{mix('/Modules/CreateFile/Resources/assets/js/app.js')}}"></script>
@endsection
