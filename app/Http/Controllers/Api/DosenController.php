<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddTaskRequest;
use App\Http\Resources\TugasResource;
use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
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

    public function addTask(AddTaskRequest $request)
    {
        $request->validated();
        $path = null;

        if($request->file_tugas)
        {
            $path = $request->file("file_tugas")->store('tugas','public');
        }

        $tugas = Tugas::create([
            "mata_kuliah_id" => $request->mata_kuliah_id,
            "pengajar_id" => Auth::user()->id,
            "deskripsi" => $request->deskripsi,
            "deadline" => $request->deadline,
            "file_tugas" => $path,
        ]);

        return $this->successResponse(new TugasResource($tugas),"Tugas berhasil dibuat.",Response::HTTP_CREATED);
    }
}
