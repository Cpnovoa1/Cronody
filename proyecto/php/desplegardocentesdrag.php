<?php 
$conexion=mysqli_connect('localhost','admin','admin','horarios');
$docente=$_POST['docente'];

	$area = "";
	$sql2="Select * From materias Where MAT_CODIGO = '$docente'";
	$result2=mysqli_query($conexion,$sql2);
	while ($row=mysqli_fetch_row($result2)) {
		$area = $row[3];
	}
	
	$sql="Select * From docente Where DOC_CODIGO = 
			Any (Select DOC_CODIGO From materias Where NIV_CODIGO 
			IN (Select NIV_CODIGO From materias Where MAT_CODIGO = '$docente') AND MAT_NOMBRE 
			IN (Select MAT_NOMBRE From materias Where MAT_CODIGO = '$docente')) AND DOC_ESTADO = 1";

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
		$cadena=$cadena.'<div class="cont-elem '.$tipo.'" draggable="true" id="docente['.$ver[0].']">
							<div class="elem-icono"><i class="'.$icon.' fa-2x"></i></div>
							<div class="elem-box">
								<div class="box-docen">'.$ver[2].' '.$ver[3].'</div>
								<div class="box-info">Horas disponibles: '.$ver[8].'</div>
							</div>
						</div>';
	}

	echo  $cadena;

		/*$area = "";
		$sql2="Select MAT_AREA From materias Where MAT_CODIGO = '$docente'";
		$result2=mysqli_query($conexion,$sql2);
		
		while ($row=mysqli_fetch_row($result2)) {
			switch($row["MAT_AREA"]){
				case "Currículo Integrador por ámbitos de aprendizaje":
					$area = "cua";
					break;
				case "Educación Cultural y Artística":
					$area = "eca";
					break;
				case "Educación Física":
					$area = "edf";
					break;
				case "Proyectos Escolares":
					$area = "pye";
					break;
				case "Desarrollo Humano Integral":
					$area = "dhi";
					break;
				case "Lengua y Literatura":
					$area = "lli";
					break;
				case "Matemática":
					$area = "mat";
					break;
				case "Ciencias Sociales":
					$area = "ccs";
					break;
				case "Ciencias Naturales":
					$area = "ccn";
					break;
				case "Lengua Extranjera":
					$area = "lex";
					break;
				case "Módulo Interdisciplinar":
					$area = "mdi";
					break;
				default:
					$area = "nah";
					break;
			}
		}*/

?>