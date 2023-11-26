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

@endsection