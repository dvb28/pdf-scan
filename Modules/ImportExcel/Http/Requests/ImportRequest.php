<?php

namespace Modules\ImportExcel\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ImportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file_excel' => 'required|mimes:xlsx,xls|max:200',
            'file_pdf.*' => 'required|max:1000000000'
        ];
    }


    public function messages() {
        return [
            'file_excel.required' => 'Vui lòng tải lên file Excel',
            'file_excel.mimes' => 'File tải lên phải là file Excel có định dạng .xlsx hoặc .xls',
            'file_pdf.*.required' => 'Vui lòng tải lên thư mục chứa file pdf',
            'file_pdf.*.max' => 'Tổng dung lượng các file pdf tải lên không được quá 1Gb',
            'file_excel.max' => 'Dung lượng file Excel không được quá 200Kb',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(
             [
                 'validateFormError' => true,
                 'errorMessage'=> $validator->messages()
             ], 422
            )
        );
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
