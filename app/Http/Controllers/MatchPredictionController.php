<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prediction;
use App\Match;

class MatchPredictionController extends Controller
{
    public function store(Request $request, Match $match)
    {   
        return Prediction::predict($request->all(), $match);
    }
}
