<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentInfo;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'email' => 'required|email|unique:student_info',
                'enrollment_number' => 'required|unique:student_info',
                'password' => 'required|min:6',
                'qualification' => 'required',
                'course' => 'required',
                'contact_number' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()->first()], 422);
        }

        // Create a new student record
        $student = new StudentInfo();
        $student->email = $validatedData['email'];
        $student->enrollment_number = $validatedData['enrollment_number'];
        $student->password = Hash::make($validatedData['password']);
        $student->qualification = $validatedData['qualification'];
        $student->course = $validatedData['course'];
        $student->contact_number = $validatedData['contact_number'];
        
        // Save the student record
        $student->save();

        // Return a success response
        return response()->json(['message' => 'Registration successful'], 201);
    }

}
