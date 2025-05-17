@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Editar Cliente</h1>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
        Volver a la lista
    </a>
</div>

<form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
    @csrf 
    @method('PUT')
    
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
               id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}">
        @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection
