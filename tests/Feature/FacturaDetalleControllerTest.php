<?php

namespace Tests\Feature;

use App\Models\Factura;
use App\Models\Producto;
use Tests\TestCase;

class FacturaDetalleControllerTest extends TestCase
{
    public function test_can_create_factura_detalle()
    {
        $factura = Factura::factory()->create();
        $producto = Producto::factory()->create();

        $response = $this->post('/factura-detalles', [
            'factura_id' => $factura->id,
            'producto_id' => $producto->id,
            'cantidad' => 1,
            'valor_unitario' => 100.00,
            'valor_total' => 100.00,
        ]);

        $response->assertStatus(302); // Redirect after creation
        $this->assertDatabaseHas('factura_detalles', ['factura_id' => $factura->id]);
    }
} 