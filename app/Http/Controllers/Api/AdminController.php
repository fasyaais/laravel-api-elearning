<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddMatkulRequest;
use App\Http\Requests\StoreMahasiswaPengajarRequest;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\StorePengajarRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\JurusanResource;
use App\Http\Resources\KelasResource;
use App\Http\Resources\MataKuliahResource;
use App\Http\Resources\UserResource;
use App\Models\Kelas;
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
            'kelas_id' => $request->kelas_id,
            'jurusan_id' => $request->jurusan_id,
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
        $existMatkul = MataKuliah::where('nama_matkul',$request->nama_matkul)
                            ->orWhere('kode_matkul',$request->kode_matkul)
                            ->exists();
        if($existMatkul){
            return $this->errorResponse("Mata kuliah sudah ada", Response::HTTP_CONFLICT);
        }
        $data = MataKuliah::create($request->all());
        return $this->successResponse(new MataKuliahResource($data),"Berhasil membuat mata kuliah",Response::HTTP_CREATED);
    }

    public function addKelas(Request $request)
    {
        $req=$request->validate([
            'nama_kelas' => 'required|string'
        ]);

        $kelas = Kelas::create($req);
        return $this->successResponse(new KelasResource($kelas),"Berhasil menambahkan kelas",Response::HTTP_CREATED);
    }
    public function addJurusan(Request $request)
    {
        $req=$request->validate([
            'nama_jurusan' => 'required|string'
        ]);

        $kelas = Kelas::create($req);
        return $this->successResponse(new JurusanResource($kelas),"Berhasil menambahkan jurusan",Response::HTTP_CREATED);
    }


    public function showAllMahasiswa(){

        // $perPage = request()->input('per_page') ?? 15;

        $mahasiswa = User::where('role','mahasiswa')
                        ->get();
        // $data = UserResource::collection($mahasiswa);
        return $this->successResponse($mahasiswa,"Semua data mahasiswa");
    }
    public function showAllDosen(){
        $mahasiswa = User::where('role','dosen')
                        ->get();
        return $this->successResponse($mahasiswa,"Semua data dosen");
    }

    public function showAllAdmin(){
        $mahasiswa = User::where('role','admin')
                        ->get();
        return $this->successResponse($mahasiswa,"Semua data admin");
    }

    public function showAllKelas()
    {
        $kelas = Kelas::all();
        $data = KelasResource::collection($kelas);
        return $this->successResponse($data,"Semua data kelas");
    }
}
