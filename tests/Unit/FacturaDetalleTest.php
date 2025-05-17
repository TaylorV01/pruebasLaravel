<?php

namespace Tests\Unit;

use App\Models\FacturaDetalle;
use App\Models\Factura;
use App\Models\Producto;
use Tests\TestCase;

class FacturaDetalleTest extends TestCase
{
    public function test_factura_detalle_belongs_to_factura()
    {
        $factura = Factura::factory()->create();
        $detalle = FacturaDetalle::factory()->create(['factura_id' => $factura->id]);

        $this->assertInstanceOf(Factura::class, $detalle->factura);
    }

    public function test_factura_detalle_belongs_to_producto()
    {
        $producto = Producto::factory()->create();
        $detalle = FacturaDetalle::factory()->create(['producto_id' => $producto->id]);

        $this->assertInstanceOf(Producto::class, $detalle->producto);
    }
} 