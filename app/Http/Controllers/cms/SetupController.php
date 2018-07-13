<?php

namespace App\Http\Controllers\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SetupController extends Controller
{
    public function step1(Request $request)
    {
        $password = $request->get('password');
        $password_confirm = $request->get('password_confirm');

        if($password === $password_confirm) {
            $user = Auth::user();
            $user->password = bcrypt($password);
            $user->save();
        } 

        return view('cms.Core.setup.step2');
    }

    
}
