<?php

namespace App\Services;

use File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
class UploadFileService
{
   public function uploadSertifikat(UploadedFile $uploadedFile, $filename = null){
    $filename = is_null($filename) ? Str::random(10).Str::uuid() : $filename;

    $path = 'peserta/sertifikat';
    return $uploadedFile->storeAs($path,$filename.'.'.$uploadedFile->getClientOriginalExtension(),'public');

   }
}
