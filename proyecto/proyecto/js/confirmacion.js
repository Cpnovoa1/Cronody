// JavaScript Document
function confirmacion(e){
	if (confirm("¿Está seguro que quiere eliminar el registro?")){
		return true;
	} else {
		e.preventDefault();
	}
}

var elementos = document.querySelectorAll(".tabla-registro-elim");

for(var i=0; i<elementos.length; i++){
	elementos[i].addEventListener('click',confirmacion);
}