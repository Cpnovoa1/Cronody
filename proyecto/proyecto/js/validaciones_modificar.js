// JavaScript Document

function habilitar(index) {
	var x = document.forms["form1"];
	index = parseInt(index);
	if (x.elements[index-1].value != "") {
		x.elements[index].disabled = false;
	}
}

function deshabilitar(index) {
	var x = document.forms["form1"];
	index = parseInt(index);
	x.elements[index].disabled = true;
}

function habilitarExc(index) {
	var x = document.forms["form1"];
	index = parseInt(index);
	x.elements[index].disabled = false;
}

function validarForm() {
	var x = document.forms["form1"];
	var flag = true;
	var texto = "";
	for(let i=0; i<x.length; i++){
		texto += x.elements[i].value + "<br>";
		if (x.elements[i].value == "") {
			flag = false;
		} 
	}	
	if(flag == false) {
		alert("Debe completar todos los campos!");
	} 
}

var fecha = fechaActual();
document.getElementById("idfnacimiento").setAttribute("max", fecha);

function fechaActual(){
	const hoy = new Date();
	return formatoFecha(hoy, 'yyyy-mm-dd');
}

function formatoFecha(fecha, formato) {
	const map = {
        dd: fecha.getDate(),
        mm: fecha.getMonth() + 1,
        yy: fecha.getFullYear().toString().slice(-2),
        yyyy: fecha.getFullYear()
    }
	if(map.mm <= 9){
		map.mm = "0" + map.mm;
	}
	if(map.dd <= 9){
		map.dd = "0" + map.dd;
	}

    return formato.replace(/yyyy|mm|yy|dd/gi, matched => map[matched])
}

function validarCedula() {
	var cad = document.getElementById("idcedula").value.trim();
	var total = 0;
	var longitud = cad.length;
	var longcheck = longitud - 1;

	if (cad !== "" && longitud === 10){
	  for(var i = 0; i < longcheck; i++){
		if (i%2 === 0) {
		  var aux = cad.charAt(i) * 2;
		  if (aux > 9) aux -= 9;
		  total += aux;
		} else {
		  total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
		}
	  }

	  total = total % 10 ? 10 - total % 10 : 0;

	  if (cad.charAt(longitud-1) == total) {
		  	document.getElementById(`grupo__cedula`).classList.remove('formulario__grupo-incorrecto');
			document.getElementById(`grupo__cedula`).classList.add('formulario__grupo-correcto');
			document.querySelector(`#grupo__cedula i`).classList.add('fa-check-circle');
			document.querySelector(`#grupo__cedula i`).classList.remove('fa-times-circle');
			document.querySelector(`#grupo__cedula .formulario__input-error`).classList.remove('formulario__input-error-activo');
		  return true;

	  }else{
			document.getElementById(`grupo__cedula`).classList.add('formulario__grupo-incorrecto');
			document.getElementById(`grupo__cedula`).classList.remove('formulario__grupo-correcto');
			document.querySelector(`#grupo__cedula i`).classList.add('fa-times-circle');
			document.querySelector(`#grupo__cedula i`).classList.remove('fa-check-circle');
			document.querySelector(`#grupo__cedula .formulario__input-error`).classList.add('formulario__input-error-activo');
		  return false;
	  }
	}
}

const formulario = document.getElementById('form1');
const inputs = document.querySelectorAll('#form1 input');

const expresiones = {
	user: /^[a-zA-ZÀ-ÿ0-9-_]{1,20}$/,
	clave: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/,
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,50}$/,
	ltrabajo:/^[a-zA-ZÀ-ÿ0-9\s ]{1,50}$/,
	paralelo: /^[A-Z]{1}$/,
	direccion: /^[A-Za-zÀ-ÿ0-9\s.,#\-*/ ]{1,100}$/,
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,10}$/,
	hora: /^\d{1,2}$/,
	cedula: /^\d{10}$/
}

const campos = {
	nombre: true,
	apellido: true,
	cedula: true,
	user: true,
	clave: true,
	curso: true,
	paralelo: true,
	direccion: true,
	ltrabajo: true,
	email: true,
	telefono: true,
	materia: true,
	horas: true
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "nombre":
			campos.nombre = false;
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "apellido":
			campos.apellido = false;
			validarCampo(expresiones.nombre, e.target, 'apellido');
		break;
		case "cedula":
			validarCampo(expresiones.cedula, e.target, 'cedula');
			if(validarCedula()){
				campos.cedula = true;
			} else {
				campos.cedula = false;
			}
		break;
		case "user":
			campos.usuario = false;
			validarCampo(expresiones.user, e.target, 'user');
			break;
		case "telefono":
			campos.telefono = false;
			validarCampo(expresiones.telefono, e.target, 'telefono');
		break;
		case "fnacimiento":
		break;
		case "direccion":
			campos.direccion = false;
			validarCampo(expresiones.direccion, e.target, 'direccion');
		break;
		case "ltrabajo":
			campos.ltrabajo = false;
			validarCampo(expresiones.ltrabajo, e.target, 'ltrabajo');
		break;
		case "email":
			campos.email = false;
			validarCampo(expresiones.email, e.target, 'email');
		break;
		case "clave":
			campos.clave = false;
			validarCampo(expresiones.clave, e.target, 'clave');
		break;
		case "curso":
			campos.curso = false;
			validarCampo(expresiones.ltrabajo, e.target, 'curso');
		break;
		case "paralelo":
			campos.paralelo = false;
			validarCampo(expresiones.paralelo, e.target, 'paralelo');
		break;
		case "materia":
			campos.materia = false;
			validarCampo(expresiones.nombre, e.target, 'materia');
		break;
		case "horas":
			campos.horas = false;
			validarCampo(expresiones.hora, e.target, 'horas');
		break;
	}
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
	e.preventDefault();

	if(campos.nombre && campos.apellido && campos.cedula && campos.telefono && campos.direccion && campos.ltrabajo 
	   && campos.email && campos.user && campos.clave && campos.curso && campos.paralelo && campos.materia && campos.horas ){
		
		formulario.submit();
		
	} else {
		validarForm();
		alert("Complete los campos correctamente!");
	}
});

formulario.addEventListener('reset', (e) => {
	
	document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
		icono.classList.remove('formulario__grupo-correcto');
	});
	
	document.querySelectorAll('.formulario__grupo-incorrecto').forEach((icono) => {
		icono.classList.remove('formulario__grupo-incorrecto');
	});
	
	document.querySelectorAll('.formulario__input-error-activo').forEach((icono) => {
		icono.classList.remove('formulario__input-error-activo');
	});
	
	formulario.reset();
	
});




















