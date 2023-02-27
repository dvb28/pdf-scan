<?php

namespace Modules\CreateFile\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Exceptions\HttpResponseException;

class CreateFileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'editor-filename' => 'required|string'
        ];
    }

    public function messages() {
        return [
            'editor-filename.required' => 'Vui lòng nhập tên file muốn lưu!',
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
