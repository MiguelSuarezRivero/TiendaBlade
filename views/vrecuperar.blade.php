@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
@section('encabezado')
    {{$encabezado}}
@endsection
@section('contenido')
<br>
<p style="margin-bottom:-2px;">Introduce tu nombre de usuario, si existe te enviaremos un correo* de recuperación a la cuenta asociada.</p>
<i style="font-size: 14px;">* El correo puede tardar unos minutos en llegar.</i>   
<form class="row g-4 " action="#" method="post">
  
   <div class="col-md-2">
   <br><br>
    <label class="form-label">Nombre de usuario</label>
    <input type="text" class="form-control"  name="nombre" required> 
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit" name="recuperar">Recuperar</button>
    <a class="btn btn-secondary" href="index.php" > Regresar</a>
  </div>
</form>
@endsection