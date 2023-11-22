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
    <?php if(isset($_SESSION['error'])){
        echo "<div class='invalid-feedback'>Los datos de acceso no son correctos. </div>";
    } ?>
  </div>
  <div class="col-md-2">
    <label  class="form-label">Contraseña</label>
    <input type="password" class="form-control <?php if(isset($_SESSION['error'])) echo " is-invalid";?>"  name="pass"  required>
  </div>  
  <div class="col-12">
    <button class="btn btn-primary" type="submit" name="login">Acceder</button>
    <br><br>
    <p>¿No tienes cuenta? <a href="registro.php">Registrate</<a></p>
  </div>
</form>
<?php unset($_SESSION['error']); ?>
@endsection