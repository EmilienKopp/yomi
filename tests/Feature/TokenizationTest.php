<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TokenizationTest extends TestCase
{
    /**
     * Test English text tokenization.
     *
     * @return void
     */
    public function test_english_tokenization()
    {
        $response = $this->postJson('/api/tokenize', [
            'text' => 'Hello world! This is a test.',
            'language' => 'en'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'tokens',
                     'count'
                 ]);
        
        $data = $response->json();
        $this->assertEquals(['Hello', 'world', 'This', 'is', 'a', 'test'], $data['tokens']);
        $this->assertEquals(6, $data['count']);
    }

    /**
     * Test Japanese text tokenization.
     *
     * @return void
     */
    public function test_japanese_tokenization()
    {
        $response = $this->postJson('/api/tokenize', [
            'text' => 'こんにちは世界！これはテストです。',
            'language' => 'ja'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'tokens',
                     'count'
                 ]);
        
        // The exact tokens will depend on the tokenization algorithm
        // but we can at least check that we get some tokens back
        $data = $response->json();
        $this->assertNotEmpty($data['tokens']);
        $this->assertGreaterThan(0, $data['count']);
    }
}
