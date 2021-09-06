<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
	<?php

	include_once('Location: class.php');
	
  $nombreServidor = "localhost";
  $nombreUsuario = "admin";
  $passwordBaseDeDatos = "admin";
  $nombreBaseDeDatos = "horarios";
	
	if (isset($_GET["horaIni"]) && isset($_GET["horaFin"]) && isset($_GET["dia"]) && isset($_GET["materia"])) {
   
    				$phphoraIni = $_GET["horaIni"];
					$phphoraFin = $_GET["horaFin"];
					$phpdia = $_GET["dia"];
					$phpmateria = $_GET["materia"];
 
    // mostrar $phpVar1 y $phpVar2
							
    		/*echo "<p>Parameters: " . $phphoraIni . " " . $phphoraFin ." " . $phpdia." " . $phpmateria. "</p>";
						} else {
    		echo "<p>No parameters</p>";*/
						}
  /*
	$hora_ma = new materias_horario ($horaIni, $horaFin, $dia, $materia);
	
	 $hora_ma_array = array();*/
	
	
	
	
  // Crear conexión con la base de datos.
  $conn = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
   
  // Validar la conexión de base de datos.
  if ($conn ->connect_error) {
    die("Connection failed: " . $conn ->connect_error);
  }
 
   // Consulta a la base de datos.
  $query = "INSERT INTO `horarios_materias`(`HOR_CODIGO`, `MAT_CODIGO`, `DIA_CODIGO`, `HMA_HORAINICIO`, `HMA_HORAFIN`) VALUES ('1','$phpmateria','$phpdia','$phphoraIni','$phphoraFin')";
  $resultado = mysqli_query($conn,$query);
  //Verifica que la consulta se realizo con o sin coincidencias en la base 
  if($resultado){
	  
    echo '<br> Se a guardado la informacion correctamente.<br/>';
//header("Location:../index.html");
	   }
   else
	   {
        echo '<br>No se a podido guardar la infomacion , <a href="../html/alumno.html">vuelva a intenarlo</a>.<br/>';}	
			
    ?>	
	
	<a href="crear_horario.php"><input type="button" value="Regresar"></a>
	

</body>
</html>