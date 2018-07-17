<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/** Query objects */
use App\Queries\MatchesPlayed;
use Carbon\Carbon;
use App\Match;
use App\Statistic;

class PlayedMatchesQueryTest extends TestCase
{
    use DatabaseMigrations;

    

    /** @test */
    public function it_can_retreive_played_matches_that_have_statistics()
    {
        // arrange
        $match_start_time = Carbon::now()->subMinutes(Match::PUBLISH_MATCH_AFTER_TIME)->format('H:i:s');

        factory(Statistic::class)->create([
            'match_id' => factory(Match::class)->create([
                'play_date' => Carbon::now()->format('Y-m-d'),
                'end_time' => $match_start_time
            ])->id
        ]);

        $toBePlayedMatch = factory(Match::class)->create();
                
        // act
        $matches = MatchesPlayed::get();
        
        
        // assert
        $this->assertNotNull($matches);
        $this->assertEquals(1, $matches->count());
        $this->assertFalse($matches->contains('id', $toBePlayedMatch->id));
    }
    
}
