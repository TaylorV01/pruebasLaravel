<?php

namespace App\Http\Controllers;

use App\Models\FacturaDetalle;
use Illuminate\Http\Request;

class FacturaDetalleController extends Controller
{
    public function index() {
        return response()->json(FacturaDetalle::with('producto', 'factura')->get(), 200);
    }

    public function store(Request $request) {
        $request->validate([
            'factura_id' => 'required|exists:facturas,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'valor_unitario' => 'required|numeric',
            'valor_total' => 'required|numeric',
        ]);
        $detalle = FacturaDetalle::create($request->all());
        return response()->json($detalle, 201);
    }

    public function show($id) {
        $detalle = FacturaDetalle::with('producto', 'factura')->find($id);
        return $detalle ? response()->json($detalle) : response()->json(['message' => 'No encontrado'], 404);
    }

    public function update(Request $request, $id) {
        $detalle = FacturaDetalle::find($id);
        if (!$detalle) return response()->json(['message' => 'No encontrado'], 404);
        $detalle->update($request->all());
        return response()->json($detalle);
    }

    public function destroy($id) {
        $detalle = FacturaDetalle::find($id);
        if (!$detalle) return response()->json(['message' => 'No encontrado'], 404);
        $detalle->delete();
        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
