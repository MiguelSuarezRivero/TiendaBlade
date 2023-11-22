@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <span class="navbar-brand"> {{$usuario}}  </span>
    <a class="btn btn-secondary" href="tienda.php"> Volver </a>    
    &nbsp; 
    <a class="btn btn-primary" href="cesta.php">Cesta ( {{$totalCesta}} )</a>
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

<?php 
$ultimoPedido = 0;
$primeraIteracion = false; 
$importeTotalPedido = 0; 
$totalUnidades = 0; 
?>
  @foreach($pedidos as $pedido)

    @if( $ultimoPedido != $pedido->pedido )

      @if( $primeraIteracion )
        <tr>  
                    <td><strong>Total</strong></td>
                    <td></td>
                    <td><strong><?php echo $totalUnidades; ?></strong></td>
                    <td><strong><?php echo number_format($importeTotalPedido, 2, ',', '.'); ?> €</strong></td>

            </tr>      
          <?php 
          $importeTotalPedido=0; 
          $totalUnidades = 0; 
          ?>
        @endif
    
        <table class=" table table-primary">
        <thead>
        <tr>
            <th>Pedido # <?php echo $pedido->pedido; ?></th>
            <th>Fecha: <?php echo $pedido->fecha; ?></th>
        </tr>
               
        <table class="table table-striped">
              <thead>
              <tr>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Unid.</th>
                  <th>Importe</th>
              </tr>
              </thead>
      @endif
   
    
        <tr>  
                <td><?php echo $pedido->producto; ?></td>
                <td><?php echo $pedido->precio; ?> €</td>
                <td><?php echo $pedido->cantidad; ?></td>
                <td><?php echo number_format($pedido->cantidad * $pedido->precio, 2, ',', '.'); ?> €</td>
                <?php 
                $importeTotalPedido += $pedido->cantidad * $pedido->precio;
                $totalUnidades += $pedido->cantidad;
                
                ?>
        </tr>
       
<?php 
$ultimoPedido = $pedido->pedido; 
$primeraIteracion = true; 
?>
  @endforeach
  <tr>  
                  <td><strong>Total</strong></td>
                  <td></td>
                  <td><strong><?php echo $totalUnidades; ?></strong></td>
                  <td><strong><?php echo number_format($importeTotalPedido, 2, ',', '.'); ?> €</strong></td>

          </tr>          
      
@endsection