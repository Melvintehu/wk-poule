<?php

namespace App\Http\Controllers\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $type = 'User';
        $object = Auth::user();
        $id = Auth::user()->id;

        return view('cms.Core.edit', compact('id', 'type', 'object'));
    }
}
