<?php

namespace App\Http\Controllers;

use App\Models\Words;
use Illuminate\Http\Request;

class WordsController extends Controller
{
    public function index(){
        return view('words.index');
    }

    public function create(Request $request)  {
        $word = Words::create([
            'name' => $request->name,
            'definition' => $request->definition,
            'examples' => $request->examples,
            'idioms' => $request->idioms,
            'image' => $request->image,
        ]);
    }
}
