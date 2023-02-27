@extends('importexcel::layouts.master')

@section('content')

<!-- Bootstrap Notify -->
<style>
  .input-group-text {
    width: 45px;
  }

  .import_box--message_excel, .import_box--message_pdf {
    font-size: 13.5px;
    padding-left: 10px;
  }
</style>

<!-- Nút bấm để show modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Show Modal
</button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="caret-color: transparent;">
        <div class="modal-header d-flex justify-content-center">
          <p class="modal-title" id="exampleModalLabel">Tải file lên</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="position-relative">
            <div style="display: none; z-index: 999;" class="modal_loading-import bg-white w-100 h-100 position-absolute">
              <div class="d-flex justify-content-center align-items-center h-100">
                <span class="loader loader-primary"></span>
              </div>
            </div>
            <form id="import_file" enctype="multipart/form-data">
                @csrf
                {{-- Input Files --}}
                <div class="mb-3 import_box input-group">
                  <label for="file_excel" class="input-group-prepend mb-0 w-100">
                    <span class="input-group-text">
                      <i class="fa-regular fa-file"></i>
                    </span>
                    <span class="import_box--message_excel border border-left-0 w-100 py-2">Tải lên file Excel có định dạng .xlsx hoặc .xls</span>
                  </label>
                  <input class="form-control d-none" name="file_excel" type="file" id="file_excel">
                </div>
                {{-- Input Folder --}}
                <div class="mb-3 import_box input-group">
                  <label for="file_pdf[]" class="input-group-prepend mb-0 w-100">
                    <span class="input-group-text">
                      <i class="fa-regular fa-folder"></i>
                    </span>
                    <span class="import_box--message_pdf border border-left-0 w-100 py-2">Tải lên các file PDF, tổng dung lượng phải dưới 1G</span>
                  </label>
                  <input class="form-control d-none" name="file_pdf[]" type="file" id="file_pdf[]" directory webkitdirectory multiple="multiple">
                </div>
                <span class="d-flex justify-content-end">
                    <button type="submit" class="import_btn btn btn-primary">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <span class="px-2">Tải lên</span>
                    </button>
                </span>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{mix('/Modules/ImportExcel/Resources/assets/js/app.js')}}"></script>
@endsection
