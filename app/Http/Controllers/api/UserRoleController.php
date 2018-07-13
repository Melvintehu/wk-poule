<?php
        
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Silber\Bouncer\Database\Role;
use Auth;
use App\User;


class UserRoleController extends Controller
{


    public function roles(Request $request) 
    {
        
        $user = User::find($request->get('id'));
        $roles = $user->roles;
        
        return response()->json($roles, 200);
    }
    /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
    public function index(Request $request)
    {
        $roles = Role::all();
        
        

        $userHasRoles = $roles->map(function($role) {
             
            $currentUser = Auth::guard('api')->user();
           
            $foundUser = $role->users->where('id', $currentUser->id)->first();
            
            if($foundUser) {
                return $role->name;
            }
        });

        return response()->json($userHasRoles, 200);
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
        $object = UserRole::create($request->all());
        return response()->json($object, 200);
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
        $object = UserRole::find($id);
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
        UserRole::find($id)->update($request->all());
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
        UserRole::find($id)->delete();
        return response()->json([], 200);
    }
}