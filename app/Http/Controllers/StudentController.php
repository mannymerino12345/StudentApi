<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        return Student::all();
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'course' => 'required',
        ]);
        return Student::create($request->all());
    }
    
    public function show(Student $student) {
        return $student;
    }
    
    public function update(Request $request, Student $student) {
        $student->update($request->all());
        return $student;
    }

    public function destroy(Student $student) {
        $student->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
    
}
