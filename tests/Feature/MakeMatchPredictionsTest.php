<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Match;
use App\Prediction;

class MakeMatchPredictionsTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setUp()
    {
        Parent::setUp();
        $this->user = factory(User::class)->create();
        $this->be($this->user);
    }


    /** @test */
    public function a_user_can_make_a_prediction_on_a_match()
    {
        $match = factory(Match::class)->create();

        $response = $this->post('/prediction/match/' . $match->id , [
            'goals_home' => 0, 
            'goals_away' => 2,
            'yellow_cards_home' => 2,
            'yellow_cards_away' => 0,
            'red_cards_home' => 0,
            'red_cards_away' => 0,
        ]);

        $response->assertStatus(201);
        
        $prediction = Prediction::where([
            ['match_id', $match->id],
            ['user_id', $this->user->id],
        ])->first();
        
        $this->assertNotNull($prediction);
        $this->assertEquals(0, $prediction->goals_home);
        $this->assertEquals(2, $prediction->goals_away);
        $this->assertEquals(2, $prediction->yellow_cards_home);
        $this->assertEquals(0, $prediction->yellow_cards_away);
        $this->assertEquals(0, $prediction->red_cards_home);
        $this->assertEquals(0, $prediction->red_cards_away);
    }

}
