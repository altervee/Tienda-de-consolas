
const MAXIMO_TAMANIO_BYTES = 4000000; // 1MB = 1 millón de bytes; 

// Obtener referencia al elemento
const $miInput = document.querySelector("#miInput");

$miInput.addEventListener("change", function () {
	// si no hay archivos, regresamos
	if (this.files.length <= 0) return;

	// Validamos el primer archivo únicamente
	const archivo = this.files[0];
	if (archivo.size > MAXIMO_TAMANIO_BYTES) {
		const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
		alert('El tamaño máximo es 2MB');
		// Limpiar
		$miInput.value = "";
	} else {
		return true;
		// Validación pasada. Envía el formulario o haz lo que tengas que hacer
	}
});

/*function validaEmail() {
	valor = document.getElementById("campo").value;
	if(!(/\w+([-+.’&]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)/.test(valor)) ) {
	return false;
	}
	return true;
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
		}*/
