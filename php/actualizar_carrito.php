<<<<<<< HEAD
<?php
require '../config/config.php';
require '../config/database.php';

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id']:0;// si existe el valor id se reecopila si no se le da el valor 0
    if($action == 'agregar'){
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad']:0;//recbimos la cantidad que va a agregar
        $respuesta = agregar($id, $cantidad);
        if($respuesta > 0){
            $datos['ok']= true;// si respuesta es mayor a 0
        
    }else{
        $datos['ok']= false;
    }
    $datos['sub'] = number_format($respuesta, 2,'.',',') . MONEDA;

} else if($action == 'eliminar'){// cuando la accion sea eliminar
    $datos['ok'] = eliminar($id);
    
} else{
    $datos['ok']= false;
}
}else{
    $datos['ok']= false;
}
echo json_encode($datos);// esto es lo que regresa la petición 

function agregar($id, $cantidad){
$res = 0;
if($id > 0 && $cantidad > 0 && is_numeric(($cantidad))){// para que la cantidad sea númerica y ofrezca cambuos
    if(isset($_SESSION['carrito']['productos'][$id])){// validamos qu el id del producto existe 
        $_SESSION['carrito']['productos'][$id] = $cantidad; // se le da el nuevo valor de cantidad para modificarlo

        $db = new Database();
        $con = $db->conectar();
        $sql = $con->prepare("SELECT precio, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1"); // LO DE ACTIVO SIRVE PARA QUITAR PRODUCTOS PONIEND EN LA BD SI CAMBIAMOS DE VALOR NO LOS MOSTRARÁ
        $sql->execute([$id]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);// se asigna en un asociativo

        $precio = $row['precio'];
        $descuento = $row['descuento'];
        $precio_desc = $precio - (($precio * $descuento) / 100);// si queremos meter en la bd descuentos lo actualizará
        $res = $cantidad * $precio_desc;
        return $res;

    }

}else{// si no recoge los daatos res seria igual a 0
    return $res;
}
}
function eliminar($id){
    if($id > 0){
        if(isset($_SESSION['carrito']['productos'][$id])){
            unset($_SESSION['carrito']['productos'][$id]);
            return true ;
        }
    }else{
        return false;
    }
}
=======
<?php
require '../config/config.php';
require '../config/database.php';

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id']:0;// si existe el valor id se reecopila si no se le da el valor 0
    if($action == 'agregar'){
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad']:0;//recbimos la cantidad que va a agregar
        $respuesta = agregar($id, $cantidad);
        if($respuesta > 0){
            $datos['ok']= true;// si respuesta es mayor a 0
        
    }else{
        $datos['ok']= false;
    }
    $datos['sub'] = number_format($respuesta, 2,'.',',') . MONEDA;

} else if($action == 'eliminar'){// cuando la accion sea eliminar
    $datos['ok'] = eliminar($id);
    
} else{
    $datos['ok']= false;
}
}else{
    $datos['ok']= false;
}
echo json_encode($datos);// esto es lo que regresa la petición 

function agregar($id, $cantidad){
$res = 0;
if($id > 0 && $cantidad > 0 && is_numeric(($cantidad))){// para que la cantidad sea númerica y ofrezca cambuos
    if(isset($_SESSION['carrito']['productos'][$id])){// validamos qu el id del producto existe 
        $_SESSION['carrito']['productos'][$id] = $cantidad; // se le da el nuevo valor de cantidad para modificarlo

        $db = new Database();
        $con = $db->conectar();
        $sql = $con->prepare("SELECT precio, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1"); // LO DE ACTIVO SIRVE PARA QUITAR PRODUCTOS PONIEND EN LA BD SI CAMBIAMOS DE VALOR NO LOS MOSTRARÁ
        $sql->execute([$id]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);// se asigna en un asociativo

        $precio = $row['precio'];
        $descuento = $row['descuento'];
        $precio_desc = $precio - (($precio * $descuento) / 100);// si queremos meter en la bd descuentos lo actualizará
        $res = $cantidad * $precio_desc;
        return $res;

    }

}else{// si no recoge los daatos res seria igual a 0
    return $res;
}
}
function eliminar($id){
    if($id > 0){
        if(isset($_SESSION['carrito']['productos'][$id])){
            unset($_SESSION['carrito']['productos'][$id]);
            return true ;
        }
    }else{
        return false;
    }
}
>>>>>>> aa635ac89f4ca6c2a74ce5a3c47f6b80dcc738d0
?>