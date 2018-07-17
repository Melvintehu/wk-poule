<?php 
namespace App\Presenters;

class StatisticPresenter extends Presenter
{
    public function goalsHome()
    {
        return $this->goals_home;
    }

    public function goalsAway()
    {
        return $this->goals_away;
    }
}
