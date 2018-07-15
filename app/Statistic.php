<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $guarded = [];

    public function match()
    {
        return $this->belongsTo(Match::class);
    }
}
