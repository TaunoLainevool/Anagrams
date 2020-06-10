<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnagramTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anagramAlgorithmTest()
    {
        $response = $this->call('GET','/api/anagram/ait');
        $response -> assertStatus(200);
        // $response ->assertStatus(200)->assertJsonFragment([ 'anagram' => 'ait', ]);
        // dump($response);

    }

}
