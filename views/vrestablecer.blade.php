@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
@section('encabezado')
    {{$titulo}}
@endsection
@section('contenido')
<br>
<p style="margin-bottom:-2px;"> {{$nombre}}, ahora puedes regenerar tu contraseña.</p>
<form class="row g-4 " action="#" method="post">
  
   <div class="col-md-2">
   <br><br>
    <label class="form-label">Nueva contraseña</label>
    <input type="password" class="form-control"  name="pass" required> 
    <input type="hidden" name="nombre" value="{{$nombre}}">
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit" name="restablecer">Restablecer</button>

  </div>
</form>
@endsection