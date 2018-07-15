<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Score;
use App\User;

class ScoreTest extends TestCase
{
    /** @test */
    public function it_has_a_total()
    {
        // arrange
        $score = factory(Score::class)->make();

        // assert
        $this->assertNotNUll($score->total);
    }

    // /** @test */
    // public function it_has_an_associated_user()
    // {
    //     // arrange
    //     $score = factory(Score::class)->create();
    //     $score->user()->associate(factory(User::class)->create());
        
    //     // assert
    //     $assertNotNull($score->user);
    // }
}
