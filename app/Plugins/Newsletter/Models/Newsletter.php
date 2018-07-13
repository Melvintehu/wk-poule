<?php

namespace App\Plugins\Newsletter\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'newsletters';

    protected $fillable = [
        'subject',
        'content',
        'date',
    ];
}
