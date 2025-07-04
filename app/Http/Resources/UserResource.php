<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "nama" => $this->nama,
            "email" => $this->email,
            "role" => $this->role,
            $this->mergeWhen($this->role === 'mahasiswa', [
                'nim' => $this->nim_nip,
                'kelas' => $this->whenLoaded('kelas',function(){
                    return $this->kelas ? $this->kelas->nama_kelas :null;
                }),
                'jurusan' => $this->whenLoaded('jurusan',function(){
                    return $this->jurusan ? $this->jurusan->nama_jurusan : null;
                }),
            ]),
            $this->mergeWhen($this->role === 'dosen', [
                'nip' => $this->nim_nip,
            ]),

            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),
        ];
    }
}
