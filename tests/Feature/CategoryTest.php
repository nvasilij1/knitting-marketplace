<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Проверяем роут /api/get_category нам известно, что в базе есть category_id = 1.
     * его проверим в ответе сервера
     */
    public function test_get_category()
    {
        $response = $this->get('/api/get_category');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                "category_id" => 1
            ]);

    }
}
