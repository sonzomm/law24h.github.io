<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorevideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'file_upload' => 'required',
            'noidung' => 'required'
        ];
    }
    public  function messages()
    {
        return[
            'required'=>':attributes không được để trống',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Name',
            'file_upload' => 'File',
            'noidung' => 'Nội dung'
        ];
    }
}
