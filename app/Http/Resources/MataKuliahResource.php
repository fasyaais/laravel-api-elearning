<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MataKuliahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "nama_matkul" => $this->nama_matkul,
            "kode_matkul" => $this->kode_matkul,
            "pengajar_id" => $this->pengajar_id,
            "semester" => $this->semester,
        ];
    }
}
