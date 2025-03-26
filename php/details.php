<<<<<<< HEAD
<?php
require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();
$id = isset($_GET['id']) ? $_GET['id'] : ''; // en el caso de que este definido la id lo recopila y si no le da ""
$token = isset($_GET['token']) ? $_GET['token'] : '';
if ($id == '' || $token == '') {
    echo 'Error al procesar al peticion 1';
    exit;
} else {
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN); //vueleve a hacer el procesamiento del token
    if ($token == $token_tmp) {
        $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1"); // LO DE ACTIVO SIRVE PARA QUITAR PRODUCTOS PONIEND EN LA BD SI CAMBIAMOS DE VALOR NO LOS MOSTRARÁ
        $sql->execute([$id]);
        if ($sql->fetchColumn() > 0) { //si encuentra un dato
            $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1"); // LO DE ACTIVO SIRVE PARA QUITAR PRODUCTOS PONIEND EN LA BD SI CAMBIAMOS DE VALOR NO LOS MOSTRARÁ
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);// se asigna en un asociativo
            $nombre = $row['nombre'];// guardamos los datos en distintos arrays 
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $descuento = $row['descuento'];
            $precio_desc = $precio - (($precio * $descuento) / 100);// si queremos meter en la bd descuentos lo actualizará
            $dir_img = '../img/productos/' . $id . '/'; //ruta para sacar img 
            $rutaImg = $dir_img . 'principal.jpg';
            if (!file_exists($rutaImg)) {
                $rutaImg = '../img/no-photo'; //en el caso de que la img este mal o no exista pondrá una predeterminada

            }
            $imagenes = array();
            if(file_exists($dir_img)){
            $dir = dir($dir_img);
            while (($archivo = $dir->read()) != false) {
                if ($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) { //buscar los archivos jpg y jpge diferentes a principal
                    $imagenes[] = $dir_img . $archivo;
                }
            }
            $dir->close();
        
        }
    }
    } else {
        echo 'Error al procesar al peticion 2';
        exit;
    }
} //este ultimo condicional facilita que noo se puedan editar la id o token para mayor seguridad

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Practica Ivan Caldero Culebras</title>
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
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-1">
                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?php echo $rutaImg ?>" class="d-block w-100">
                            </div>
                            <?php foreach($imagenes as $img){?>
                            <div class="carousel-item">
                            <img src="<?php echo $img ?>" class="d-block w-100">
                            </div>
                            <?php }?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 order-md-2">
                    <h2><?php echo $nombre; ?></h2>

                    <?php if($descuento > 0) {?>
                    <h2><del><?php echo MONEDA . number_format($precio, 2, '.', ','); //simple para ordenar en 1000.. 
                        ?></del></h2>
                        <h2><?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?>
                    <small class="text-success"><?php echo $descuento; ?> % descuento</small>
                    </h2>
                    <?php }else{?>
                        <h2><?php echo MONEDA . number_format($precio, 2, '.', ','); //simple para ordenar en 1000.. 
                        ?></h2>
                        <?php }?>
                    <p class="lead">
                        <?php echo $descripcion; ?>
                    </p>
                    <div class="d-grid gap-3 col-10 mx-auto">
                        <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $id;?>, '<?php echo $token_tmp;?>')">Agregar al carrito</button>
                    </div><!--Enviamos el id y el token generado mendiante javaScript-->
                </div>

            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script><!--Script de boostrap-->
    <script>
        function addProducto(id, token){
            let url = 'carrito.php'
            let formData = new FormData()//facilita recopilar datos mediante post
            formData.append('id', id)
            formData.append('token', token)//hasta aquí es la conf de la peticion por ajax
            fetch(url, {// aqui ya lo enviamos por post
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
            .then(data => {
                if(data.ok){//con data. se accede a los elemtos enviados
                    let elemento = document.getElementById("num_cart")
                    elemento.innerHTML = data.numero
                }
            })

        }
    </script>
    <div class="contenedor">

        <div class="megacu">
            <div class="rectangulo">
                <div class="lista">
                    <ul>
                        <li type="none"></li>
                        <li type="none"></li>
                        <li type="none"></li>
                    </ul>

                </div>
            </div>
            <div class="cuadrado">
            </div>
        </div>
        <div class="pie">
            <div><a href="declaracionAcc.html">Declaración de accesibilidad</a></div>
            <div class="mov"><img class="imgAcc" alt="" src="../imagenes/w3c.png"></div>
        </div>

    </div>
</body>

=======
<?php
require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();
$id = isset($_GET['id']) ? $_GET['id'] : ''; // en el caso de que este definido la id lo recopila y si no le da ""
$token = isset($_GET['token']) ? $_GET['token'] : '';
if ($id == '' || $token == '') {
    echo 'Error al procesar al peticion 1';
    exit;
} else {
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN); //vueleve a hacer el procesamiento del token
    if ($token == $token_tmp) {
        $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1"); // LO DE ACTIVO SIRVE PARA QUITAR PRODUCTOS PONIEND EN LA BD SI CAMBIAMOS DE VALOR NO LOS MOSTRARÁ
        $sql->execute([$id]);
        if ($sql->fetchColumn() > 0) { //si encuentra un dato
            $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1"); // LO DE ACTIVO SIRVE PARA QUITAR PRODUCTOS PONIEND EN LA BD SI CAMBIAMOS DE VALOR NO LOS MOSTRARÁ
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);// se asigna en un asociativo
            $nombre = $row['nombre'];// guardamos los datos en distintos arrays 
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $descuento = $row['descuento'];
            $precio_desc = $precio - (($precio * $descuento) / 100);// si queremos meter en la bd descuentos lo actualizará
            $dir_img = '../img/productos/' . $id . '/'; //ruta para sacar img 
            $rutaImg = $dir_img . 'principal.jpg';
            if (!file_exists($rutaImg)) {
                $rutaImg = '../img/no-photo'; //en el caso de que la img este mal o no exista pondrá una predeterminada

            }
            $imagenes = array();
            if(file_exists($dir_img)){
            $dir = dir($dir_img);
            while (($archivo = $dir->read()) != false) {
                if ($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) { //buscar los archivos jpg y jpge diferentes a principal
                    $imagenes[] = $dir_img . $archivo;
                }
            }
            $dir->close();
        
        }
    }
    } else {
        echo 'Error al procesar al peticion 2';
        exit;
    }
} //este ultimo condicional facilita que noo se puedan editar la id o token para mayor seguridad

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Practica Ivan Caldero Culebras</title>
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
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-1">
                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?php echo $rutaImg ?>" class="d-block w-100">
                            </div>
                            <?php foreach($imagenes as $img){?>
                            <div class="carousel-item">
                            <img src="<?php echo $img ?>" class="d-block w-100">
                            </div>
                            <?php }?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 order-md-2">
                    <h2><?php echo $nombre; ?></h2>

                    <?php if($descuento > 0) {?>
                    <h2><del><?php echo MONEDA . number_format($precio, 2, '.', ','); //simple para ordenar en 1000.. 
                        ?></del></h2>
                        <h2><?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?>
                    <small class="text-success"><?php echo $descuento; ?> % descuento</small>
                    </h2>
                    <?php }else{?>
                        <h2><?php echo MONEDA . number_format($precio, 2, '.', ','); //simple para ordenar en 1000.. 
                        ?></h2>
                        <?php }?>
                    <p class="lead">
                        <?php echo $descripcion; ?>
                    </p>
                    <div class="d-grid gap-3 col-10 mx-auto">
                        <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $id;?>, '<?php echo $token_tmp;?>')">Agregar al carrito</button>
                    </div><!--Enviamos el id y el token generado mendiante javaScript-->
                </div>

            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script><!--Script de boostrap-->
    <script>
        function addProducto(id, token){
            let url = 'carrito.php'
            let formData = new FormData()//facilita recopilar datos mediante post
            formData.append('id', id)
            formData.append('token', token)//hasta aquí es la conf de la peticion por ajax
            fetch(url, {// aqui ya lo enviamos por post
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
            .then(data => {
                if(data.ok){//con data. se accede a los elemtos enviados
                    let elemento = document.getElementById("num_cart")
                    elemento.innerHTML = data.numero
                }
            })

        }
    </script>
    <div class="contenedor">

        <div class="megacu">
            <div class="rectangulo">
                <div class="lista">
                    <ul>
                        <li type="none"></li>
                        <li type="none"></li>
                        <li type="none"></li>
                    </ul>

                </div>
            </div>
            <div class="cuadrado">
            </div>
        </div>
        <div class="pie">
            <div><a href="declaracionAcc.html">Declaración de accesibilidad</a></div>
            <div class="mov"><img class="imgAcc" alt="" src="../imagenes/w3c.png"></div>
        </div>

    </div>
</body>

>>>>>>> aa635ac89f4ca6c2a74ce5a3c47f6b80dcc738d0
</html>