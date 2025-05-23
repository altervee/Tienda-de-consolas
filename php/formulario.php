
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
                <a href="#" class="nav-link active">Catalogo</a>
            </li>
            <li class="nav-item">
                <a href="../HTML/contacto.html" class="nav-link">contacto</a>
            </li>
            <li class="nav-item">
                <a href="tablas.php" class="nav-link">Tablas de la BD</a>
            </li>
            <li class="nav-item">
                <a href="formulario.php" class="nav-link">Formulario</a>
            </li>
        </ul>
    </div>
    </div>
</div>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script><!--Script de boostrap-->
    <script>// la misma funcion que details con el mismo resultatdo
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
            <form method="POST" id="form">
                <fieldset>
                <legend>Formulario</legend>
                <table>
                <tr><td> <input type="text" name="nom" id="nombre" placeholder="Escribe tu nombre" maxlength="20" size="20" value=""  required pattern="[A-Za-z]+" title="Ej:Paco"></td></tr>
                    <tr><td> <input type="text" name="apell1" id="apell" placeholder="Primer apellido" maxlength="20" size="20" required pattern="[A-Za-z]+" title="Ej:Garcia"></td></tr>
                    <tr><td> <input type="text" name="appell2" id="apellido" placeholder="Segundo apellido" maxlength="20" size="20" required pattern="[A-Za-z]+" title="Ej:Perez"></td></tr>
                    <tr><td> <input type="text" name="gmail" id="gmail" placeholder="correo" size="20" required  title="yo@gmail.com"></td></tr>
                    <tr><td> <input type="text" name="dni" id="dni" placeholder="DNI" maxlength="9" size="20" required title="Ej:123456M"></td></tr>
                    <tr><td> <input type="date" name="fecha" id="fecha" size="20" min="1900-12-31" max="2021-12-31" value="" required></td></tr>
                </table>
                <p>Sexo:<br>
                    <input type="radio" id="hombre" name="sexo" value="hombre"> Hombre<br><!--Se pone el mismo name para que solo se escoja una-->
                    <input type="radio" id="mujer" name="sexo" value="mujer"> Mujer<br>
                    <input type="radio" id="otro" name="sexo" value="otro"> Otro
                <div class="botones">
                    Incluir mi foto: <input type="file" id="miInput" size=""  accept="image/*" required> <br/>
                    <script src="../JS/script.js"></script>
                    <input name="publ" type="checkbox" value="publicidad" checked="checked" required/>
                    Enviar publicidad
                    <input type="submit" value="Enviar" name="enviar" title="Te envia a una pagiana especifica de tu sexo seleccionado"  onclick="reenviar()" />
                    <input type="reset" value="Limpiar" />
                    
                    Aceptar uso de cookies <input type="checkbox" id="checkbox1" size=""   required> <br/>
                    
                    
                </div>
                </fieldset>
                <input type="button" value="Cambiar de usuario" onclick="cambiardeUsuario()">
            </form>
            </div>
    </div>
    </div>
    <div class="pie"><div><a href="../HTML/declaracionAcc.html">Declaración de accesibilidad</a></div><div class="mov"><img class="imgAcc" alt="" src="../imagenes/w3c.png" ></div></div>
    
</div>
</body>
<script> 
verificarCookies();
function validaNombre(){//cpmprobación del que el nombre sean letras
    nombre = document.getElementById("nombre").value;
    var patron = /\d/;
if (!patron.test(nombre)){
    return true;
}else{

alert('El nombre debe ser en letras');
return false;
}   
}
function validaApell(){
    apell = document.getElementById("apell").value;
    var patron = /\d/;
if (!patron.test(apell)){
    return true;
}else{

alert('El apellido debe ser en letras');
return false;
}   
}
function validaApellido(){
    apellido = document.getElementById("apellido").value;
    var patron = /\d/;
if (!patron.test(apellido)){
    return true;
}else{

alert('El apellido debe ser en letras');
return false;
}   
}

