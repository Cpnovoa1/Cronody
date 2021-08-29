<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Impresión</title>
<link href="../css/estilohtmls.css" rel="stylesheet" type="text/css">
<link href="../css/estiloform.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
<div class="contenido">
	<div class="impresion-cont">
	<h1 class="titulo centrar">Registros</h1>
	<?php
	$conn = new mysqli("localhost", "admin", "admin", "alumno");
	date_default_timezone_set('America/Lima');
	
	if ($conn ->connect_error) {
		die("Connection failed: " . $conn ->connect_error);
	}
	$result=mysqli_query($conn,"Select * From alumno Order By alu_nombres");
	
	function edad($fnacimiento){
		$dias = explode("/", $fnacimiento, 3);
		$dias = mktime(0,0,0,$dias[1],$dias[0],$dias[2]);
		$edad = (int)((time()-$dias)/31556926);
		return $edad;
	}
	
	//Ejecutamos la sentencia SQL
	?>
	<div class="contenedor-tabla">
		<table class="registros" width="95%">
			<tr>
			<th width="8%" >Nombre</th>
			<th width="8%" >Apellido</th>
			<th width="7%" >Cédula</th>
			<th width="9%" >Teléfono</th>
			<th width="10%" >Estado Civil</th>
			<th width="17%" >Dirección</th>
			<th width="10%" >Lugar de Trabajo</th>
			<th width="14%" >Email</th>
			<th width="10%" >Fecha de Nacimiento</th>
			<th width="7%" >Edad</th>
			</tr>
			<?php
			//Mostramos los registros
			while ($row=mysqli_fetch_array($result))
			{
			echo '<tr><td>'.$row["alu_nombres"].'</td>';
			echo '<td>'.$row["alu_apellido"].'</td>';
			echo '<td>'.$row["alu_cedula"].'</td>';
			echo '<td>'.$row["alu_telefono"].'</td>';
			echo '<td>'.$row["alu_estadocivil"].'</td>';
			echo '<td>'.$row["alu_direccion"].'</td>';
			echo '<td>'.$row["alu_lugartrab"].'</td>';
			echo '<td>'.$row["alu_email"].'</td>';
			echo '<td>'.$row["alu_fechan"].'</td>';
			echo '<td>'.edad($row["alu_fechan"]).' año/s'.'</td></tr>';
			}
			mysqli_free_result($result)
			?>
			</table>
		</div>
	<div class="volver"><a href="../index.html"><button type="button" id="idvolver" name="volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a></div>
</div>
</div>
</body>
</html>