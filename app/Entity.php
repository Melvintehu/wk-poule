<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use SoftDeletes;    
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];  

    protected $fillable = [
        'name',
        'title',
        'description',
        'nav_group_id',
        'icon',
    ];

    /**
     * Get the NavGroup that owns the Entity.
     */
    public function navGroup()
    {
        return $this->belongsTo('App\NavGroup');
    }
}
