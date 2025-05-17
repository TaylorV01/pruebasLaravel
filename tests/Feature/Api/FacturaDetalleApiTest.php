<?php

namespace Tests\Feature\Api;

use App\Models\FacturaDetalle;
use Tests\TestCase;

class FacturaDetalleApiTest extends TestCase
{
    public function test_can_list_factura_detalles()
    {
        $response = $this->get('/api/factura-detalles');
        $response->assertStatus(200);
    }
} 