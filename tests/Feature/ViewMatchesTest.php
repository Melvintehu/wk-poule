<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Match;
use App\Team;

class ViewMatchesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_view_a_single_match()
    {
        // arrange
        $match = factory(Match::class)->create([
            'home_team_id' => factory(Team::class)->create()->id,
            'away_team_id' => factory(Team::class)->create()->id
        ]);

        // act
        $response = $this->get('/match/' . $match->id);

        // assert
        $response->assertSee($match->play_date);
        $response->assertSee($match->start_time);
        $response->assertSee($match->end_time);
        $response->assertSee($match->home_team->name);
        $response->assertSee($match->away_team->name);
    }


    /** @test */
    public function a_user_can_view_multiple_matches()
    {
        // arrange
        $match = factory(Match::class, 5)->create([
            'home_team_id' => factory(Team::class)->create()->id,
            'away_team_id' => factory(Team::class)->create()->id
        ]);

        // act
        $response = $this->get('/match');

        // assert

        $match = Match::all()->random(3)->first();

        $response->assertSee($match->play_date);
        $response->assertSee($match->start_time);
        $response->assertSee($match->end_time);
        $response->assertSee($match->home_team->name);
        $response->assertSee($match->away_team->name);
    }


    


}
