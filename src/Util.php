<?php
namespace MisClases;
require_once '../vendor/autoload.php';

class Util{

  public static function verificaConfiguracion(){
   
    if (!file_exists('../src/Configuracion.php')){
      header("Location: index.php");
    }
  }

  public static function verificaSesion(){

    if(!isset($_SESSION['nombre'])){
      header("Location: index.php");
    } 

    if(isset($_POST['cerrar_sesion'])){
      unset($_SESSION['cerrar_sesion']);
      unset($_SESSION['nombre']);
      header("Location: index.php");
    } 
  } 

  public static function addProductoCesta(){

    if(isset($_POST['add'])){
      $cantidad = $_SESSION['cesta'][$_POST['id']];
       $cantidad++;
       $_SESSION['cesta'][$_POST['id']]= $cantidad;    
   
   }
}

  public static function eliminaProductoCesta(){
   
   if(isset($_POST['remove'])){
       $cantidad = $_SESSION['cesta'][$_POST['id']];
       if($cantidad>0){
           $cantidad--;
           $_SESSION['cesta'][$_POST['id']]= $cantidad;  
       }
          
    }
  }

  public static function ordenaProductos(){
      if(isset($_GET['order'])){
        switch($_GET['order']){
            case 'nombre':
                $productos = (new Productos())->getProductos("nombre");
                break;
            case 'familia':
                $productos = (new Productos())->getProductos("familia");
                break;
            case 'pvp':
                $productos = (new Productos())->getProductos("pvp");
                break;
            case 'unidades':
                $productos = (new Productos())->getProductos("unidades");
                break;
            default:
                $productos = (new Productos())->getProductos("nombre");
        }
        return $productos;
    }else{
       return $productos = (new Productos())->getProductos("nombre");
    }
  }


  public static function generaDatosRecuperacionCorreo($nombre){
    $datos = (new Usuario())->getEmail($nombre);
    if(is_array($datos)){
      $datos_usuario['nombre'] = $nombre;
      $datos_usuario['email'] = $datos[0]->email;
      return $datos_usuario;
    }else{
      return 0;
    }
   
   
  }


  

  public static function restablecePassword(){
    if(isset($_POST['restablecer'])){
      $restablecer = (new Usuario)->restablecerPass($_POST['nombre'], $_POST['pass']);
      header("Location: index.php");
  }
  }

  public static function usuariosActivos(){
    $usuarios = (new Usuario)->mostrarUsuarios();
    
    $html= "";
    foreach($usuarios as $user){
      $propioUsuario = ($_SESSION['nombre'] == $user->nombre)?"</td><td></td>":"</td><td><a class='btn btn-primary' href='usuarios.php?eliminar=$user->nombre'>Eliminar</a></td>";
        if(isset($_GET['editar'])){
            if($_GET['editar'] == $user->nombre){
                $activo = ($user->activo == 1)?"checked":"";
                $rol = ($user->rol == 0)?'<option value="0" selected>Administrador</option><option value="1">Cliente</option>':'<option value="0">Administrador</option><option value="1" selected>Cliente</option>';
                $html .= "<tr><td><input type='hidden' value='$user->nombre' name='nombre'>$user->nombre</td>";
                $html .= "<td><input type='text' name='email' value='$user->email'></td>";
                $html .= "<td><select name='rol'>$rol</select></td></td>";
                $html .= "<td><input type='checkbox' $activo name='activo'>";
                $html .= $propioUsuario;
                $html .= "<td><input type='submit' class='btn btn-success' name='guardar' value='Guardar'></td></tr>";
            }else{
                $activo = ($user->activo == 1)?"checked":"";
                $rol = ($user->rol == 0)?'Administrador':'Cliente';
                $html .= "<tr><td>";
                $html .= $user->nombre;
                $html .= "</td><td>";
                $html .= "$user->email</td><td>";
                $html .= $rol;
                $html .= "</td><td><input type='checkbox' disabled $activo name='activo'>";
                $html .= $propioUsuario;
                $html .= "<td><a class='btn btn-warning' href='usuarios.php?editar=$user->nombre";
                $html .= "'>Modificar</a></td></tr>";
            }
        }else{
            $activo = ($user->activo == 1)?"checked":"";
            $rol = ($user->rol == 0)?'Administrador':'Cliente';
            $html .= "<tr><td>";
            $html .= $user->nombre;
            $html .= "</td><td>";
            $html .= "$user->email</td><td>";
            $html .= $rol;
            $html .= "</td><td><input type='checkbox' disabled $activo name='activo'>";
            $html .= $propioUsuario;
            $html .= "<td><a class='btn btn-warning' href='usuarios.php?editar=$user->nombre";
            $html .= "'>Modificar</a></td></tr>";
        }
    }

    return $html;
  }
}

