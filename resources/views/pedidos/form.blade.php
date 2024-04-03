<div class="container">
    <h1>{{ $modo }} Pedido</h1>

    @if(count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($pedido) ? url('/pedido/'.$pedido->id) : url('/pedido') }}" method="POST">
        @csrf
        @if(isset($pedido))
            @method('PATCH')
        @endif

        <div class="form-group">
            <label for="producto">Producto</label>
            <input type="text" class="form-control" id="producto" name="producto" value="{{ isset($pedido->producto) ? $pedido->producto : old('producto') }}" placeholder="Introduzca Producto">
        </div>
    <br>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="text" class="form-control" id="precio" name="precio" value="{{ isset($pedido->precio) ? $pedido->precio : old('precio') }}" placeholder="Introduzca Precio">
        </div>
<br>
        <div class="form-group">
            <label for="id">Documento</label>
            <input type="text" class="form-control" id="id" name="id" value="{{ isset($pedido->id) ? $pedido->id : old('id') }}" placeholder="Introduzca Documento">
        </div>
<br>
        <button type="submit" class="btn btn-primary">{{ $modo }} Registro</button>
    </form>
</div>
