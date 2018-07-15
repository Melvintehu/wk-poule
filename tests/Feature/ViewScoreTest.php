<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Score;
use App\User;

class ViewScoreTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        Parent::setUp();

        $this->user = factory(User::class)->create();
        $this->be($this->user);
        
    }

    /** @test */
    public function a_user_can_view_their_score()
    {
        // arrange
        $score = Score::create([
            'total' => 32,
        ]);

        $this->user->score()->save($score);

        // act
        $response = $this->get('/user/'. $this->user->id .'/score');

        // assert
        $response->assertSee($score->total);
    }
}
