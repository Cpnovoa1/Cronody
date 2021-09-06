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
		alert("Hubo un error al enviar!");
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

function generarnombreusuario()
{
	var cad = document.getElementById("idnombre").value;
	var cad1 =document.getElementById("idapellido").value;
	var usunombre;
	usunombre=cad[0]+cad[1]+cad1;
	usunombre=usunombre.toLowerCase();
	
	document.getElementById("idnombreusuario").value = usunombre;
	
}

const formulario = document.getElementById('form1');
const inputs = document.querySelectorAll('#form1 input');

const expresiones = {
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,50}$/,
	ltrabajo:/^[a-zA-ZÀ-ÿ0-9\s ]{1,50}$/,
	usuario: /^[a-zA-ZÀ-ÿ0-9]{1,50}$/,
	clave: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/,
	direccion: /^[A-Za-zÀ-ÿ0-9\s.,#\-*/ ]{1,100}$/,
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,10}$/,
	cedula: /^\d{10}$/,
	numero: /^\d{1,2}$/
}

const campos = {
	nombre: true,
	apellido: true,
	cedula: true,
	nombreusuario:true,
	adm_direccion: true,
	adm_telefono: true,
	sup_direccion: true,
	sup_telefono: true,
	doc_direccion: true,
	alu_direccion: true,
	alu_email: true,
	claveusuario:true,
	doc_telefono: true,
	alu_telefono: true
}

function validarRol(){
	switch(document.getElementById("idecivil").value){
		case "Administrador":
			ocultarForm('supervisor','9');
			ocultarForm('docente','8');
			ocultarForm('alumno','10');
			desplegarForm('admin','7');
		break;
		case "Supervisor":
			ocultarForm('admin','7');
			ocultarForm('docente','8');
			ocultarForm('alumno','10');
			desplegarForm('supervisor','9');
		break;
		case "Docente":
			ocultarForm('supervisor','9');
			ocultarForm('admin','6');
			ocultarForm('alumno','10');
			desplegarForm('docente','8');
		break;
		case "Alumno":
			ocultarForm('supervisor','9');
			ocultarForm('docente','7');
			ocultarForm('admin','6');
			desplegarForm('alumno','10');
		break;
		case "":
			ocultarForm('supervisor','9');
			ocultarForm('docente','7');
			ocultarForm('alumno','10');
			ocultarForm('admin','6');
		break;
	}
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "nombre":
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "apellido":
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
		case "nombreusuario":
			validarCampo(expresiones.usuario, e.target, 'nombreusuario');
		break;
		case "claveusuario":
			validarCampo(expresiones.clave, e.target, 'claveusuario');
		break;
		case "adm_telefono":
			validarCampo(expresiones.telefono, e.target, 'adm_telefono');
		break;
		case "doc_telefono":
			validarCampo(expresiones.telefono, e.target, 'doc_telefono');
		break;
		case "sup_telefono":
			validarCampo(expresiones.telefono, e.target, 'sup_telefono');
		break;
		case "alu_telefono":
			validarCampo(expresiones.telefono, e.target, 'alu_telefono');
		break;
		case "sup_direccion":
			validarCampo(expresiones.direccion, e.target, 'sup_direccion');
		break;
		case "doc_direccion":
			validarCampo(expresiones.direccion, e.target, 'doc_direccion');
		break;
		case "alu_direccion":
			validarCampo(expresiones.direccion, e.target, 'alu_direccion');
		break;
		case "adm_direccion":
			validarCampo(expresiones.direccion, e.target, 'adm_direccion');
		break;
		case "alu_email":
			validarCampo(expresiones.email, e.target, 'alu_email');
		break;
		case "m_carga":
			validarCampo(expresiones.numero, e.target, 'adm_telefono');
			break;
	}
}

const desplegarForm = (campo, index) => {
	document.getElementById(`grupo__${campo}`).style.display = "block";
	//habilitarExc(index);
}

const ocultarForm = (campo, index) => {
	document.getElementById(`grupo__${campo}`).style.display = "none";
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
	
	switch(document.getElementById("idecivil").value){
		case "Administrador":
			if(campos.nombre && campos.apellido && campos.cedula && campos.nombreusuario && campos.claveusuario && campos.adm_telefono && campos.adm_direccion){
				formulario.submit();
			} else {
				validarForm();
				alert("Complete los campos correctamente!");
			}
		break;
		case "Supervisor":
			if(campos.nombre && campos.apellido && campos.cedula && campos.nombreusuario && campos.claveusuario && campos.sup_direccion && campos.sup_telefono){
				formulario.submit();
			} else {
				validarForm();
				alert("Complete los campos correctamente!");
			}
		break;
		case "Docente":
			if(campos.nombre && campos.apellido && campos.cedula && campos.nombreusuario && campos.claveusuario && campos.doc_direccion && campos.doc_telefono){
				formulario.submit();
			} else {
				validarForm();
				alert("Complete los campos correctamente!");
			}
		break;
		case "Alumno":
			if(campos.nombre && campos.apellido && campos.cedula && campos.nombreusuario && campos.claveusuario && campos.alu_email && campos.alu_telefono && campos.alu_direccion){
				formulario.submit();
			} else {
				validarForm();
				alert("Complete los campos correctamente!");
			}
		break;
		case "":
			if(campos.nombre && campos.apellido && campos.cedula && campos.nombreusuario && campos.claveusuario){
				formulario.submit();
			} else {
				validarForm();
				alert("Complete los campos correctamente!");
			}
		case "Materia":
			if(campos.nombre && campos.apellido && campos.adm_telefono){
				formulario.submit();
			} else {
				validarForm();
				alert("Complete los campos correctamente!");
			}
		break;
		case "Nivel":
			if(campos.nombre && campos.apellido){
				formulario.submit();
			} else {
				validarForm();
				alert("Complete los campos correctamente!");
			}
			break;
		case "Aula":
			if(campos.nombre && campos.apellido){
				formulario.submit();
			} else {
				validarForm();
				alert("Complete los campos correctamente!");
			}
			break;
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
	
	ocultarForm('supervisor','6');
	ocultarForm('docente','5');
	ocultarForm('alumno','7');
	ocultarForm('admin','3');
	
	inputs.forEach((input) => {
		input.setAttribute("enabled","true");
	});
	
	formulario.reset();
	
});




















