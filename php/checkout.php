<?php
require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();


$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;// en caso de que exista la recibiremos si no se le da el valor null


$lista_carrito = array();
if($productos != null){
    foreach($productos as $clave => $cantidad){// clave va a ser la id del producto y cantidad la cantidad
        
$sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos WHERE 
id=? AND activo=1");// cantidad as cantidad solo se esta pasando la cantidad a la consulta y no a la BD
//PARA QUE LUEGO APAREZCA EN EL RESULTADO
$sql->execute([$clave]);// EJECUTAMOS LA CONSULTA
$lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);//Solo fetch porque vamos a sacar de 1 en uno cada producto
    }
}

//session_destroy(); esta parte la uso para reiniciar las seiones gg
//print_r($_SESSION); //aqui puedo visualizar los elementos guardados en el carrito mediante un array
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
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Productos</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if($lista_carrito == null){
                    echo '<tr><td colspan="5" class="text-center">Sin productos</td></tr>'; // en caso de que no exita registro de producto imprme lo siguiente
                }else{
                    $total = 0;
                    foreach($lista_carrito as $producto){
                        $_id = $producto['id'];
                        $nombre = $producto['nombre'];
                        $precio = $producto['precio'];
                        $cantidad = $producto['cantidad'];
                        $descuento = $producto['descuento'];
                        $precio_desc = $precio-(($precio * $descuento)/100);
                        $subtotal = $cantidad * $precio_desc;
                        $total += $subtotal; 
                        
                    ?>
                <tr>
                    <td><?php echo $nombre; ?></td>
                    <td><?php echo number_format($precio_desc,2, '.',',') . MONEDA; ?></td>
                    <td>
                        <input type="number" min="1" max="10" value="<?php echo $cantidad?>" size="7"
                        id="cantidad_<?php echo $_id;?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)" onclick="recargar()">
                    </td>
                    <td>
                        <div id="subtotal_<?php echo $_id;?>" name="subtotal[]">
                        <?php echo number_format($subtotal,2, '.',',') . MONEDA; ?>
                    </div>
                    </td>
                    <td><!--De aqui se recopila la id para luego eliminar el producto-->
                        <a id="eliminar" class="btn btn-warning btn-sm"
                        data-bs-id="<?php echo $_id;?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
                    </td>
                </tr>
                <?php }?>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="2">
                        <p class="h3" id="total"><?php echo number_format($total,2, '.',',') . MONEDA; ?></p>
                    </td>
                </tr>
                <?php }?>
            </tbody>
            
        </table>
    </div>
    <div class="col-md-5 offset-md-7 d-grid gap-2">
        <div class="btn-group" onclick="recargar()" > <a href="finalizar.php?total=<?php echo $total;?>" class="btn btn-primary">Finalizar compra</a></div>
    </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="eliminaModalLabel">Alerta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        ¿Desa quitar el producto del carrito?
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar </button>
        <button id="btn-elimina"  type="button" class="btn btn-danger" onclick="eliminar()">Eliminar </button>
    </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script><!--Script de boostrap-->


    <script>// la misma funcion que details con el mismo resultatdo
    let eliminaModal = document.getElementById('eliminaModal')
    eliminaModal.addEventListener('show.bs.modal', function(event){
        let button = event.relatedTarget// trae los datos de eliminar
        let id = button.getAttribute('data-bs-id')
        let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')// se busca el modal recopilandlo por el elemto
        buttonElimina.value = id
    })




        function actualizaCantidad(cantidad, id){
            let url = 'actualizar_carrito.php'
            let formData = new FormData()//facilita recopilar datos mediante post
            formData.append('action', 'agregar')
            formData.append('id', id)
            formData.append('cantidad', cantidad)

            fetch(url, {// aqui ya lo enviamos por post
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
            .then(data => {
                if(data.ok){//con data. se accede a los elemtos enviados
                    let divsubtotal = document.getElementById('subtotal_' + id)
                    divsubtotal.innerHTML = data.sub
                    //respuesta a la peticion  de actualizar_carritp
                    let total = 0.00
                    let list = document.getElementsByName('subtotal[]')
                    for(let i = 0; i < list.length; i++){
                        total += parseFloat(list[i].innerHTML.replace(/[€,]/g, ''))// se quitan los simbolos y comas, porque generan problemas
                        
                    }
                    total = new Intl.NumberFormat('en-US', {// LE PONGO EL FORMATO amricano para que me coincidan los . y ,
                        minimumFractionDigits: 2
                    }).format(total) 
                    document.getElementById('total').innerHTML =  total +'<?php echo MONEDA; ?>'
                    
                }
            })
        }
        function eliminar(){
            let botonElimina = document.getElementById('btn-elimina')
            let id = botonElimina.value

            let url = 'actualizar_carrito.php'
            let formData = new FormData()//facilita recopilar datos mediante post
            formData.append('action', 'eliminar')
            formData.append('id', id)


            fetch(url, {// aqui ya lo enviamos por post
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
            .then(data => {
                if(data.ok){//con data. se accede a los elemtos enviados
                    location.reload()
                }
            })

        }
        function recargar(){
            location.reload()
        }
    </script>

</body>
</html>