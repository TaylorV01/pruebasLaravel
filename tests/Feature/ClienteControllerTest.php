<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Tests\TestCase;

class ClienteControllerTest extends TestCase
{
    public function test_can_create_cliente()
    {
        $response = $this->post('/clientes', [
            'nombre' => 'Test Cliente',
        ]);

        $response->assertStatus(302); // Redirect after creation
        $this->assertDatabaseHas('clientes', ['nombre' => 'Test Cliente']);
    }
} 