<?php

namespace Tests\Feature;

use App\Models\Producto;
use Tests\TestCase;

class ProductoControllerTest extends TestCase
{
    public function test_can_create_producto()
    {
        $response = $this->post('/productos', [
            'nombre' => 'Test Producto',
            'costo' => 100.00,
        ]);

        $response->assertStatus(302); // Redirect after creation
        $this->assertDatabaseHas('productos', ['nombre' => 'Test Producto']);
    }
} 