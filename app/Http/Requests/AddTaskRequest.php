<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTaskRequest extends FormRequest
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
            "mata_kuliah_id"=>"required|exists:mata_kuliah,id",
            "deskripsi" => "required|string",
            "deadline" => "required|date",
            "file_tugas" => "nullable|file|mimes:pdf,doc,docx,ppt,pptx,excel,csv"
        ];
    }
}
