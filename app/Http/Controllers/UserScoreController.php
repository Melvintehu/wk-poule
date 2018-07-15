<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserScoreController extends Controller
{
    public function show(User $user)
    {
        $score = $user->score;

        return view('userScore.show', compact(
            'score'
        ));
    }
}
