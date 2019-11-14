<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddOrder()
    {
        $this->withoutExceptionHandling();
        $data = [
            Order::ATTR_DATE_DELIVERY => '2019-11-11 08:08',
            Order::ATTR_COMMENT       => 'TEst',
            Order::ATTR_TOTAL_SUM     => '224.4',
            Order::ATTR_CLIENT_ID     => 1,
        ];

        $response = $this->post('/api/orders', $data);

        $response->assertStatus(200);
    }
}
