<?php

namespace App\Http\Controllers;

use App\Models\WordRequest;
use App\Models\Words;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WordRequestController extends Controller
{
    
    public function create($letter, $wordId)
    {
        $word = Words::findOrFail($wordId);
        return view('words.request', compact('word', 'letter'));
    }

    public function store(Request $request, $letter, $wordId)
    {
        $validated = $request->validate([
            'definition' => 'required|string',
            'examples'   => 'nullable|string',
            'idioms'     => 'nullable|string',
            'message'    => 'nullable|string',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $studentId = auth()->guard('student')->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('word_requests', 'public');
        }

        WordRequest::create([
            'word_id'    => $wordId,
            'student_id' => $studentId,
            'definition' => $validated['definition'],
            'examples'   => $validated['examples'] ?? null,
            'idioms'     => $validated['idioms'] ?? null,
            'message'    => $validated['message'] ?? null,
            'image'      => $validated['image'] ?? null,
            'status'     => 'pending_owner',
        ]);

        return back()->with('success', 'Request submitted successfully and is awaiting word owner review.');
    }


    public function approveByOwner($id)
    {
        $requestItem = WordRequest::with('word')->findOrFail($id);
        $ownerId = $requestItem->word->student_id ?? null;

        if ($ownerId !== auth()->guard('student')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $requestItem->update(['status' => 'pending_scholar']);

        return back()->with('success', 'Request approved and sent to scholars for final review.');
    }


    public function rejectByOwner($id)
    {
        $requestItem = WordRequest::with('word')->findOrFail($id);
        $ownerId = $requestItem->word->student_id ?? null;

        if ($ownerId !== auth()->guard('student')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $requestItem->update(['status' => 'rejected']);

        return back()->with('info', 'Request rejected. It will not be sent to scholars.');
    }


    public function approveByScholar($id)
    {
        $req = WordRequest::where('status', 'pending_scholar')->with('word')->findOrFail($id);
        $scholarId = auth()->guard('scholar')->id();


        $word = $req->word;
        if ($req->definition) $word->definition = $req->definition;
        if ($req->examples)   $word->examples   = $req->examples;
        if ($req->idioms)     $word->idioms     = $req->idioms;
        if ($req->image)      $word->image      = $req->image;
        $word->verified = true;
        $word->rejected = false;
        $word->save();


        $req->update([
            'status'     => 'approved',
            'scholar_id' => $scholarId,
        ]);

        return back()->with('success', 'Request approved and applied to the word.');
    }

    public function rejectByScholar($id)
    {
        $req = WordRequest::where('status', 'pending_scholar')->findOrFail($id);

        $req->update([
            'status'     => 'rejected',
            'scholar_id' => auth()->guard('scholar')->id(),
        ]);

        return back()->with('info', 'Request rejected by scholar.');
    }
}
