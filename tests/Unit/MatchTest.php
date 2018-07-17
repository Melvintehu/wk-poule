<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Match;
use App\Team;
use App\Statistic;
use Carbon\Carbon;

class MatchTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        Parent::setUp();

        $this->match = factory(Match::class)->create();
            
    }

    /** @test */
    public function it_has_a_home_team()
    {
        // arrange
        $this->match->home_team_id = factory(Team::class)->create()->id;

        // act
        $team = $this->match->home_team;

        // assert
        $this->assertNotNull($team);
        $this->assertInstanceOf(Team::class, $team);
        $this->assertEquals($this->match->home_team_id, $team->id);
    }

    /** @test */
    public function it_has_an_away_team()
    {
        // arrange
        $this->match->away_team_id = factory(Team::class)->create()->id;
        
        // assert
        $team = $this->match->away_team;
        $this->assertNotNull($team);
        $this->assertInstanceOf(Team::class, $team);
        $this->assertEquals($this->match->away_team_id, $team->id);
    }

    /** @test */
    public function it_has_statistics()
    {
        // arrange
        $this->match->statistic()->save(factory(Statistic::class)->create());

        // assert
        $statistic = $this->match->statistic;

        $this->assertNotNull($statistic);
        $this->assertInstanceOf(Statistic::class, $statistic);
    }


    /** @test */
    public function a_match_may_be_published_after_a_set_time()
    {
        $this->assertNotNull(Match::PUBLISH_MATCH_AFTER_TIME);
    }
  

}
