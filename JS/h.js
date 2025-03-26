
var params = window.location.search.substring(1);
var params2 = params.split(/&/);
var cumpleUsu= params2[3].split(/-/);
var diaCumple = cumpleUsu[2];
var mesCumple = cumpleUsu[1];
var fechaCumple= new Date();
var diaActual =fechaCumple.getDate();// DATE PORQUE DAY COGE DEL 1 AL 7
var mesActual =fechaCumple.getMonth() + 1;
var recogerFecha = new Date();// se coje año actual
var anoActual = recogerFecha.getFullYear();

var anoUsuario = params2[3].slice(0, 4);// año usu slice es para cortar 
var diferencia = parseInt(anoActual) - parseInt(anoUsuario);// diferencia de edad
var diferencia2 = parseInt(diaCumple) - parseInt(diaActual);
var diferencia3 = parseInt(mesCumple) - parseInt(mesActual);

document.getElementById("texto").innerHTML +=  "Bienvenido " + params2[0] + " " + params2[1] + " " + params2[2];
function calcularEdad(fecha) {// para calcular mes año dia etc solo para mayor de edad teniedno en cuent mes y dia
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    return edad;
}

if (calcularEdad(params2[3]) >= 18){// se inserta la fecha de usu en la funcion anterior
    alert("BIENVENIDO " + params2[0] + " " + params2[1] + " " + params2[2]);
}else{
    alert("Lo sentimos pero tienes que ser mayor de edad");
    location.href="../php/trabajo1.php"
}

if ((diaCumple==diaActual)&&(mesCumple==mesActual)){
    alert ("Feliz cumpleaños");
    }