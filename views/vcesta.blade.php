@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <span class="navbar-brand"> {{$usuario}}  </span>
    <a class="btn btn-primary" href="pedidos.php?usuario=<?php echo $_SESSION['nombre']; ?>">Mis pedidos</a>
    &nbsp; 
    <a class="btn btn-secondary" href="tienda.php"> Volver </a>    
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
<form action="#" method="post">
<table class="table table-striped">
<thead>
    <tr>
      <th></th>
      <th>Nombre</th>
      <th>Familia</th>
      <th>PVP</th>
      <th>Unid.</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
        @foreach($carrito as $producto)       
        <tr>  
                <td><?php echo $producto['qr']; ?></td>
                <td><?php echo $producto['nombre']; ?> </td>
                <td><?php echo $producto['familia']; ?></td>
                <td><?php echo $producto['pvp']; ?> €</td>
                <td><?php echo $producto['cantidad']; ?></td>
                <td> <?php echo $producto['total']; ?> €</td>
        </tr>   
        @endforeach
        <tr>
                <td> </td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$totalCesta}}</td>
                <td>{{$total}} €</td>
        </tr>
        </tbody>
    </table> 
      <input class="btn btn-primary" type="submit" value="Comprar" name="comprar"> 
      &nbsp;  
      <input class="btn btn-danger" type="submit" value="Vaciar cesta" name="vaciar"> 
</form>
@endsection