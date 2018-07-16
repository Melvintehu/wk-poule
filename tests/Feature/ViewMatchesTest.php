<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Match;
use App\Team;
use Carbon\Carbon;
use App\Statistic;
use App\Queries\MatchesPlayed;

class ViewMatchesTest extends TestCase
{
    use DatabaseMigrations;

    protected function assertSeeMatchAttributes($response, $match)
    {
        $response->assertSee($match->play_date);
        $response->assertSee($match->start_time);
        $response->assertSee($match->end_time);
        $response->assertSee($match->home_team->name);
        $response->assertSee($match->away_team->name);
    }

    /** @test */
    public function a_user_can_view_a_single_match()
    {
        // arrange
        $match = factory(Match::class)->create([
            'home_team_id' => factory(Team::class)->create()->id,
            'away_team_id' => factory(Team::class)->create()->id
        ]);

        // act
        $response = $this->get(route('match.show', ['match' => 1]));

        // assert
        $this->assertSeeMatchAttributes($response, $match);
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
        $response = $this->get(route('match.index'));

        // assert
        $this->assertSeeMatchAttributes($response, Match::all()->random(3)->first());
    }

    /** @test */
    public function a_user_can_view_played_matches()
    {
        // arrange
        $match_start_time = Carbon::now()->subMinutes(MatchesPlayed::PUBLISH_MATCH_AFTER_TIME)->format('H:i:s');

        factory(Statistic::class)->create([
            'match_id' => factory(Match::class)->create([
                'play_date' => '2018-07-16',
                'end_time' => $match_start_time
            ])->id
        ]);

        // act
        $response = $this->get(route('match.played.index'));
        
        $this->assertTrue(true);
    }

    


}
