<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    

    public function store(Request $request)
    {
        // Log incoming request data
        Log::info('Incoming Request Data: ', $request->all());

        // Validate the data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'course' => 'required',
        ]);

        // Attempt to create the student
        try {
            $student = Student::create($request->all());

            // Log successful creation
            Log::info('Student Created: ', $student->toArray());

            return response()->json([
                'message' => 'Student created successfully!',
                'student' => $student
            ], 201);
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Error creating student: ' . $e->getMessage());
            return response()->json(['message' => 'Error creating student'], 500);
        }
    }



    public function show(Student $student)
    {
        return $student;
    }

    public function update(Request $request, Student $student)
    {
        $student->update($request->all());
        return $student;
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

}
