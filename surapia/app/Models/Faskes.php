<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faskes extends Model
{
    protected $table = 'faskes';
    protected $fillable = ['nama_faskes', 'kode_faskes', 'tipe', 'alamat'];

    public function pengajuanKelahirans()
    {
        return $this->hasMany(PengajuanKelahiran::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
