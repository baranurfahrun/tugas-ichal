<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanKelahiran extends Model
{
    protected $table = 'pengajuan_kelahiran';
    
    protected $fillable = [
        'faskes_id', 'user_id', 'nama_bayi', 'jenis_kelamin', 'tempat_lahir', 'tempat_dilahirkan',
        'tgl_lahir', 'jam_lahir', 'kelahiran_ke', 'jenis_kelahiran', 'penolong_kelahiran',
        'berat_bayi', 'panjang_bayi', 'agama', 'nama_ibu', 'nik_ibu', 'nama_ayah', 'nik_ayah',
        'nama_saksi_1', 'nik_saksi_1', 'nama_saksi_2', 'nik_saksi_2', 'no_kk', 'nama_kepala_keluarga', 'provinsi', 'kabupaten', 
        'kecamatan', 'kelurahan', 'rt', 'rw', 'file_ktp', 'file_kk', 'file_ket_lahir', 'file_buku_nikah', 'file_akta_lahir', 
        'status', 'keterangan_status'
    ];

    public function faskes()
    {
        return $this->belongsTo(Faskes::class);
    }

    protected $casts = [
        'file_ktp' => 'array',
        'file_akta_lahir' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
