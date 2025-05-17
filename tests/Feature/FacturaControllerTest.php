<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Producto;
use Tests\TestCase;

class FacturaControllerTest extends TestCase
{
    public function test_can_create_factura()
    {
        $cliente = Cliente::factory()->create();
        $producto = Producto::factory()->create();

        $response = $this->post('/facturas', [
            'cliente_id' => $cliente->id,
            'producto_id' => [$producto->id],
            'cantidad' => [1],
        ]);

        $response->assertStatus(302); // Redirect after creation
        $this->assertDatabaseHas('facturas', ['cliente_id' => $cliente->id]);
    }
} 