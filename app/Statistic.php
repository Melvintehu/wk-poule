<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\StatisticPresenter;

class Statistic extends Model
{
    protected $guarded = [];

    public function match()
    {
        return $this->belongsTo(Match::class);
    }

    public function present()
    {
        return new StatisticPresenter($this);
    }
}
