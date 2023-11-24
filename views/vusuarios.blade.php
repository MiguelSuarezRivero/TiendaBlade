@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"> {{$usuario}}  </a>
    <a class="btn btn-secondary" href="administrador.php"> Volver </a>
    &nbsp; 
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
<br>
<h5><strong>Usuario activos</strong></h5>
<form action="#" method="post">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Perfil</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  {!!$html!!}  
   
  </tbody>
</table>
<i>* No está recomendada la eliminación de clientes, pues lleva consigo la eliminación de su histórico de pedidos.</i>
<br><br><br>
<h5><strong>Crear usuario</strong></h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Contraseña</th>
      <th scope="col">Perfil</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><input type="text" name="nombre" placeholder="Nombre" required></td>
      <td><input type="password" name="pass" placeholder="Contraseña" required></td>
      <td><select name="rol">
        <option value="0">Administrador</option>
        <option value="1">Cliente</option>
      </select></td>
      <td> <input type="submit" class="btn btn-primary" value="Crear usuario" name="crear"></td>
    </tr>
    </tbody>
</table>
</form>


@endsection