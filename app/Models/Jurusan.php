<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $fillable = ['nama_kelas'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
