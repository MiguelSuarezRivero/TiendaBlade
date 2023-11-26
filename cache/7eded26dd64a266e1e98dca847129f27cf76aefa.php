<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
<br>
<p style="margin-bottom:-2px;">Introduce tu nombre de usuario, si existe te enviaremos un correo* de recuperación a la cuenta asociada.</p>
<i style="font-size: 14px;">* El correo puede tardar unos minutos en llegar.</i>   
<form class="row g-4 " action="#" method="post">
  
   <div class="col-md-2">
   <br><br>
    <label class="form-label">Nombre de usuario</label>
    <input type="text" class="form-control"  name="nombre" required> 
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit" name="recuperar">Recuperar</button>
    <a class="btn btn-secondary" href="index.php" > Regresar</a>
  </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>