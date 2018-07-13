<?php
        
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Bouncer;

class UserController extends Controller
{

    public function belongsToMany($slug)
    {
        return response()->json($slug);
    }
    
    /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
    public function index()
    {
        
        $objects = User::all();
        
        return response()->json($objects);
    }
    
    /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
    public function create()
    {
        //
    }
    
    /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
    public function store(Request $request)
    {
        $user = User::create([
            "name" => $request->get('name'),
            "email" => $request->get('email'),
            "password" => bcrypt($request->get('password')),
            "phone_number" => $request->get('phone_number'), 
        ]);
        
        $role_ids = collect($request->get('role_id'));
        
        $role_ids->each(function($role_id) {
            $role = Bouncer::role()->find($role_id);
            $user->assign($role);
        });

        if($role_ids->count() == 0) {
            $user->assign(Bouncer::role()->where('name', 'mentor')->first());
        }

        return response()->json($user, 200);
    }
    
    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function show($id)
    {
        //
    }
    
    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function edit($id)
    {
        $object = User::find($id);
        return response()->json($object, 200);
    }
    
    /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            "name" => $request->get('name'),
            "email" => $request->get('email'),
            "phone_number" => $request->get('phone_number'), 
        ]);
        
        $roles = Bouncer::role()->all();
            
        $roles->each(function($role) use($user) {
            $user->retract($role);
        });

        foreach($request->get('role_id') as $key =>  $value) {
            $role = Bouncer::role()->find($value);
            $user->assign($role);
        }
        return response()->json([], 200);
    }
    
    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json([], 200);
    }
}