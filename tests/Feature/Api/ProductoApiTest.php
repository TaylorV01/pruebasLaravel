<?php

namespace Tests\Feature\Api;

use App\Models\Producto;
use Tests\TestCase;

class ProductoApiTest extends TestCase
{
    public function test_can_list_productos()
    {
        $response = $this->get('/api/productos');
        $response->assertStatus(200);
    }
} 