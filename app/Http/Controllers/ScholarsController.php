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
            ->oldest()->paginate(10);

        $reviewedWords = Words::where('verified', true)
            ->oldest()->paginate(10);

        $pendingRequests = WordRequest::where('rejected_by_owner', false)
            ->oldest()->paginate(10);

        $reviewedRequests = WordRequest::where('approved_by_owner', true)
            ->oldest()->paginate(10);
        return view('scholars.dashboard', compact(
            'scholar',
            'pendingWords',
             'reviewedWords',
            'pendingRequests',
            'reviewedRequests'));
    }

    public function approve($id)
    {
        $word = Words::findOrFail($id);
        $word->verified_by_scholar = true;
        $word->approved_by_scholar = Auth::guard('scholar')->id();
        $word->save();

        return back()->with('success', 'Word verified successfully.');
    }

    public function reject($id)
    {
        $word = Words::findOrFail($id);
        $word->status = 'rejected_by_scholar';
        $word->verified_by_scholar = false;
        $word->save();

        return back()->with('error', 'Word rejected by Scholar.');
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

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('scholar')->logout();
        return redirect()->route('scholar.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:scholars,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Scholars::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('scholar.login')->with('success', 'Scholar registered successfully.');
    }
}
