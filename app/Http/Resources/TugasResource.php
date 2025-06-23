<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TugasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "mata_kuliah_id" => $this->mata_kuliah_id,
            "pengajar_id" => $this->pengajar_id,
            "deskripsi" => $this->deskripsi,
            "file_tugas" => $this->whenNotNull($request->file_tugas),
        ];
    }
}
