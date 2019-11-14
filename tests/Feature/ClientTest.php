<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddClient()
    {
        $this->withoutExceptionHandling();
        $data     = [
            Client::ATTR_NAME    => 'Аушев И',
            Client::ATTR_LINK    => 'https://instagram.com/ibra_aushev',
            Client::ATTR_PHONE   => '89780438740',
            Client::ATTR_ADDRESS => 'Аушева 25',
            Client::ATTR_CITY    => 'Назрань',
        ];
        $response = $this->post('/api/clients', $data);

        $response->assertStatus(200);
    }
}
