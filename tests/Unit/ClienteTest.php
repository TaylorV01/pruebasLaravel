<?php

namespace Tests\Unit;

use App\Models\Cliente;
use App\Models\Factura;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    public function test_cliente_has_many_facturas()
    {
        $cliente = Cliente::factory()->create();
        $factura = Factura::factory()->create(['cliente_id' => $cliente->id]);

        $this->assertInstanceOf(Factura::class, $cliente->facturas->first());
    }
} 