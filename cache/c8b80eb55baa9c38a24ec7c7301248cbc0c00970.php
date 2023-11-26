<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <span class="navbar-brand"> <?php echo e($usuario); ?>  </span>
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
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
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
        <?php $__currentLoopData = $carrito; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>       
        <tr>  
                <td><?php echo $producto['qr']; ?></td>
                <td><?php echo $producto['nombre']; ?> </td>
                <td><?php echo $producto['familia']; ?></td>
                <td><?php echo $producto['pvp']; ?> €</td>
                <td><?php echo $producto['cantidad']; ?></td>
                <td> <?php echo $producto['total']; ?> €</td>
        </tr>   
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
                <td> </td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo e($totalCesta); ?></td>
                <td><?php echo e($total); ?> €</td>
        </tr>
        </tbody>
    </table> 
      <input class="btn btn-primary" type="submit" value="Comprar" name="comprar"> 
      &nbsp;  
      <input class="btn btn-danger" type="submit" value="Vaciar cesta" name="vaciar"> 
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>