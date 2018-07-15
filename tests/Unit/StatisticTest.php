<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Statistic;
use App\Match;

class StatisticTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function it_has_a_match()
    {
        $statistic = Statistic::create([
            'yellow_cards_home' => 0,
            'yellow_cards_away' => 2,
            'red_cards_home' => 2,
            'red_cards_away' => 4, 
            'goals_home' => 12,
            'goals_away' => 6,
        ]);
        
        $response = $statistic->match()->associate(factory(Match::class)->create());
            
        $this->assertNotNUll($statistic->match);            
    }
}
