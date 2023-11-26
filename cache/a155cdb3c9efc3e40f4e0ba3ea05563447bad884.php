<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>

    <form class="row g-4 " action="#" method="post">
   <div class="col-md-2">
    <label class="form-label">Nombre</label>
    <input type="text" class="form-control  <?php if(isset($_SESSION['error'])) echo " is-invalid";?>"  name="nombre" required>
   
  </div>
  <div class="col-md-2">
    <label class="form-label">Correo electrónico</label>
    <input type="email" class="form-control  <?php if(isset($_SESSION['error'])) echo " is-invalid";?>"  name="email" required>
   
  </div>
  <div class="col-md-2">
    <label  class="form-label">Contraseña</label>
    <input type="password" class="form-control <?php if(isset($_SESSION['error'])) echo " is-invalid";?>"  name="pass"  required>
  </div>  
  <div class="col-12">
    <button class="btn btn-primary" type="submit" name="registrar">Crear</button>
    <a class="btn btn-secondary" href="index.php" > Regresar</a>
  </div>
</form>
<?php if(isset($_SESSION['error'])){
        echo "<div style='margin-top: 0.25rem;font-size: .875em;color: var(--bs-form-invalid-color);'>Ya existe un usuario con el mismo nombre. </div>";
    } ?>
<?php unset($_SESSION['error']); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>