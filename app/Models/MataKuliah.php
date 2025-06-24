<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'nama_matkul', 'kode_matkul', 'pengajar_id', 'semester',
    ]; //


    public function pengajar()
    {
        return $this->belongsTo(User::class, 'pengajar_id');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'mata_kuliah_id');
    }
}
