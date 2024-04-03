@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<h1 class="mt-4">{{$modo}} Clientes</h1>
<input type="text" value="{{ isset($cliente->id) ? $cliente->id:old('id')}}" name="id" id="id" class="form-control mb-2" placeholder="Introduzca Documento">
<input type="text" value="{{ isset($cliente->nombres) ? $cliente->nombres:old('nombres')}}" name="nombres" id="nombres" class="form-control mb-2" placeholder="Introduzca Nombres">
<input type="text" value="{{ isset($cliente->apellidos) ? $cliente->apellidos:old('apellidos')}}" name="apellidos" id="apellidos" class="form-control mb-2" placeholder="Introduzca Apellidos">
<input type="text" value="{{ isset($cliente->correo) ? $cliente->correo:old('correo')}}" name="correo" id="correo" class="form-control mb-2" placeholder="Introduzca Correo">
<input type="file" name="foto" id="foto" class="form-control-file mb-2">
@if(isset($cliente->foto))
<img src="{{ asset('storage').'/'.$cliente->foto }}" width="80" height="100" class="mt-2">
@endif
<br><br>
<input type="submit" value="{{$modo}} Registro" class="btn btn-primary">
