<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    public function index()
    {
        $students = Http::get('http://127.0.0.1:8000/api/students')->json();
        return view('index', compact('students'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'.'.$file->extension();
        }
        $student = Http::attach('image', file_get_contents($file), $filename)->post('http://127.0.0.1:8000/api/students', [
            'name' => $request->name,
            'email' => $request->email,
            'image' => $filename,
        ]);
        return redirect()->back();
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
