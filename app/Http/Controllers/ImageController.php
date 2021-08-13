<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request) {
        $path = Storage::putFile('public', $request->file('image'));
        $path = Storage::url($path);
        return $path;
    }
}
