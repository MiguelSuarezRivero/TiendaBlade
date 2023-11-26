<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
<br>
<p style="margin-bottom:-2px;"> <?php echo e($nombre); ?>, ahora puedes regenerar tu contraseña.</p>
<form class="row g-4 " action="#" method="post">
  
   <div class="col-md-2">
   <br><br>
    <label class="form-label">Nueva contraseña</label>
    <input type="password" class="form-control"  name="pass" required> 
    <input type="hidden" name="nombre" value="<?php echo e($nombre); ?>">
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit" name="restablecer">Restablecer</button>

  </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>