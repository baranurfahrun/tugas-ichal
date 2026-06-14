<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akta extends Model
{
    protected $guarded = [];

    public function pengajuanKelahiran()
    {
        return $this->belongsTo(PengajuanKelahiran::class);
    }
}
