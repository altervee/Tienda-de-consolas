<<<<<<< HEAD
<?php
require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();

$total = isset($_GET['total']) ? $_GET['total'] : ''; 
if ($total == 0) {
    echo 'Error al procesar al peticion 1';
    exit;
}
$lista_carrito = array();
//session_destroy(); esta parte la uso para reiniciar las seiones gg

?>
<!DOCTYPE html>
    <html lang="es">
    <head>
        <title>Trabajo final de grado Ivan Caldero Culebras</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../icono/pink.ico" type="imagen/ico" />
        <link rel="stylesheet" href="../CSS/primero.css" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous"><!--Consume menos recursos y es como el css-->
        </head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
crossorigin="anonymous"></script>
<header>

<div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <a href="#" class="navbar-brand">
        <strong>Retro gaming</strong>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    </div>
    </div>
</div>
</header>
<main>
<form method="post" action="finalizar.php?total=<?php echo $total;?>">
<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre" size="20px" placeholder="Jhon" require>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="nadie@gmail.com" require>
</div>
<div class="mb-3">
    <label for="direccion" class="form-label">Direccion</label>
    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ciudad calle escalera piso" require>
</div>
<input type="submit" class="btn btn-primary" id="comprafinal" name="comprafinal" onclick="avisoCompra()" value="Comprar"></input>
<button type="button" class="btn btn-danger" id="cancelar" name="cancelar" value="cancelar" onClick="history.go(-2);">Seguir comprando</button>
</form>

</main>
<?php 

