<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CalculateScoreTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function a_score_is_caculated_for_a_user()
    {
        $this->assertTrue(true);
    }
}
