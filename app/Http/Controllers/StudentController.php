<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\WordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function showRegisterForm()
    {
        return view('students.register');
    }
    public function dashboard()
    {
        $user = auth()->guard('student')->user();

        $words = $user->words;

        $myRequests = WordRequest::with('word')
            ->where('student_id', $user->id)
            ->latest()
            ->get();

        $incomingRequests = WordRequest::with('word', 'student')
            ->whereHas('word', function ($q) use ($user) {
                $q->where('student_id', $user->id);
            })
            ->where('status', 'pending_owner')
            ->latest()
            ->get();

        return view('students.dashboard', compact(
            'user',
            'words',
            'myRequests',
            'incomingRequests',
        ));
    }
    public function show()
    {
        $user = auth()->guard()->user();
        $students = Student::where('id', $user->id)->get();
        return view('students.index', compact('students'));
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('student')->login($student);

        return redirect()->route('dashboard');
    }

    public function showLoginForm()
    {
        return view('students.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('student')->attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('login');
    }
}
