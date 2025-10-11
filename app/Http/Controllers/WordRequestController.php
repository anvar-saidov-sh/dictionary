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
            'examples' => 'nullable|string',
            'idioms' => 'nullable|string',
            'message' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $studentId = Auth::guard('student')->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('word_requests', 'public');
        }

        WordRequest::create([
            'word_id' => $wordId,
            'student_id' => $studentId,
            'definition' => $validated['definition'],
            'examples' => $validated['examples'] ?? null,
            'idioms' => $validated['idioms'] ?? null,
            'message' => $validated['message'] ?? null,
            'image' => $validated['image'] ?? null,
            'status' => 'pending_owner',
        ]);

        return back()->with('success', 'Request submitted and awaiting owner review.');
    }

    public function approveByOwner($id)
    {
        $req = WordRequest::with('word')->findOrFail($id);
        $ownerId = $req->word->student_id;

        if ($ownerId !== Auth::guard('student')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $req->update(['status' => 'pending_scholar']);

        return back()->with('success', 'Request approved and sent to scholar for final review.');
    }

    public function rejectByOwner($id)
    {
        $req = WordRequest::with('word')->findOrFail($id);
        $ownerId = $req->word->student_id;

        if ($ownerId !== Auth::guard('student')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $req->update(['status' => 'rejected']);

        return back()->with('info', 'Request rejected by owner.');
    }

    public function approveByScholar($id)
    {
        $req = WordRequest::where('status', 'pending_scholar')
            ->with('word')
            ->findOrFail($id);

        $scholarId = Auth::guard('scholar')->id();
        $word = $req->word;

        $word->update([
            'definition' => $req->definition ?? $word->definition,
            'examples' => $req->examples ?? $word->examples,
            'idioms' => $req->idioms ?? $word->idioms,
            'image' => $req->image ?? $word->image,
            'status' => 'approved',
            'verified' => true,
            'reviewed_by_scholar' => true,
            'approved_by_scholar' => $scholarId,
        ]);

        $req->update([
            'status' => 'approved_by_scholar',
        ]);

        return back()->with('success', 'Request approved and applied successfully.');
    }

    public function rejectByScholar($id)
    {
        $req = WordRequest::where('status', 'pending_scholar')->findOrFail($id);

        $req->update([
            'status' => 'rejected_by_scholar',
            'scholar_id' => Auth::guard('scholar')->id(),
        ]);

        return back()->with('info', 'Request rejected by scholar.');
    }
}
