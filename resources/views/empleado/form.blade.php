
<h1>{{ $modo }} empleado</h1>

@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
    <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
@endif
<div class="form-group">
<label for="Nombre">Nombre: </label>
<input type="text" class="form-control" name="Nombre" value="{{  isset($empleado->Nombre) ? $empleado->Nombre:old('Nombre') }}" id="Nombre"><br>
</div>
<div class="form-group">
<label for="Apellido_paterno">Apellido paterno: </label>
<input type="text" class="form-control" name="Apellido_paterno" value="{{ isset($empleado->Apellido_paterno) ? $empleado->Apellido_paterno:old('Apellido_paterno') }}" id="Apellido_paterno"><br>
</div>
<div class="form-group">
<label for="Apellido_materno">Apellido materno: </label>
<input type="text" class="form-control" name="Apellido_materno" value="{{ isset($empleado->Apellido_materno) ? $empleado->Apellido_materno:old('Apellido_materno') }}" id="Apellido_materno"><br>
</div>
<div class="form-group">
<label for="Correo_eletronico">Correo electrónico: </label>
<input type="text" class="form-control" name="Correo_electronico" value="{{ isset($empleado->Correo_electronico) ? $empleado->Correo_electronico:old('Correo_electronico') }}" id="Correo_electronico"><br>
</div>
<div class="form-group">
<label for="Foto">Foto: </label>
@if(isset($empleado->Foto))
<!--ruta de la foto  {{ $empleado->Foto }}-->
<img class="img-thumbnail img=fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="100" alt ="">
@endif
<input type="file" class="form-control" name="Foto" value="" id="Foto"><br>
</div>
<a class="btn btn-primary" href="{{ url('empleado/') }}" class="" >Regresar</a>

<input class="btn btn-success" type="submit" value="{{ $modo }} datos"><br>
