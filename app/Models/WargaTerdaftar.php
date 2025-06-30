<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WargaTerdaftar extends Model
{
    protected $table = 'warga_terdaftar';

    protected $fillable = ['nik', 'alamat', 'kelurahan'];

    public $timestamps = true;
}