function validaDNI(){
		valor = document.getElementById("dni").value;
		var letras = ['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E','T'];
		if( !(/^\d{8}[A-Z]$/.test(valor)) ) {
		return false;
		}
		if(valor.charAt(8) != letras[(valor.substring(0, 8))%23]) {
		alert("Ha introducido mal el dni");
		return false;
		}
		
		return true;
		}
        function validarEmail() {
            valor = document.getElementById("gmail").value;
            if(!(/^\w+([@]{1}\w+[.]{1})[com|es]+$/.test(valor)) ) {
                alert("El correo electronico no cumple el formato");
return false;
}
return true;

}

        
        
    function setCookies(doni,nombre1,apells1,apellidos1,fechas,correo,sexo){
            var checkbox = document.getElementById('checkbox1');

        if(checkbox.checked==true){
            document.cookie= "dni ="+ doni +";expires=31 Dec 2030 23:59:2059";
            document.cookie= "nombre ="+ nombre +";expires=31 Dec 2030 23:59:2059";
            document.cookie= "apell ="+ apell +";expires=31 Dec 2030 23:59:2059";
            document.cookie= "apellido ="+ apellido +";expires=31 Dec 2030 23:59:2059";
            document.cookie= "fecha ="+ fechas +";expires=31 Dec 2030 23:59:2059";
            document.cookie= "gmails ="+ correo +";expires=31 Dec 2030 23:59:2059";
            var userx = getCookie("nombre");
            alert(userx);
            
            }else{
        localStorage.setItem("dni", doni);
        localStorage.setItem("nombre", nombre);
        localStorage.setItem("apell", apell);
        localStorage.setItem("apellido", apellido);
        localStorage.setItem("gmails", correo);
        localStorage.setItem("fecha", fechas);

}
        }
        function getCookie(nombre) {
let name = nombre + "=";
let Cookiedecodificada = decodeURIComponent(document.cookie);
let cookieArray = Cookiedecodificada.split(';');
for(let i = 0; i < cookieArray.length; i++) {
let miCookie = cookieArray[i];
while (miCookie.charAt(0) == ' ') {
miCookie = miCookie.substring(1);
}
if (miCookie.indexOf(name) == 0) {
return miCookie.substring(name.length, miCookie.length);
}
}
return "";
}



function verificarCookies() {
document.getElementById("nombre").value = getCookie("nombre");
document.getElementById("apell").value = getCookie("apell");
document.getElementById("apellido").value = getCookie("apellido");
document.getElementById("dni").value = getCookie("dni");
document.getElementById("fecha").value = getCookie("fecha");
document.getElementById("gmail").value = getCookie("gmails");

var user = getCookie("nombre");
var user2 = getCookie("apell");
var user3 = getCookie("apellido");
var user4 = getCookie("fecha");
var user5 = getCookie("gmails");

if (user != "") {
alert("Bienvenido de nuevo " + user );
} else {
    
}
}
        
    function cambiardeUsuario(){
            localStorage.clear();
            document.cookie = "dni=doni;expires=1 Mar 1990 00:00:00 GMT";
            document.cookie = "nombre=nombre;expires=1 Mar 1990 00:00:00 GMT";
            document.cookie = "apell=apell;expires=1 Mar 1990 00:00:00 GMT";
            document.cookie = "apellido=apellido;expires=1 Mar 1990 00:00:00 GMT";
            document.cookie = "gmails=correo;expires=1 Mar 1990 00:00:00 GMT";
            document.cookie = "fecha=fechas;expires=1 Mar 1990 00:00:00 GMT";
        }
    function reenviar() {
        var doni = document.getElementById("dni").value;
        var nombre1 = document.getElementById("nombre").value;//cojemos los elemntos para sumarlos despues
        var apells1 = document.getElementById("apell").value;
        var apellidos1 = document.getElementById("apellido").value;
        var correo = document.getElementById("gmail").value;
        var fechas = document.getElementById("fecha").value;
        var sexo = document.getElementsByName("sexo");
        var patron1 = new RegExp('[a-zA-Z]');
        var patron2 = new RegExp('^[0-9]{8}[A-Z]{1}$');

        if (!validaDNI()||nombre1.length<1||apells1.length<1||apellidos1.length<1||correo.length<1||!validaNombre()||!validaApell()||!validaApellido()||!validarEmail()||fechas.length<1||sexo==null){
        alert("Algun campo esta es erroneo");
        }
        else{
            setCookies(doni,nombre1,apells1,apellidos1,fechas,correo,sexo);
        for(var i = 0; i < sexo.length; i++) {// para recoja el sexo de manera corecta
            if(sexo[i].checked) {
                location.href= "../HTML/"+sexo[i].value +".html?" + nombre1 + "&" + apells1  + "&" +  apellidos1 + "&" + fechas;
            }
        }
        
    }
    
    }
</script>
</html>