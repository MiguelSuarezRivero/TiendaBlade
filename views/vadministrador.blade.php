@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"> {{$usuario}}  </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form style="height:22px;" method="post">
        <button class="btn btn-secondary" name="cerrar_sesion" type="submit">Cerrar sesión</button>
      </form>
    </div>
  </div>
</nav>
@section('encabezado')
    {{$encabezado}}    
@endsection
@section('contenido')
<div class="card">
  <div class="card-header">
   Gestión de usuarios
  </div>
  <div class="card-body">
    <h5 class="card-title">Administración de usuarios</h5>
    <p class="card-text">Cree elimine o modifique los diferentes perfiles de usuario.</p>
    <a href="gestion-usuarios.php" class="btn btn-primary">Gestionar usuarios</a>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header">
   Gestión de pedidos
  </div>
  <div class="card-body">
    <h5 class="card-title">Administración de pedidos</h5>
    <p class="card-text">Visualice los diferentes pedidos de los usuarios</p>
    <a href="gestion-pedidos.php" class="btn btn-primary">Gestionar pedidos</a>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header">
   Gestión de productos 
  </div>
  <div class="card-body">
    <h5 class="card-title">Administración de productos</h5>
    <p class="card-text">Cree elimine o modifique los diferentes productos así como su stock</p>
    <a href="gestion-productos.php" class="btn btn-primary">Gestionar productos</a>
  </div>
</div>
@endsection