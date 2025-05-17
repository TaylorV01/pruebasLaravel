@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Crear Factura</h1>
    <a href="{{ route('facturas.index') }}" class="btn btn-secondary">
        Volver a la lista
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('facturas.store') }}">
            @csrf

            <div class="mb-3">
                <label for="cliente_id" class="form-label">Cliente:</label>
                <select class="form-select @error('cliente_id') is-invalid @enderror" id="cliente_id" name="cliente_id">
                    <option value="">Seleccione un cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('cliente_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <h4 class="mb-3">Productos</h4>
            
            <div id="productos">
                <div class="producto mb-3 p-3 border rounded">
                    <div class="row">
                        <div class="col-md-5 mb-2">
                            <label class="form-label">Producto:</label>
                            <select class="form-select" name="producto_id[]">
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->nombre }} - ${{ number_format($producto->costo, 2) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Cantidad:</label>
                            <input type="number" class="form-control" name="cantidad[]" value="1" min="1">
                        </div>
                        <div class="col-md-3 mb-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger" onclick="eliminar(this)">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-secondary" onclick="agregarProducto()">
                    <i class="bi bi-plus-circle"></i> Agregar Producto
                </button>
            </div>

            <div class="d-grid gap-2 col-md-4 mx-auto mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Guardar Factura</button>
            </div>
        </form>
    </div>
</div>

<script>
function agregarProducto() {
    const div = document.querySelector('.producto').cloneNode(true);
    
    // Limpiar valores
    const inputs = div.querySelectorAll('input');
    inputs.forEach(input => {
        input.value = input.name === 'cantidad[]' ? 1 : '';
    });
    
    // Restablecer selects
    const selects = div.querySelectorAll('select');
    selects.forEach(select => {
        select.selectedIndex = 0;
    });
    
    document.getElementById('productos').appendChild(div);
}

function eliminar(btn) {
    const total = document.querySelectorAll('.producto').length;
    if (total > 1) {
        btn.closest('.producto').remove();
    } else {
        alert('Debe tener al menos un producto');
    }
}
</script>
@endsection
