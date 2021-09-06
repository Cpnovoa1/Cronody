<?php
$conn = new mysqli("localhost", "admin", "admin", "horarios");
if ($conn ->connect_error) {
	die("Connection failed: " . $conn ->connect_error);
}

//Incluye al php que tiene la clase para obtener las funciones
include("horario_arreglo.php");

session_start();
$horario = $_SESSION['hor'];
$supervisor = $_SESSION['supervisor'];
$anioL = $_SESSION['anio'];
$codigoh;
//Crea un nuevo horario
$query = "INSERT INTO horarios (SUP_CODIGO, HOR_ALECTIVO) VALUES ('$supervisor','$anioL')";
$resultado = mysqli_query($conn,$query);
if($resultado){
	
	//Obtengo el codigo del horario creado
	$query_h = "Select * from horarios";
	$resultado_h = mysqli_query($conn,$query_h);
	while($row = mysqli_fetch_array($resultado_h)){
		$codigoh = $row[0];
	}
	
	$contador = 0;
	
	if($resultado_h){
		//Loop para recorrer el arreglo que contiene los datos del horario
		foreach($horario as $hor){
			
			$mat=$hor->getMat();
			$dia= $hor->getDia();
			$hi= $hor->getHoraIni();
			$hf= $hor->getHoraFin();
			$aula = $hor->getAula();
			
			//Guardamos los registros en la tabla
			$query_hm = "INSERT INTO horarios_materias (HOR_CODIGO, MAT_CODIGO, DIA_CODIGO, HMA_HORAINICIO, HMA_HORAFIN) VALUES ('$codigoh','$mat', '$dia', '$hi', '$hf')";
			$resultado_hm = mysqli_query($conn,$query_hm);	
			
			$aux = "SELECT `DOC_CODIGO` FROM `materias` WHERE `MAT_CODIGO`= $mat ";											//
			$resultado1 = mysqli_query($conn,$aux);																					//
			$arrayDatos = array();																									//
			$valor = 0;																												//
			 while($row = mysqli_fetch_array($resultado1)){																			//
				$arrayDatos[] = $row;																								//
			 }
			//print_r ($arrayDatos[0]);
			for($i=0; $i==0; $i++)																									//
			 {
			  //saco el valor de cada elemento
			  $valor = $arrayDatos[$i];																								//

			 }																														//
			echo 'CODIGO DEL DOCENTE: ' +$valor[0];


			$aux2 = "SELECT `DOC_CARGAHORARIA` FROM `docente` WHERE `DOC_CODIGO`= $valor[0]";									    //
			$resultado2 = mysqli_query($conn,$aux2);																				//
			$arrayDatos2 = array();																									//
			$valor2 = 0;
			 while($row2 = mysqli_fetch_array($resultado2)){																		//
				$arrayDatos2[] = $row2;
			 }
			for($j=0; $j==0; $j++)																									//
			 {
			  //saco el valor de cada elemento
			  $valor2 = $arrayDatos2[$j];																							//

			 }
			echo $valor2[0];

			$nuevas_horas = $valor2[0] - 1;																					//


			$reducirHoras = "UPDATE `docente` SET `DOC_CARGAHORARIA`= $nuevas_horas WHERE `DOC_CODIGO` = $valor[0]";				//
			$resultado3 = mysqli_query($conn,$reducirHoras);
			
			
			/*echo "<p>Docente: ".$hor->getDoc()."</p>";
			echo "<p>Supervisor: ".$hor->getSup()."</p>";
			echo "<p>Materia: ".$hor->getMat()."</p>";
			echo "<p>Aula: ".$hor->getAula()."</p>";
			echo "<p>Dia: ".$hor->getDia()."</p>";
			echo "<p>Hora Inicio: ".$hor->getHoraIni()."</p>";
			echo "<p>Hora Final: ".$hor->getHoraFin()."</p>";
			echo "<p>Año Lectivo: ".$hor->getAnio()."</p>";*/
			$contador = $contador + 1;
		}
		
		$query_p = "UPDATE paralelo SET HOR_CODIGO='$codigoh' Where AUL_CODIGO = '$aula'";
		$resultado_p = mysqli_query($conn,$query_p);
		

		
		if($resultado_hm && $resultado_p && $resultado3){
			echo '<script>
					alert("Los datos se han guardado correctamente");
					window.location="inicializar.php";
				</script>';	
		} else{
			echo '<script>
					alert("Hubo un error al guardar los datos");
					window.history.go(-1);
				</script>';
		}
		
	} else {
		echo '<script>
			alert("Hubo un error al encontrar el horario para guardar");
			window.history.go(-1);
		</script>';
	}
	
} else{
	echo '<script>
		alert("No ha ingresado datos todavia");
		window.history.go(-1);
	</script>';
}
	

?>