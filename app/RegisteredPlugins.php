<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredPlugins extends Model
{   
    protected $table = "registered_plugins";

    protected $fillable = [
        'name',
        'user_id',
    ];
}
