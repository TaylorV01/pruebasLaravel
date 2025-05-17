@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Detalles de Factura #{{ $factura->id }}</h1>
    <div>
        <a href="{{ route('facturas.edit', $factura->id) }}" class="btn btn-warning me-2">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('facturas.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver a la lista
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Información de la Factura</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Cliente:</strong> {{ $factura->cliente->nombre }}</p>
                <p><strong>Fecha:</strong> {{ date('d/m/Y', strtotime($factura->fecha_venta)) }}</p>
            </div>
            <div class="col-md-6 text-end">
                <p><strong>Subtotal:</strong> ${{ number_format($factura->subtotal, 2) }}</p>
                <p><strong>IVA:</strong> ${{ number_format($factura->iva, 2) }}</p>
                <p><strong>Total:</strong> <span class="fw-bold fs-4">${{ number_format($factura->total, 2) }}</span></p>
            </div>
        </div>
    </div>
</div>

<h4>Detalles de la Factura</h4>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($factura->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->valor_unitario, 2) }}</td>
                    <td>${{ number_format($detalle->valor_total, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No hay detalles para esta factura</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 d-flex justify-content-between">
    <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar esta factura?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="bi bi-trash"></i> Eliminar Factura
        </button>
    </form>
</div>
@endsection 