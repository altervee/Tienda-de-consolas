<?php 
require '../config/config.php';
//require '../config/database.php';
if(isset($_POST['id'])){// verificar que nos envian datos
    $id = $_POST['id'];
    $token = $_POST['token'];
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN); //vueleve a hacer el procesamiento del token
    if ($token == $token_tmp) {
        if (isset( $_SESSION['carrito']['productos'][$id])){// si el usuario lo compra mas de 1 vez va sumando
            $_SESSION['carrito']['productos'][$id] += 1;
        }else{
        $_SESSION['carrito']['productos'][$id] = 1;// si el usuario lo compra por primera vez se le asigna 1 al product
        }
        $datos['numero'] = count( $_SESSION['carrito']['productos']);// contamos los productos que se agregan
        $datos['ok']=true;
    }else{
        $datos['ok']=false;
    }
}else{
    $datos['ok']=false;//no estan llegando 
}
echo json_encode($datos);//regresamos los datos
?>