@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Editar Producto</h1>
    <a href="{{ route('productos.index') }}" class="btn btn-secondary">
        Volver a la lista
    </a>
</div>

<form action="{{ route('productos.update', $producto->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
               id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}">
        @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="costo" class="form-label">Costo:</label>
        <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="number" class="form-control @error('costo') is-invalid @enderror" 
                   id="costo" name="costo" step="0.01" value="{{ old('costo', $producto->costo) }}">
            @error('costo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection
