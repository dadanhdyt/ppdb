<?php

namespace App\Models;

use App\StatusVerifikasiEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory,
    HasUuids;
    protected $guarded = [];
    protected $casts = [
        'status_verifikasi' => StatusVerifikasiEnum::class,
    ];
     public function user(){
        return $this->belongsTo(User::class);
    }
    public function dataPeserta(){
        return $this->hasOne(DataPeserta::class);
    }
    public function dataOrangTua(){
        return $this->hasMany(DataOrangTua::class);
    }
    public function getJalur(){
        return "PRESTASI";
    }
}
