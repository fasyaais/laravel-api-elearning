<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hashedPassword = bcrypt("password");
        User::create([
            "nama" => "Mahasiswa",
            "email" => "mahasiswa@email.com",
            "password" => $hashedPassword,
            "role" => "mahasiswa",
            "nim_nip" => "1062200",
            "kelas" => "3TRPLA",
            'Jurusan' => "INFORMATIKA DAN BISNIS"
        ]);
        User::create([
            "nama" => "Dosen",
            "email" => "dosen@email.com",
            "password" => $hashedPassword,
            "role" => "dosen",
            "nim_nip" => "123456789",
        ]);
        User::create([
            "nama" => "Admin",
            "email" => "admin@email.com",
            "password" => $hashedPassword,
            "role" => "admin",
        ]);
    }
}
