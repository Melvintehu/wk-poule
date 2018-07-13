<?php 
namespace App\Helpers;

use Auth;

class Authorization {

    /**
     * Checks if the current user is authorized by comparing the roles passed to this function.
     */
    public static function authorizeRoles($roles, $execeptions = []) 
    {   

        $currentUser = Auth()->guard('api')->user();



        if($currentUser->isAn('admin')) {
            return true;
        }
        
        foreach($roles as $index => $role) {
            if($currentUser->isA($role) && !in_array($role, $execeptions) ) {
               return true;
            }
        }

        abort(418);
    }

}