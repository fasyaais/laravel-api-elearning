<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddMatkulRequest;
use App\Http\Requests\StoreMahasiswaPengajarRequest;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\StorePengajarRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\MataKuliah;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addMahasiswa(StoreMahasiswaRequest $request)
    {
        $request->validated();
        $hashedPassword = bcrypt($request->password);
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $hashedPassword,
            'role' => "mahasiswa",
            'nim_nip' => $request->nim,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
        ]);

        return $this->successResponse(new UserResource($user),"Berhasil menambahkan mahasiswa",Response::HTTP_CREATED);
    }
    /**
     * Tambah Pengajar
     */
    public function addPengajar(StorePengajarRequest $request)
    {
        $request->validated();
        $hashedPassword = bcrypt($request->password);
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $hashedPassword,
            'role' => "dosen",
            'nim_nip' => $request->nip,
        ]);

        return $this->successResponse(new UserResource($user),"Berhasil menambahkan mahasiswa",Response::HTTP_CREATED);
    }

    public function addMatkul(AddMatkulRequest $request)
    {
        $request->validated();

        $jadwal = $request->hari .', '. $request->jam;
        $alreadyJadwal = MataKuliah::with('pengajar')->where("jadwal",'jadwal')->exists();
        if($jadwal){
            return $this->errorResponse('');
        }
    }
}
