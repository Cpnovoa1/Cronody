<?php

//Verifica si recibio las variables, si no entonces enviara 0 como codigo de error en el envio
if(isset($_GET["anio"]) && isset($_GET["materia"]) && isset($_GET["doc"]) && isset($_GET["sup"]) && isset($_GET["dia"]) && isset($_GET["aula"]) && isset($_GET["horini"])
   && isset($_GET["horfin"])){
	
	include("horario_arreglo.php");
	
	$conn = new mysqli("localhost", "admin", "admin", "horarios");
	if ($conn ->connect_error) {
		die("Connection failed: " . $conn ->connect_error);
	}
	
	$doc = $_GET['doc'];
	$anio = $_GET['anio'];
	$materia = $_GET['materia'];
	$sup = $_GET['sup'];
	$aula = $_GET['aula'];
	$horini = $_GET['horini'];
	$horfin = $_GET['horfin'];
	$dia = $_GET['dia'];
	$horas;
	$mater;	
	
	//Query que valida que el docente tenga horas disponibles
	$sql = "Select COUNT(*) as Registros From docente where DOC_CARGAHORARIA > 0 AND DOC_CODIGO='$doc'";
	$result = mysqli_query( $conn, $sql );
	if($result->num_rows > 0){
		
		//Query que valida si el docente ya da clases en el horario seleccionado
		$repetido = 0;
		$sql4 = "Select * From horarios_materias h, materias m, horarios o where h.MAT_CODIGO = m.MAT_CODIGO and h.HOR_CODIGO = o.HOR_CODIGO and o.HOR_ESTADO = 1";
		$result4 = mysqli_query( $conn, $sql4);
		
		while($row4 = mysqli_fetch_array($result4)){
			if(($horini+':00') == $row4['HMA_HORAINICIO'] && ($horfin+':00') == $row4['HMA_HORAFIN'] && $dia == $row4['DIA_CODIGO'] && $doc == $row4['DOC_CODIGO']){
				$repetido = 1;
			}
		}
		if($repetido == 1){
			echo 4;
		} else {		
			
			//Query para obtener las horas semanales y el nombre de la materia colocada en el horario
			$sql2 = "Select * From materias where MAT_CODIGO='$materia'";
			$result2 = mysqli_query( $conn, $sql2 );

			while($row = mysqli_fetch_array($result2)){
				$horas = $row[4];
				$mater = $row[2];
			}

			session_start();

			$horario = $_SESSION['hor'];
			$_SESSION['supervisor'] = $sup;
			$_SESSION['anio'] = $anio;
			
			//Comprobamos que no hayan más de 2 horas por día de una sola materia
			$cont2 = 1;
			foreach($horario as $hor){	
				$mat = $hor->getMat();
				$sql5 = "Select * From materias where MAT_CODIGO='$mat'";
				$result5 = mysqli_query( $conn, $sql5 );

				while($row5 = mysqli_fetch_array($result5)){
					$mate2 = $row5[2];
				}

				if($mater == $mate2 && $dia == $hor->getDia()){
					$cont2++;
				}
			}
			
			if($cont2 <= 2){
				//Se cuenta que materias tienen el mismo nombre en el arreglo y luego se compara con el num horas disponibles
				$cont = 1;
				foreach($horario as $hor){	
					$mat = $hor->getMat();
					$sql3 = "Select * From materias where MAT_CODIGO='$mat'";
					$result3 = mysqli_query( $conn, $sql3 );

					while($row2 = mysqli_fetch_array($result3)){
						$mate2 = $row2[2];
					}

					if($mater == $mate2){
						$cont++;
					}
				}

				if($cont <= $horas){

					//Funcion para guardar el contenido validado de la casilla en el arreglo general
					$hor = new Horario($doc, $sup, $materia, $horini, $horfin, $anio, $dia, $aula);

					array_push($horario, $hor); 

					$_SESSION['hor'] = $horario;

					echo 1;

				} else {
					echo 3;
				}
			} else {
				echo 5;
			}
			
			
				
		}
			
		
	} else{
		echo 2;
		
	}
	
} else {
	echo 0;
}

?>