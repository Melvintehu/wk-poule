<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;

class MatchController extends Controller
{

    public function index()
    {
        $matches = Match::all();

        return view('match.index', compact(
            'matches'
        ));
    }

    public function show(Match $match)
    {
        return view('match.show', compact(
            'match'
        ));
    }
}
