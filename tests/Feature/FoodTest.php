<?php

namespace Tests\Feature;

use App\Models\Food;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FoodTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddFood()
    {
        $this->withoutExceptionHandling();
        $data     = [
            Food::ATTR_NAME  => 'Пирог',
            Food::ATTR_PRICE => 500,
        ];
        $response = $this->post('/api/foods', $data);

        $response->assertStatus(201);
    }
}
