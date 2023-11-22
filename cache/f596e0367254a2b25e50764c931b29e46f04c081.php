<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <span class="navbar-brand"> <?php echo e($usuario); ?>  </span>
    <a class="btn btn-secondary" href="tienda.php"> Volver </a>    
    &nbsp; 
    <a class="btn btn-primary" href="cesta.php">Cesta ( <?php echo e($totalCesta); ?> )</a>
    &nbsp;  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form style="height:22px;" method="post">
        <button class="btn btn-secondary" name="cerrar_sesion" type="submit">Cerrar sesión</button>
      </form>
    </div>
  </div>
</nav>
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>

<?php 
$ultimoPedido = 0;
$primeraIteracion = false; 
$importeTotalPedido = 0; 
$totalUnidades = 0; 
?>
  <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pedido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php if( $ultimoPedido != $pedido->pedido ): ?>

      <?php if( $primeraIteracion ): ?>
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
        <?php endif; ?>
    
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
      <?php endif; ?>
   
    
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
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <tr>  
                  <td><strong>Total</strong></td>
                  <td></td>
                  <td><strong><?php echo $totalUnidades; ?></strong></td>
                  <td><strong><?php echo number_format($importeTotalPedido, 2, ',', '.'); ?> €</strong></td>

          </tr>          
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>