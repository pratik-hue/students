<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Models\StudentInfo;
use Laravel\Sanctum\PersonalAccessToken;
class StudentController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
           
            'enrollment_number' => 'required',
            'password' => 'required',
            'qualification' => 'required',
            'course' => 'required',
            'contact_number' => 'required',
        ]);
    
        // Create a new student record
        $student = new StudentInfo();
        $student->name = $request->input('name'); // Assuming there's a 'name' field in your table
        $student->email = $request->input('email');
        $student->enrollment_number = $request->input('enrollment_number');
        $student->password = $request->input('password');
        $student->qualification = $request->input('qualification');
        $student->course = $request->input('course');
        $student->contact_number = $request->input('contact_number');
        
        // Save the student record
        $student->save();
    
        // Return a success response
        return response()->json(['message' => 'Registration successful'], 201);
    }
    public function login(Request $request)
{
    $request->validate([
        'enrollment_number' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('enrollment_number', 'password');

    $student = StudentInfo::where('enrollment_number', $credentials['enrollment_number'])->first();

    if ($student && password_verify($credentials['password'], $student->password)) {
        $token = $student->createToken('student-token');
        return response()->json(['token' => $token->plainTextToken], 200);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
}

public function userProfile()
{
    // Get the authenticated user
    $user = Auth::user();

    // Check if the user exists
    if ($user) {
        // Return the user details
        return response()->json(['user' => $user], 200);
    }

    // If the user is not found or not authenticated, return an error
    return response()->json(['message' => 'User not found'], 401);
}
public function updateProfile(Request $request)
{
    $user = Auth::user();

    // Validate the update request data
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'enrollment_number' => 'required|string',
        'qualification' => 'required|string',
        'course' => 'required|string',
        'contact_number' => 'required|string',
        // Add other fields you want to update
    ]);

    // Update user profile
    $user->update($request->all());

    return response()->json(['message' => 'Profile updated successfully', 'user' => $user], 200);
}
public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Logout successful'], 200);
}



}
