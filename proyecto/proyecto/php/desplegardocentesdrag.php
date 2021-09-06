<?php 
$conexion=mysqli_connect('localhost','admin','admin','horarios');
$docente=$_POST['docente']; //SABER DONDE ESTA LA VARIABLE 'DOCENTE'

	$area = "";
    $codigo;
	$materia;

	$sql2="Select * From materias Where MAT_CODIGO = '$docente'";
	$result2=mysqli_query($conexion,$sql2);
	while ($row=mysqli_fetch_row($result2)) {
		$area = $row[3];
		$codigo=$row[0];
		$materia = $row[2];
	}
	
	$sql="Select * From docente Where DOC_CODIGO = 
			Any (Select DOC_CODIGO From materias Where NIV_CODIGO 
			IN (Select NIV_CODIGO From materias Where MAT_CODIGO = '$docente') AND MAT_NOMBRE 
			IN (Select MAT_NOMBRE From materias Where MAT_CODIGO = '$docente') AND MAT_ESTADO=1) AND DOC_ESTADO = 1";

	$result=mysqli_query($conexion,$sql);

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
	
	$arr2 = array("cua","eca","edf","pye","dhi","lli","mat","ccs","ccn","lex","mdi");

	$arr3 = array("fas fa-sticky-note","fas fa-palette","fas fa-running","far fa-lightbulb","fas fa-male",
				  "fas fa-book-open","fas fa-square-root-alt","fas fa-book","fas fa-flask","fas fa-language","fas fa-user-friends");

	$a = array_combine($arr2, $arr1);
	$b = array_combine($arr3, $arr2);

	$tipo = array_search(mb_strtoupper($area), $a);
    $icon =  array_search($tipo, $b);

	if($tipo == ""){ $tipo = "nah";}
	if($icon == ""){ $icon = "fas fa-question";}
	
	$cadena="";

	while ($ver=mysqli_fetch_row($result)) {
		
		$sql3="Select * From materias Where MAT_NOMBRE = '$materia' AND DOC_CODIGO='$ver[0]'";
		$result3=mysqli_query($conexion,$sql3);
		while ($row3=mysqli_fetch_row($result3)) {
			$codigo=$row3[0];
		}
		
		$cadena=$cadena.'<div class="cont-elem '.$tipo.'" idmateria="'.$codigo.'" draggable="true" ondragstart="event.dataTransfer.setData("text/plain",null)" iddocente='.$ver[0].'
						  tipo="'.$tipo.'" icono="'.$icon.'" docente="'.$ver[2].' '.$ver[3].'" materia="'.$materia.'">
		                 
		                 <div class="cont-elem '.$tipo.'">
							<div class="elem-icono"><i class="'.$icon.' fa-2x"></i></div>
							<div class="elem-box">
								<div class="box-docen">'.$ver[2].' '.$ver[3].'</div>
								<div class="box-info">Horas disponibles: '.$ver[8].'</div></div>
							</div>
							</div>
							
						</div>';
	}

	echo  $cadena;

?>