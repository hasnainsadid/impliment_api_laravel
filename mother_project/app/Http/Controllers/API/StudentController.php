<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::get();
        if (count($students) > 0) {
            return StudentResource::collection($students);
        } else {
            return response()->json([
               'message' => 'No Students Found'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        // $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/students'), $filename);
        }
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $filename,
        ]);

        return response()->json([
            'message' => 'Student Created Successfully',
            'data' => new StudentResource($student)
        ], 201);
    }

    public function show(string $id)
    {
        return new StudentResource(Student::find($id));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
               'message' => 'Validation Error',
                'errors' => $validatedData->errors()
            ], 422);
        }

        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/students'), $filename);
        }

        $student = Student::find($id);
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $filename,
        ]);
        return response()->json([
            'message' => 'Student Updated Successfully',
            'data' => new StudentResource($student)
        ]);

    }

    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->delete();
        return response()->json([
           'message' => 'Student Deleted Successfully'
        ], 200);
    }
}
