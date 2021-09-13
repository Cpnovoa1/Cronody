<?php 

function verificarDatos($doc, $materia, $horario, $horini, $horfin, $dia, $ideh){
	//Verifica si recibio las variables, si no entonces enviara 0 como codigo de error en el envio
	if($doc != "" && $materia != "" && $horario != "" && $horini != "" && $horfin != "" && $dia != ""){

		include("horario_arreglo.php");

		$conn = new mysqli("localhost", "admin", "admin", "horarios");
		if ($conn ->connect_error) {
			die("Connection failed: " . $conn ->connect_error);
		}

		$horas;
		$mater;	
		
		$verificar = 0;
		$verif = mysqli_query($conn, "Select * From horarios_materias h, materias m Where h.MAT_CODIGO = m.MAT_CODIGO and h.HOR_CODIGO = '$horario' and h.HMA_ESTADO = 1 and m.MAT_ESTADO = 1 and h.HMA_CODIGO <> '$ideh'");
		while($fila = mysqli_fetch_array($verif)){
			if(($horini) == $fila['HMA_HORAINICIO'] && ($horfin) == $fila['HMA_HORAFIN'] && $dia == $fila['DIA_CODIGO']){
				$verificar = 1;
			}
		}
		if($verificar == 0){
			//Query que valida que el docente tenga horas disponibles
			$sql = "Select COUNT(*) as Registros From docente where DOC_CARGAHORARIA > 0 AND DOC_CODIGO='$doc'";
			$result = mysqli_query( $conn, $sql );
			if($result->num_rows > 0){

				//Query que valida si el docente ya da clases en el horario seleccionado
				$repetido = 0;
				$sql4 = "Select * From horarios_materias h, materias m, horarios o where h.MAT_CODIGO = m.MAT_CODIGO and h.HOR_CODIGO = o.HOR_CODIGO and o.HOR_ESTADO = 1 and h.HMA_ESTADO = 1";
				$result4 = mysqli_query( $conn, $sql4);

				while($row4 = mysqli_fetch_array($result4)){
					if(($horini) == $row4['HMA_HORAINICIO'] && ($horfin) == $row4['HMA_HORAFIN'] && $dia == $row4['DIA_CODIGO'] && $doc == $row4['DOC_CODIGO']){
						$repetido = 1;
					}
				}
				if($repetido == 1){
					return 4;
				} else {		

					//Query para obtener las horas semanales y el nombre de la materia colocada en el horario
					$sql2 = "Select * From materias where MAT_CODIGO='$materia'";
					$result2 = mysqli_query( $conn, $sql2 );

					while($row = mysqli_fetch_array($result2)){
						$horas = $row[4];
						$mater = $row[2];
					}

					//Comprobamos que no hayan más de 2 horas por día de una sola materia
					$cont2 = 1;

					$query = mysqli_query($conn, "Select * From horarios_materias h, materias m Where h.MAT_CODIGO = m.MAT_CODIGO AND h.HOR_CODIGO = '$horario' and h.HMA_ESTADO = 1");
					while($row5 = mysqli_fetch_array($query)){
						$mate2 = $row5[9];

						if($mater == $mate2 && $dia == $row5[3]){
							$cont2++;
						}
					}

					if($cont2 <= 2){
						//Se cuenta que materias tienen el mismo nombre en la base y luego se compara con el num horas disponibles
						$cont = 1;
						$query1 = mysqli_query($conn, "Select * From horarios_materias h, materias m Where h.MAT_CODIGO = m.MAT_CODIGO AND h.HOR_CODIGO = '$horario' and h.HMA_ESTADO = 1");
						while($row2 = mysqli_fetch_array($query1)){
							$mate2 = $row2[2];

							if($mater == $mate2){
								$cont++;
							}
						}

						if($cont <= $horas){

							return 1;

						} else {
							return 3;
						}
					} else {
						return 5;
					}
				}
			} else{
				return 2;
			}
		} else  {
			return 6;
		}	
	} else {
		return 0;
	}
}

?>