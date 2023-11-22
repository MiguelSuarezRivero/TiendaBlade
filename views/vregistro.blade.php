@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
@section('encabezado')
    {{$encabezado}}
@endsection
@section('contenido')

    <form class="row g-4 " action="#" method="post">
   <div class="col-md-2">
    <label class="form-label">Nombre</label>
    <input type="text" class="form-control  <?php if(isset($_SESSION['error'])) echo " is-invalid";?>"  name="nombre" required>
   
  </div>
  <div class="col-md-2">
    <label  class="form-label">Contraseña</label>
    <input type="password" class="form-control <?php if(isset($_SESSION['error'])) echo " is-invalid";?>"  name="pass"  required>
  </div>  
  <div class="col-12">
    <button class="btn btn-primary" type="submit" name="registrar">Crear</button>
    <a class="btn btn-secondary" href="index.php" > Regresar</a>
  </div>
</form>
<?php if(isset($_SESSION['error'])){
        echo "<div style='margin-top: 0.25rem;font-size: .875em;color: var(--bs-form-invalid-color);'>Ya existe un usuario con el mismo nombre. </div>";
    } ?>
<?php unset($_SESSION['error']); ?>
@endsection