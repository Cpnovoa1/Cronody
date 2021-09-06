// JavaScript Document
function mostrar(){
	document.getElementById('cuadroconfirmar').style.display = 'flex';
}

function ocultar()
{
	document.getElementById('cuadroconfirmar').style.display = 'none';
}

function mostrarmenu(index)
{
   document.getElementById('elemento'+index).style.display = 'block';
}

function quitarmenu(index)
{
	document.getElementById('elemento'+index).style.display = 'none';
}

let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
	arrow[i].addEventListener("click", (e)=>{
	let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
	arrowParent.classList.toggle("showMenu");
	});
}

let barralat = document.querySelector(".barralat");
let barralatBtn = document.querySelector(".menu");
let barralatBtn2 = document.querySelector(".menu2");
let barralatBtn3 = document.querySelector(".menu3");

console.log(barralatBtn);
barralatBtn.addEventListener("click", ()=>{
	barralat.classList.toggle("close");
});
console.log(barralatBtn2);
barralatBtn2.addEventListener("click", ()=>{
	barralat.classList.toggle("close");
});
console.log(barralatBtn3);
barralatBtn3.addEventListener("click", ()=>{
	barralat.classList.toggle("close");
});

function cerrar_sesion(){
  document.getElementById("idcerrars").setAttribute("href","cerrarsesion.php")
}

function tag_cerrars(){
  var e = document.getElementById("idcerrarses");
  e.style.display = "flex";
  e.style.opacity = "1";
}

function tag_cerrars_out(){
   document.getElementById("idcerrarses").classList.add("cerrarses-out");
}

document.getElementById("idcerrars").addEventListener("click", cerrar_sesion());
//document.getElementById("idsalir1").addEventListener("mouseover", tag_cerrars());
//document.getElementById("idsalir1").addEventListener("mouseout", tag_cerrars_out());