<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataOrangTua extends Model
{
    use HasFactory,
    HasUuids;
    protected $guarded = [];
    public function pendaftaran(){
        return $this->belongsTo(Pendaftaran::class);
    }
}
