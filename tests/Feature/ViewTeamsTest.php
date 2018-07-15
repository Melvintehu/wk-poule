<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Team;

class ViewTeamsTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function a_user_can_display_a_team()
    {
        // arrange
        $team = factory(Team::class)->create();
        
        // act
        $response = $this->get('/team/' . $team->id);

        // assert
        $response->assertSee($team->name);
        $response->assertSee($team->goals_for);
        $response->assertSee($team->goals_against);

    }

}
