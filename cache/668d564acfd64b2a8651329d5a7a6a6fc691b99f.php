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
<br>
<h5><strong>Usuario activos</strong></h5>
<form action="#" method="post">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Perfil</th>
      <th scope="col">Activo</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php echo $html; ?>  
   
  </tbody>
</table>
</form>
<i>* Previo a la eliminación de un cliente <span style="<?php if(isset($_SESSION['error'])){echo 'color:red;';unset($_SESSION['error']);} ?>">debe eleminar los pedidos asociados al mismo.</span> No se recomienda la eliminación de los mismos, pues perderá el histórico de transacciones, si quiere cancelar el uso de un usuario es preferible deshabilitarlo.</i>
<br><br><br>
<h5><strong>Crear usuario</strong></h5>
<form action="#" method="post">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Contraseña</th>
      <th scope="col">Email</th>
      <th scope="col">Perfil</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><input type="text" name="nombre" placeholder="Nombre" required></td>
      <td><input type="password" name="pass" placeholder="Contraseña" required></td>
      <td><input type="email" name="email" placeholder="Correo electrónico" required></td>
      <td><select name="rol">
        <option value="0">Administrador</option>
        <option value="1">Cliente</option>
      </select></td>
      <td> <input type="submit" class="btn btn-success" value="Crear usuario" name="crear"></td>
    </tr>
    </tbody>
</table>
</form>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>