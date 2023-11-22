<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"> <?php echo e($usuario); ?>  </a>
    <a class="btn btn-secondary" href="administrador.php"> Volver </a>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>