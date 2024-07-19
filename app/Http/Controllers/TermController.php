<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'term_year' => 'required|string|max:255',
            'term_name' => 'required|string|max:255',
        ]);

        $term = Term::create([
            'term_year' => $request->term_year,
            'term_name' => $request->term_name,
        ]);

        return response()->json(['success' => true, 'term' => $term]);
    }
}