if (isset($_REQUEST['comprafinal'])){
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    if($nombre == ''|| $email =='' || $direccion =='' || $total ==0){
        print("Algun campo esta vacio o la compra ya no tiene productos");// print_r
    }else {
        try{
            $con->beginTransaction();
        $sql = $con->prepare("INSERT INTO compra (nombre, email, direccion, total) VALUES(?,?,?,?)");
        $sql -> execute([$nombre, $email, $direccion, $total]);
        $id = $con->lastInsertId();// trae el id que se inserta
        if( $id > 0){
            $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;//tramos la variable de sesion

            if($productos != null){// verificamos que no sea nula
                foreach($productos as $clave => $cantidad){// clave va a ser la id del producto y cantidad la cantidad
                    
            $sql = $con->prepare("SELECT id, nombre, precio, descuento FROM productos WHERE 
            id=? AND activo=1");// cantidad as cantidad solo se esta pasando la cantidad a la consulta y no a la BD
            //PARA QUE LUEGO APAREZCA EN EL RESULTADO
            $sql->execute([$clave]);// EJECUTAMOS LA CONSULTA
            $row_prod = $sql->fetch(PDO::FETCH_ASSOC);//Solo fetch porque vamos a sacar de 1 en uno cada producto

            $precio = $row_prod['precio'];
            $descuento = $row_prod['descuento'];
            $precio_desc = $precio-(($precio * $descuento)/100);

            $sql_insert = $con->prepare("INSERT INTO detalle_compra (id_compra, id_producto, nombre, precio, cantidad)
            VALUES(?,?,?,?,?)");
            $sql_insert->execute([$id, $clave, $row_prod['nombre'], $precio_desc, $cantidad]);
                }
                echo('<h3>Compra finalizada </h3> <br> <h2><a href="trabajo1.php">Volver al inicio</a></h2>');
                unset($_SESSION['carrito']);// despue se elimina lo que esatba en el carrito
                header('location: trabajo1.php');
            }
            
            
        }
        $con->commit();
        }catch(PDOException $exception){
            $con->rollBack();
            echo 'ERROR'. $exception->getMessage();
        }
    }
    //if ($_POST['nombre'] == '' || $_POST['correo'] == '') {
    //    echo "Campos vacios ";
    //}

}
if (isset($_REQUEST['cancelar'])){
    unset($_SESSION['carrito']);
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script><!--Script de boostrap-->
<script>
        function avisoCompra(){
        var correo = document.getElementById("email").value;
        var nombre1 = document.getElementById("nombre").value;
        var direc = document.getElementById("direccion").value;
        if(correo !== ''||nombre1 !== ''||direc !== ''){
            alert('Grascias por su compra'+nombre1);
        }
        
        }
</script>
</body>
=======
<?php
require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();

$total = isset($_GET['total']) ? $_GET['total'] : ''; 
if ($total == 0) {
    echo 'Error al procesar al peticion 1';
    exit;
}
$lista_carrito = array();
//session_destroy(); esta parte la uso para reiniciar las seiones gg

?>
<!DOCTYPE html>
    <html lang="es">
    <head>
        <title>Trabajo final de grado Ivan Caldero Culebras</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../icono/pink.ico" type="imagen/ico" />
        <link rel="stylesheet" href="../CSS/primero.css" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous"><!--Consume menos recursos y es como el css-->
        </head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
crossorigin="anonymous"></script>
<header>

<div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <a href="#" class="navbar-brand">
        <strong>Retro gaming</strong>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    </div>
    </div>
</div>
</header>
<main>
<form method="post" action="finalizar.php?total=<?php echo $total;?>">
<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre" size="20px" placeholder="Jhon" require>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="nadie@gmail.com" require>
</div>
<div class="mb-3">
    <label for="direccion" class="form-label">Direccion</label>
    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ciudad calle escalera piso" require>
</div>
<input type="submit" class="btn btn-primary" id="comprafinal" name="comprafinal" onclick="avisoCompra()" value="Comprar"></input>
<button type="button" class="btn btn-danger" id="cancelar" name="cancelar" value="cancelar" onClick="history.go(-2);">Seguir comprando</button>
</form>

</main>
<?php 

if (isset($_REQUEST['comprafinal'])){
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    if($nombre == ''|| $email =='' || $direccion =='' || $total ==0){
        print_r("Algun campo esta vacio o la compra ya no tiene productos");
    }else {
        try{
            $con->beginTransaction();
        $sql = $con->prepare("INSERT INTO compra (nombre, email, direccion, total) VALUES(?,?,?,?)");
        $sql -> execute([$nombre, $email, $direccion, $total]);
        $id = $con->lastInsertId();// trae el id que se inserta
        if( $id > 0){
            $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;//tramos la variable de sesion

            if($productos != null){// verificamos que no sea nula
                foreach($productos as $clave => $cantidad){// clave va a ser la id del producto y cantidad la cantidad
                    
            $sql = $con->prepare("SELECT id, nombre, precio, descuento FROM productos WHERE 
            id=? AND activo=1");// cantidad as cantidad solo se esta pasando la cantidad a la consulta y no a la BD
            //PARA QUE LUEGO APAREZCA EN EL RESULTADO
            $sql->execute([$clave]);// EJECUTAMOS LA CONSULTA
            $row_prod = $sql->fetch(PDO::FETCH_ASSOC);//Solo fetch porque vamos a sacar de 1 en uno cada producto

            $precio = $row_prod['precio'];
            $descuento = $row_prod['descuento'];
            $precio_desc = $precio-(($precio * $descuento)/100);

            $sql_insert = $con->prepare("INSERT INTO detalle_compra (id_compra, id_producto, nombre, precio, cantidad)
            VALUES(?,?,?,?,?)");
            $sql_insert->execute([$id, $clave, $row_prod['nombre'], $precio_desc, $cantidad]);
                }
                echo('<h3>Compra finalizada </h3> <br> <h2><a href="trabajo1.php">Volver al inicio</a></h2>');
                unset($_SESSION['carrito']);// despue se elimina lo que esatba en el carrito
                header('location: trabajo1.php');
            }
            
            
        }
        $con->commit();
        }catch(PDOException $exception){
            $con->rollBack();
            echo 'ERROR'. $exception->getMessage();
        }
    }
    //if ($_POST['nombre'] == '' || $_POST['correo'] == '') {
    //    echo "Campos vacios ";
    //}

}
if (isset($_REQUEST['cancelar'])){
    unset($_SESSION['carrito']);
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script><!--Script de boostrap-->
<script>
        function avisoCompra(){
        var correo = document.getElementById("email").value;
        var nombre1 = document.getElementById("nombre").value;
        var direc = document.getElementById("direccion").value;
        if(correo !== ''||nombre1 !== ''||direc !== ''){
            alert('Grascias por su compra'+nombre1);
        }
        
        }
</script>
</body>
>>>>>>> aa635ac89f4ca6c2a74ce5a3c47f6b80dcc738d0
</html>