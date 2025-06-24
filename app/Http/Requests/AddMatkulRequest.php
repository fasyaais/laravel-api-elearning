<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMatkulRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nama_matkul" => "required|string",
            "kode_matkul" => "required|unique:mata_kuliah,kode_matkul",
            "pengajar_id" => "required|exists:users,id",
            "semester" => "required|integer",
        ];
    }
}
