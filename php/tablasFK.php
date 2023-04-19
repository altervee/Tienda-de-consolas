<?php
require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();
$producto = isset($_GET['produc']) ? $_GET['produc'] : ''; // en el caso de que este definido la id lo recopila y si no le da ""
$compra = isset($_GET['com']) ? $_GET['com'] : '';
$sql = $con->prepare("SELECT * FROM compra where id=$compra");
$sql->execute();

$sql2 = $con->prepare("SELECT * FROM productos where id=$producto");
$sql2->execute();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Trabajo final de grado Ivan Caldero Culebras</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icono/pink.ico" type="imagen/ico" />
    <link rel="stylesheet" href="../CSS/primero.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Consume menos recursos y es como el css-->
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <header>

        <div class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <strong>Retro gaming</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-o">
                        <li class="nav-item">
                            <a href="trabajo1.php" class="nav-link active">Catalogo</a>
                        </li>
                        <li class="nav-item">
                            <a href="../HTML/contacto.html" class="nav-link">contacto</a>
                        </li>
                        <li class="nav-item">
                        <a href="tablas.php" class="nav-link">Tablas de la BD</a>
                        </li>
                    </ul>
                    <a href="checkout.php" class="btn btn-primary">
                        Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart;?></span>
        </a>
                </div>
            </div>
        </div>
    </header>
    <br>
    <div class="row g-3 align-items-center">
        <br>
        
    <?php 
    echo('<table class="table table-dark table-striped">');
    echo('<tr><th colspan="5">Tabla compra</th><tr>');
    echo('<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Direccion</th><th>Total</th></tr>');
    foreach($sql as $elementos){
        echo('<tr><td>'.$elementos["id"].'</td><td>'.$elementos["nombre"].
        '</td><td>'.$elementos["email"].'</td><td>'.$elementos["direccion"].
        '</td><td>'.$elementos["total"].'</td></tr>');
    }
    echo('</table><br>');

    echo('<table class="table table-dark table-striped">');
    echo('<tr><th colspan="6">Tabla productos</th><tr>');
    echo('<tr><th>ID</th><th>Nombre</th><th>Descripcion</th><th>Precio</th>
    <th>id_categoria</th><th>Activo</th></tr>');
    foreach($sql2 as $elementos){
        echo('<tr><td>'.$elementos["id"].'</td><td>'.$elementos["nombre"].
        '</td><td>'.$elementos["descripcion"].'</td><td>'.$elementos["precio"].
        '</td><td>'.$elementos["id_categoria"].'</td><td>'.$elementos["activo"].'</td></tr>');
    }
    echo('</table>');
    ?>

    </div>
</body>
</html>