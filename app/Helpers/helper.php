<?php

use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

function unslugWithCapitalize($string){
    return implode(' ', array_map('ucfirst', explode('_', $string)));
}

function arrayFilterNullData($array){
    return array_filter($array, function ($value, $key) {
        return $value !== null || $value === 0;
    }, ARRAY_FILTER_USE_BOTH);
}

function removeSession($session){
    if(\Session::has($session)){
        \Session::forget($session);
    }
    return true;
}

function randomString($length,$type = 'token'){
    if($type == 'password')
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    elseif($type == 'username')
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    else
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $token = substr( str_shuffle( $chars ), 0, $length );
    return $token;
}

function activeRoute($route, $isClass = false): string
{
    $requestUrl = request()->fullUrl() === $route ? true : false;

    if($isClass) {
        return $requestUrl ? $isClass : '';
    } else {
        return $requestUrl ? 'active' : '';
    }
}

function checkRecordExist($table_list,$column_name,$id){
    if(count($table_list) > 0){
        foreach($table_list as $table){
            $check_data = \DB::table($table)->where($column_name,$id)->count();
            if($check_data > 0) return false ;
        }
        return true;
    }
    return true;
}

// Model file save to storage by spatie media library
function storeFileMedia($file, $path, $name = null)
{
    if($file) {
        $filenameWithExt = $file->getClientOriginalName();
        if($name != null) {
            $filename = $name;
        } else {
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        }
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $file->storeAs($path,$fileNameToStore);
    }
    return $path;
}

function storeBase64Image($base64Data, $path, $name = null)
{
    if (!empty($base64Data)) {
        // Decode data base64 menjadi binary
        $decodedImage = base64_decode($base64Data);

        // Tentukan nama file
        if ($name !== null) {
            $filename = $name.'_'.time();
        } else {
            $filename = 'image_'.time();
        }

        // Tentukan ekstensi file (misalnya, JPEG)
        $extension = 'jpg'; // Anda dapat mengganti ini sesuai dengan jenis gambar yang diharapkan

        // Gabungkan nama file dan ekstensi
        $fileNameToStore = $filename . '.' . $extension;

        // Simpan file ke folder storage dengan nama yang diinginkan
        Storage::disk('local')->put('public/' . $path . '/' . $fileNameToStore, $decodedImage);

        // Kembalikan path lengkap ke file yang telah disimpan
        return $path . '/' . $fileNameToStore;
    }

    return null;
}

// Model file save to storage by spatie media library
function getFileMedia($file_path)
{
    return asset('storage/'.$file_path);
}

// Model file get by storage by spatie media library
function getSingleMedia($model, $collection = 'image_icon',$skip=true)
{
    if (!\Auth::check() && $skip) {
        return asset('images/avatars/01.png');
    }
    if ($model !== null) {
        $media = $model->getFirstMedia($collection);
    }
    $imgurl= isset($media)?$media->getPath():'';
    if (file_exists($imgurl)) {
        return $media->getFullUrl();
    }
    else
    {
        switch ($collection) {
            case 'image_icon':
                $media = asset('images/avatars/01.png');
                break;
            case 'profile_image':
                $media = asset('images/avatars/01.png');
                break;
            default:
                $media = asset('images/common/add.png');
                break;
        }
        return $media;
    }
}

// File exist check
function getFileExistsCheck($media)
{
    $mediaCondition = false;
    if($media) {
        if($media->disk == 'public') {
            $mediaCondition = file_exists($media->getPath());
        } else {
            $mediaCondition = \Storage::disk($media->disk)->exists($media->getPath());
        }
    }
    return $mediaCondition;
}

// Hide email information
function hideEmail($email)
{
    $explode = explode('@', $email);
    $stringLength = strlen($explode[0]);
    $explode[0] = substr($explode[0], 0, 2) . str_repeat('*', $stringLength - 2);
    return implode('@', $explode);
}

// Hide email information
function hidePhoneNumber($phoneNumber)
{
    $stringLength = strlen($phoneNumber);
    return str_repeat('*', $stringLength - 3) . substr($phoneNumber, -3);
}

// Convert number to rupiah format
function convertToRupiah(int|float $number, int $decimal = 0)
{
    return 'Rp ' . convertToDecimal($number, $decimal);
}

function convertToDecimal(int|float $number, int $decimal = 0)
{
    return number_format($number, $decimal, ',' , '.');
}

function formatSimpleNumber($number)
{
    if ($number >= 1000000000) {
        return round($number / 1000000000, 2) . 'B';
    } elseif ($number >= 1000000) {
        return round($number / 1000000, 2) . 'M';
    } elseif ($number >= 1000) {
        return round($number / 1000, 2) . 'K';
    }

    return $number;
}

function isValidHttpStatus(int $code) : bool {
    return array_key_exists($code, Response::$statusTexts);
}

function getColorStatusBadge($status) {
    $colors = [
        'pending' => 'warning',
        'paid' => 'success',
        'success' => 'success',
        'failed' => 'danger',
        'expired' => 'dark',
        'rejected' => 'danger',
    ];

    if(isset($colors[$status])) {
        return $colors[$status];
    }

    return 'secondary';
}

function generateRandomString($length)
{
    return substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', $length)), 0, $length);
}
