<?php

namespace Tests\Feature\Api;

use App\Models\Factura;
use Tests\TestCase;

class FacturaApiTest extends TestCase
{
    public function test_can_list_facturas()
    {
        $response = $this->get('/api/facturas');
        $response->assertStatus(200);
    }
} 