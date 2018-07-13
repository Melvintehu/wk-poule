<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NavGroup extends Model
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
    ];

    /**
     * Get the Entities for the NavGroup.
     */
    public function entities()
    {
        return $this->hasMany('App\Entity');
    }
}
