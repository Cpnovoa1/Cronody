<?php 
	
	//Se almacenan las areas existentes en el pensum educativo en un array
	$arr1 = array(mb_strtoupper("Currículo Integrador por ámbitos de aprendizaje",'UTF-8'),
				 mb_strtoupper("Educación Cultural y Artística",'UTF-8'),
				 mb_strtoupper("Educación Física",'UTF-8'),
				 mb_strtoupper("Proyectos Escolares",'UTF-8'),
				 mb_strtoupper("Desarrollo Humano Integral",'UTF-8'),
				 mb_strtoupper("Lengua y Literatura",'UTF-8'),
				 mb_strtoupper("Matemática",'UTF-8'),
				 mb_strtoupper("Ciencias Sociales",'UTF-8'),
				 mb_strtoupper("Ciencias Naturales",'UTF-8'),
				 mb_strtoupper("Lengua Extranjera",'UTF-8'),
				 mb_strtoupper("Módulo Interdisciplinar",'UTF-8'));
	
	//Se asignan codigos para diferenciarlas en el css
	$arr2 = array("cua","eca","edf","pye","dhi","lli","mat","ccs","ccn","lex","mdi");

	$arr3 = array("fas fa-sticky-note","fas fa-palette","fas fa-running","far fa-lightbulb","fas fa-male",
				  "fas fa-book-open","fas fa-square-root-alt","fas fa-book","fas fa-flask","fas fa-language","fas fa-user-friends");
	
	//Se combinan los arreglos
	$a = array_combine($arr2, $arr1);
	$b = array_combine($arr3, $arr2);
?>