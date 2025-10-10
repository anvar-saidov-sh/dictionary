<?php

namespace App\Http\Controllers;

use App\Models\Scholars;
use App\Models\WordRequest;
use App\Models\Words;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ScholarsController extends Controller
{
    public function dashboard()
    {
        $scholar = Auth::guard('scholar')->user();

        $pendingWords = Words::where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        $reviewedWords = Words::where('status', 'approved')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        $pendingRequests = WordRequest::where('status', 'pending_scholar')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        $reviewedRequests = WordRequest::whereIn('status', ['approved', 'rejected'])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('scholars.dashboard', compact(
            'scholar',
            'pendingWords',
            'reviewedWords',
            'pendingRequests',
            'reviewedRequests'
        ));
    }

    // public function approve($id)
    // {
    //     $word = Words::findOrFail($id);
    //     $word->status = 'approved';
    //     $word->save();

    //     return redirect()->back()->with('success', 'Word approved!');
    // }

    // public function reject($id)
    // {
    //     $word = Words::findOrFail($id);
    //     $word->status = 'rejected';
    //     $word->save();

    //     return redirect()->back()->with('success', 'Word rejected!');
    // }


    public function showLoginForm()
    {
        return view('scholars.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('scholar')->attempt($credentials)) {
            return redirect()->route('scholar.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::guard('scholar')->logout();
        return redirect()->route('scholar.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:scholars,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Scholars::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('scholar.login')->with('success', 'Scholar registered successfully.');
    }

    public function pendingWords()
    {
        $pendingWords = Words::with('student')->where('status', 'pending')->get();
        return view('scholars.pendingwords', compact(
            'pendingWords'
        ));
    }

    public function reviewedWords()
    {
        $reviewedWords = Words::where('status', ['approved', 'rejected'])->paginate(10);
        return view('scholars.reviewedwords', compact('reviewedWords'));
    }

    public function pendingRequests()
    {
        $pendingRequests = WordRequest::where('status', 'pending_scholar')->paginate(10);
        return view('scholars.pendingrequests', compact('pendingRequests'));
    }

    public function reviewedRequests()
    {
        $reviewedRequests = WordRequest::whereIn('status', ['approved_by_scholar', 'rejected_by_scholar'])->paginate(10);
        return view('scholars.reviewedrequests', compact('reviewedRequests'));
    }
}
