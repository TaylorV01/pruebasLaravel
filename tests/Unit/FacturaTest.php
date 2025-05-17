<?php

namespace Tests\Unit;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\FacturaDetalle;
use Tests\TestCase;

class FacturaTest extends TestCase
{
    public function test_factura_belongs_to_cliente()
    {
        $cliente = Cliente::factory()->create();
        $factura = Factura::factory()->create(['cliente_id' => $cliente->id]);

        $this->assertInstanceOf(Cliente::class, $factura->cliente);
    }

    public function test_factura_has_many_detalles()
    {
        $factura = Factura::factory()->create();
        $detalle = FacturaDetalle::factory()->create(['factura_id' => $factura->id]);

        $this->assertInstanceOf(FacturaDetalle::class, $factura->detalles->first());
    }
} 