<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $files = Storage::files("public/uploads/{$user->id}");
        $fileNames = array_map(function ($file) {
            return basename($file);
        }, $files);

        return view('home', ['files' => $fileNames]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'uploadfile' => 'required|file|max:10240' // 10 MB max
        ]);

        $user = Auth::user();
        $path = $request->file('uploadfile')->store("public/uploads/{$user->id}");

        return redirect('/files');
    }

    public function view($filename)
    {
        $user = Auth::user();
        $path = "public/uploads/{$user->id}/{$filename}";

        if (!Storage::exists($path)) {
            abort(404);
        }

        $content = Storage::get($path);
        return response($content)->header('Content-Type', Storage::mimeType($path));
    }

    public function delete($filename)
    {
        $user = Auth::user();
        $path = "public/uploads/{$user->id}/{$filename}";

        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        return redirect('/files');
    }
}
