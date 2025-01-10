<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mahasiswa',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'foto',
    ];
}
