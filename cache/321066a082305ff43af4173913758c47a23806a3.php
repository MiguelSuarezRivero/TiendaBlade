<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
   <span class="navbar-brand"> <?php echo e($usuario); ?>  </span>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <a class="btn btn-primary" href="pedidos.php?usuario=<?php echo $_SESSION['nombre']; ?>">Mis pedidos</a>
        &nbsp; 
        <a class="btn btn-primary" href="cesta.php">Cesta ( <?php echo e($totalCesta); ?> )</a>
        &nbsp;  
        <a class="btn btn-secondary" href="tienda.php"> Volver </a>
        &nbsp; 
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
        <?php $__currentLoopData = $producto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <table class='formDetalle'>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td><?php echo e($item->id); ?></td>
                </tr> 
                <tr>
                    <td>Referencia</td>
                    <td><?php echo e($item->nombre_corto); ?></td>
                </tr> 
                <tr>
                    <td>Nombre</td>
                    <td><?php echo e($item->nombre); ?></td>
                </tr> 
                <tr>
                    <td>Descripión</td>
                    <td><?php echo e($item->descripcion); ?></td>
                </tr> 
                <tr>
                    <td>Familia</td>
                    <td><?php echo e($item->familia); ?></td>
                </tr> 
                <tr>
                    <td>PVP</td>
                    <td><?php echo e($item->pvp); ?></td>
                </tr> 
             </tbody>
          </table>
    <table>            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>