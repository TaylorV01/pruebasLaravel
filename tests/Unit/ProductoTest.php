<?php

namespace Tests\Unit;

use App\Models\Producto;
use App\Models\FacturaDetalle;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    public function test_producto_has_many_factura_detalles()
    {
        $producto = Producto::factory()->create();
        $detalle = FacturaDetalle::factory()->create(['producto_id' => $producto->id]);

        $this->assertInstanceOf(FacturaDetalle::class, $producto->facturaDetalles->first());
    }
} 