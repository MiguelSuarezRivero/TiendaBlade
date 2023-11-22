@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
   <span class="navbar-brand"> {{$usuario}}  </span>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <a class="btn btn-primary" href="pedidos.php?usuario=<?php echo $_SESSION['nombre']; ?>">Mis pedidos</a>
        &nbsp; 
        <a class="btn btn-primary" href="cesta.php">Cesta ( {{$totalCesta}} )</a>
        &nbsp;  
        <a class="btn btn-secondary" href="tienda.php"> Volver </a>
        &nbsp; 
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
        @foreach($producto as $item)
        <table class='formDetalle'>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>{{$item->id}}</td>
                </tr> 
                <tr>
                    <td>Referencia</td>
                    <td>{{$item->nombre_corto}}</td>
                </tr> 
                <tr>
                    <td>Nombre</td>
                    <td>{{$item->nombre}}</td>
                </tr> 
                <tr>
                    <td>Descripión</td>
                    <td>{{$item->descripcion}}</td>
                </tr> 
                <tr>
                    <td>Familia</td>
                    <td>{{$item->familia}}</td>
                </tr> 
                <tr>
                    <td>PVP</td>
                    <td>{{$item->pvp}}</td>
                </tr> 
             </tbody>
          </table>
    <table>            
        @endforeach
@endsection