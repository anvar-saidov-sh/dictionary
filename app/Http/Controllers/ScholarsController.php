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
        $scholar = auth()->guard('scholar')->user();

        $pendingWords = Words::where('verified', false)
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        $reviewedWords = Words::where('verified', true)
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

    // public function verify($id)
    // {
    //     $word = Words::findOrFail($id);

    //     $word->verified = true;
    //     $word->rejected = false;
    //     $word->verified_by_scholar = Auth::guard('scholar')->id();
    //     $word->save();

    //     return back()->with('success', 'Word verified successfully.');
    // }
    public function approve($id)
    {
        $word = Words::findOrFail($id);

        $word->verified = true;
        $word->rejected = false;
        $word->verified_by_scholar = Auth::guard('scholar')->id();
        $word->save();

        return back()->with('success', 'Word verified successfully.');
    }


    public function reject($id)
    {
        $word = Words::findOrFail($id);

        $word->verified = false;
        $word->rejected = true;
        $word->verified_by_scholar = Auth::guard('scholar')->id();
        $word->save();

        return back()->with('error', 'Word rejected by scholar.');
    }


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
        $pendingWords = Words::where('verified', false)->paginate(10);
        return view('scholars.pendingwords', compact('pendingWords'));
    }

    public function pendingRequests()
    {
        $pendingRequests = WordRequest::where('status', 'pending_scholar')->paginate(10);
        return view('scholars.pendingrequests', compact('pendingRequests'));
    }

    public function reviewedWords()
    {
        $reviewedWords = Words::where('verified', true)->paginate(10);
        return view('scholars.reviewedwords', compact('reviewedWords'));
    }

    public function reviewedRequests()
    {
        $reviewedRequests = WordRequest::whereIn('status', ['approved', 'rejected'])->paginate(10);
        return view('scholars.reviewedrequests', compact('reviewedRequests'));
    }
}
