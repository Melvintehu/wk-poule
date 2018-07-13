<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use App\Traits\HasPhotos;

class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;
    use SoftDeletes;    
    use HasPhotos;
    use HasApiTokens;
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $appends = [
        'original',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone_number', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function settings()
    {
        return $this->belongsTo('App\Settings');
    }

    public function hasRoles($roles) 
    {
      
        
        if($this->isAn('admin')) {
            return true;
        }
        
        foreach($roles as $index => $role) {
            if($this->isA(lcfirst($role->name) . '-user')) {
                return true;
            }
        }

        return false;
    }   
}
