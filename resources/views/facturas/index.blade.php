@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Lista de Facturas</h1>
    <a href="{{ route('facturas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Crear Nueva Factura
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facturas as $factura)
            <tr>
                <td>{{ $factura->cliente->nombre }}</td>
                <td>{{ date('d/m/Y', strtotime($factura->fecha_venta)) }}</td>
                <td>${{ number_format($factura->subtotal, 2) }}</td>
                <td>${{ number_format($factura->iva, 2) }}</td>
                <td>${{ number_format($factura->total, 2) }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('facturas.show', $factura->id) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i> Ver
                        </a>
                        <a href="{{ route('facturas.edit', $factura->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro que desea eliminar esta factura?')">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
