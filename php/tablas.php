<?php
require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();
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
                    </ul>
                    <a href="checkout.php" class="btn btn-primary">
                        Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart;?></span>
        </a>
                </div>
            </div>
        </div>
    </header>
    <main>
    
        <form action="tablas.php" method="post">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="elegirTabla" name="elegirTabla">
                <!-- aqui selecionamis la categoria segun el numero -->
                <option value='compra'>Compra</option>
                <option value='detalle_compra'>Detalles compra</option>
                <option value='productos'>Productos</option>
            </select>
            <input type="submit" name="mostrar" value="Mostrar">
        </form>
        <div class="row g-3 align-items-center">
        <?php
        if(isset($_POST["mostrar"])) {
            $selecionTabla = $_POST['elegirTabla'];
            $sql = $con->prepare("SELECT * FROM $selecionTabla");
            $sql->execute();
            if($selecionTabla == 'compra'){
        echo('<table class="table table-dark table-striped">');
        echo('<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Direccion</th><th>Total</th></tr>');
        foreach($sql as $elementos){
            echo('<tr><td>'.$elementos["id"].'</td><td>'.$elementos["nombre"].
            '</td><td>'.$elementos["email"].'</td><td>'.$elementos["direccion"].
            '</td><td>'.$elementos["total"].'</td></tr>');
        }
        echo('</table>');
        }
        if($selecionTabla == 'productos'){
            echo('<table class="table table-dark table-striped">');
            echo('<tr><th>ID</th><th>Nombre</th><th>Descripcion</th><th>Precio</th>
            <th>id_categoria</th><th>Activo</th></tr>');
            foreach($sql as $elementos){
                echo('<tr><td>'.$elementos["id"].'</td><td>'.$elementos["nombre"].
                '</td><td>'.$elementos["descripcion"].'</td><td>'.$elementos["precio"].
                '</td><td>'.$elementos["id_categoria"].'</td><td>'.$elementos["activo"].'</td></tr>');
            }
            echo('</table>');
            }

            if($selecionTabla == 'detalle_compra'){?>
                <table class="table table-dark table-striped">
                <tr><th>ID</th><th>fk id compra</th><th>fk id producto</th><th>nombre</th>
                <th>precio</th><th>cantidad</th><th>Fk</th></tr>
                <?php foreach($sql as $elementos){?>
                    <tr><td><?php echo $elementos["id"]?></td><td><?php echo $elementos["id_compra"] ?>
                    </td><td><?php echo $elementos["id_producto"] ?></td><td><?php echo $elementos["nombre"]?>
                    </td><td><?php echo $elementos["precio"]?></td><td><?php echo $elementos["cantidad"]?>
                    </td>
                    <td><a href="tablasFK.php?produc=<?php echo $elementos['id_producto'];?>&com=<?php echo $elementos['id_compra'];?>" class="btn btn-primary">Mostrar Pk de las fk</a></td></tr>
                <?php } ?>
                </table>
                <?php } ?>
                <?php } ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--Script de boostrap-->
</body>
</html>