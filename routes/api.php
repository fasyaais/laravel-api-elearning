<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DosenController;
use Illuminate\Support\Facades\Route;

Route::post("/login",[AuthController::class,'login']);
Route::middleware("auth:sanctum")->get("profile",[AuthController::class,'profile']);

Route::middleware(["auth:sanctum","role:admin"])->prefix("admin")->group(function(){
    Route::post('tambah-mahasiswa', [AdminController::class,'addMahasiswa']);
    Route::post('tambah-dosen', [AdminController::class,'addMahasiswa']);
    Route::post('tambah-matakul', [AdminController::class,'addMahasiswa']);
});

Route::middleware(["auth:sanctum","role:dosen"])->prefix("dosen")->group(function(){
    Route::post('tambah-tugas', [DosenController::class,'addTask']);
});
