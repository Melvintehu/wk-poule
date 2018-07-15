<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Prediction;
use Illuminate\Support\Facades\Auth;
use App\Match;

class PredictTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        Parent::setUp();
        $this->user = factory(User::class)->create();
        $this->be($this->user);
    }

    /** @test */
    public function has_a_predict_method()
    {
        // arrange
        $match = factory(Match::class)->create();

        // act
        $response = Prediction::predict([
            'goals_home' => 0,
            'goals_away' => 1,
            'yellow_cards_home' => 1,
            'yellow_cards_away' => 1,
            'red_cards_home' => 1,
            'red_cards_away' => 1,
        ], $match);
        
        // assert
        $prediction = Prediction::where([
            ['match_id', $match->id],
            ['user_id', $this->user->id],
        ])->first();
            
        $this->assertNotNUll($prediction);

        // check goals
        $this->assertEquals(0, $prediction->goals_home);
        $this->assertEquals(1, $prediction->goals_away);

        // check yellow cards
        $this->assertEquals(1, $prediction->yellow_cards_home);
        $this->assertEquals(1, $prediction->yellow_cards_away);

        // check red cards
        $this->assertEquals(1, $prediction->red_cards_home);
        $this->assertEquals(1, $prediction->red_cards_away);
        
        $this->assertEquals($this->user->id, $prediction->user_id);
    }
}
