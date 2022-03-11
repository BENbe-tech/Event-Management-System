<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class StorageFileController extends Controller
{
    //
    public function getPubliclyStorgeFile($filename)

{
    $path = storage_path('app/public/image/'. $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);

    $response->header("Content-Type", $type);

    return $response;

}
}
