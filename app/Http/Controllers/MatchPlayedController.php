<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\MatchesPlayed;

class MatchPlayedController extends Controller
{
    public function index()
    {
        $matches = MatchesPlayed::get();
        
        return view('match.played.index', compact(
            'matches'
        ));
    }
}
