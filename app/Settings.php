<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use SoftDeletes;    

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'setup', 
        'project_name', 
        'user_id',
        'max_amount_users',
        'subscription_valid_until',
        'yearly_fee',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
