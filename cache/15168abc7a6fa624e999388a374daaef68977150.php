<?php require '../vendor/autoload.php'; 
use MisClases\Stock;
use MisClases\Productos;
?>

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
<table class="table table-striped">
  <thead>
    <tr>
      <th></th>
      <th><a class="order" href="tienda.php?order=nombre"><i class="bi bi-sort-alpha-down"> Producto</i></a></th>
      <th><a class="order" href="tienda.php?order=familia"><i class="bi bi-sort-alpha-down"> Familia </i></a></th>
      <th><a class="order" href="tienda.php?order=pvp"><i class="bi bi-sort-numeric-down"> PVP</i></a></th>
      <th><a class="order" href="tienda.php?order=unidades"><i class="bi bi-sort-numeric-down"> Stock</i></a></th>
    </tr>
  </thead>
  <tbody>
        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!isset($_SESSION['cesta']["{$producto->id}"])) $_SESSION['cesta']["{$producto->id}"] = 0; ?>
            <tr>
                <td><?php echo Productos::generarCodigoQR("{$producto->id}"); ?></td>
                <td><a href="detalle.php?id=<?php echo e($producto->id); ?>"><?php echo e($producto->nombre); ?></a> </td>
                <td><?php echo e($producto->familia); ?></td>
                <td><?php echo e($producto->pvp); ?> €</td>
                <td><?php echo Stock::getStock("{$producto->id}"); ?></td>
                <td>
                  <form action="#" method="post">
                    <input type="hidden" value="<?php echo e($producto->id); ?>" name="id">
                    <input type="submit" class="btn btn-danger" value="-" name="remove">
                    <?php                         
                    if($_SESSION['cesta']["{$producto->id}"] == Stock::getStock("{$producto->id}") ){
                      echo '<input type="submit" class="btn btn-primary" value="+" name="add" disabled>';
                    }else{
                      echo '<input type="submit" class="btn btn-primary" value="+" name="add">';
                    } ?>
                    <span class="badge bg-secondary"><?php echo $_SESSION['cesta']["{$producto->id}"]; ?></span>
                  </form>
                </td>                
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>