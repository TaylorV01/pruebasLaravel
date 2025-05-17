<?php

namespace Tests\Feature\Api;

use App\Models\Cliente;
use Tests\TestCase;

class ClienteApiTest extends TestCase
{
    public function test_can_list_clientes()
    {
        $response = $this->get('/api/clientes');
        $response->assertStatus(200);
    }
} 