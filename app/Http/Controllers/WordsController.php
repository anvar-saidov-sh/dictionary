<?php

namespace App\Http\Controllers;

use App\Models\Words;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Http\Request;

class WordsController extends Controller
{
    public function index()
    {
        return view('words.index');
    }

    public function create(Request $request)
    {
        $word = Words::create([
            'name' => $request->name,
            'definition' => $request->definition,
            'examples' => $request->examples,
            'idioms' => $request->idioms,
            'image' => $request->image,
        ]);

        return view('words.create');
    }
    public function show($slug)
    {
        $map = [
            'o-' => 'Oʻ',
            'g-' => 'Gʻ',
            'sh' => 'Sh',
            'ch' => 'Ch',
        ];

        $letter = $map[$slug] ?? strtoupper($slug);
        return view('words.show');
    }
}
