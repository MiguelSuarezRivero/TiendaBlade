@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
@section('encabezado')
    {{$encabezado}}    
@endsection
@section('contenido')
<br>
<br>
<p>Los siguientes datos relacionarán la aplicación con tu gestor de base de datos MySQL, la base de datos será creada automáticamente, por 
    lo que <strong>NO debes asignarle el nombre de una base de datos ya existente.</strong> </p>

<br>
<form action="instalar.php" method="POST">
<div class="mb-3">
  <label class="form-label">Host de la base de datos</label>
  <input type="text" class="form-control" name="host" placeholder="Introduce el host de la base datos" required>
</div>
<br>
<div class="mb-3">
  <label class="form-label">Nombre de la base de datos</label>
  <input type="text" class="form-control" name="bbdd" placeholder="Introduce el nombre que tendrá la base de datos" required>
</div>
<br>
<div class="mb-3">
  <label class="form-label">Usuario de la base de datos</label>
  <input type="text" class="form-control" name="usuario" placeholder="Introduce el usuario de la base de datos" required>
</div>
<br>
<div class="mb-3">
  <label class="form-label">Contraseña de la base de datos</label>
  <input type="text" class="form-control" name="pass" placeholder="Introduce la contraseña del usuario de la base datos">
</div>
<br>
<div class="mb-3">
  <label class="form-label">Usuario administrador de la tienda online</label>
  <input type="text" class="form-control" name="usuario_tienda" placeholder="Introduce el administrador de la tienda online" required>
</div>
<br>
<div class="mb-3">
  <label class="form-label">Contraseña del administrador de la tienda online</label>
  <input type="text" class="form-control" name="pass_tienda" placeholder="Introduce la contraseña del administrador de la tienda online" required>
</div>
<br>
<input type="submit" value="Instalar" name="instalar" class="btn btn-primary">
</form>
<br>
<p>Al finalizar la instalación tendrás disponible un usuario con perfil de cliente, podrás utilizar este usuario para realizar
    pruebas en la tienda, las compras realizadas por el mismo no afectarán en el stock de los productos. </p>
<span>Nombre: <code>cliente</code> Contraseña: <code>cliente</code></span>r
<br><br><br><br>
@endsection