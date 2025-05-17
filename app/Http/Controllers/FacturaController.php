<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\FacturaDetalle;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index() {
        $facturas = Factura::with('cliente')->get();
        return view('facturas.index', compact('facturas'));
    }

    public function create() {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('facturas.create', compact('clientes', 'productos'));
    }

    public function store(Request $request) {
        $request->validate([
            'cliente_id' => 'required',
            'producto_id.*' => 'required',
            'cantidad.*' => 'required|integer|min:1'
        ]);

        // Calcular subtotal, iva y total
        $subtotal = 0;
        foreach ($request->producto_id as $index => $producto_id) {
            $producto = Producto::find($producto_id);
            $cantidad = $request->cantidad[$index];
            $subtotal += $producto->costo * $cantidad;
        }

        $iva = $subtotal * 0.12;
        $total = $subtotal + $iva;

        // Crear la factura
        $factura = Factura::create([
            'cliente_id' => $request->cliente_id,
            'fecha_venta' => now(),
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
        ]);

        // Crear los detalles
        foreach ($request->producto_id as $index => $producto_id) {
            $producto = Producto::find($producto_id);
            FacturaDetalle::create([
                'factura_id' => $factura->id,
                'producto_id' => $producto_id,
                'cantidad' => $request->cantidad[$index],
                'valor_unitario' => $producto->costo,
                'valor_total' => $producto->costo * $request->cantidad[$index],
            ]);
        }

        return redirect()->route('facturas.index')->with('success', 'Factura creada con éxito');
    }
    
    public function show($id) {
        $factura = Factura::with(['cliente', 'detalles.producto'])->findOrFail($id);
        return view('facturas.show', compact('factura'));
    }
    
    public function edit($id) {
        $factura = Factura::with('detalles')->findOrFail($id);
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('facturas.edit', compact('factura', 'clientes', 'productos'));
    }
    
    public function update(Request $request, $id) {
        $request->validate([
            'cliente_id' => 'required',
            'producto_id.*' => 'required',
            'cantidad.*' => 'required|integer|min:1'
        ]);
    
        $factura = Factura::findOrFail($id);
    
        // Eliminar detalles anteriores
        $factura->detalles()->delete();
    
        // Calcular nuevos valores
        $subtotal = 0;
        foreach ($request->producto_id as $index => $producto_id) {
            $producto = Producto::find($producto_id);
            $cantidad = $request->cantidad[$index];
            $subtotal += $producto->costo * $cantidad;
        }
    
        $iva = $subtotal * 0.15;
        $total = $subtotal + $iva;
    
        // Actualizar la factura
        $factura->update([
            'cliente_id' => $request->cliente_id,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
        ]);
    
        // Crear los nuevos detalles
        foreach ($request->producto_id as $index => $producto_id) {
            $producto = Producto::find($producto_id);
            FacturaDetalle::create([
                'factura_id' => $factura->id,
                'producto_id' => $producto_id,
                'cantidad' => $request->cantidad[$index],
                'valor_unitario' => $producto->costo,
                'valor_total' => $producto->costo * $request->cantidad[$index],
            ]);
        }
    
        return redirect()->route('facturas.index')->with('success', 'Factura actualizada correctamente.');
    }
    
    public function destroy($id) {
        $factura = Factura::findOrFail($id);
        
        // Eliminar primero los detalles relacionados
        $factura->detalles()->delete();
        
        // Eliminar la factura
        $factura->delete();
        
        return redirect()->route('facturas.index')->with('success', 'Factura eliminada correctamente');
    }
}
