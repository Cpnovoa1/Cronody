<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro</title>
<link href="../css/estilohtmls.css" rel="stylesheet" type="text/css">
<link href="../css/estiloform.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
<?php
	//declarar variables
	$nombre = $_POST['nombre'];    //recoger los datos del formulario enviado por POST - del arreglo POST seleccionamos el dato
	$apellido = $_POST['apellido'];
	$cedula = $_POST['cedula'];
	$ecivil = $_POST['ecivil'];
	$direccion = $_POST['direccion'];
	$email = $_POST['email'];
	$fecha = DateTime::createFromFormat('Y-m-d', $_POST['fnacimiento']);
	$fnacimiento = $fecha->format('d/m/Y');
	$ltrabajo = $_POST['ltrabajo'];
	$telefono = $_POST['telefono'];
	
	$n = mb_strtoupper($nombre, 'UTF-8');
	$a = mb_strtoupper($apellido, 'UTF-8');
	$d = mb_strtoupper($direccion, 'UTF-8');
	$t = mb_strtoupper($ltrabajo, 'UTF-8');
	
	date_default_timezone_set('America/Lima');
	
	$dias = explode("/", $fnacimiento, 3);
	$dias = mktime(0,0,0,$dias[1],$dias[0],$dias[2]);
	$edad = (int)((time()-$dias)/31556926);
	
	$nombreServidor = "localhost";
	$nombreUsuario = "admin";
	$passwordBaseDeDatos = "admin";
	$nombreBaseDeDatos = "alumno";
	
	$conn = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);

	if ($conn ->connect_error) {
		die("Connection failed: " . $conn ->connect_error);
	}
	
	$repetido = 0;
	$query_rep="Select * From alumno";
	$result_rep = mysqli_query($conn,$query_rep);
	while($row=mysqli_fetch_array($result_rep)){
		if($cedula == $row["alu_cedula"] ){
			$repetido = 1;
		}
	}
	
	if($repetido == 0){
		$query = "INSERT INTO alumno(alu_nombres, alu_apellido, alu_cedula, alu_direccion, alu_telefono, alu_email, alu_lugartrab, alu_estadocivil, alu_fechan) VALUES ('$n','$a','$cedula','$d','$telefono','$email','$t','$ecivil','$fnacimiento')";
		$resultado = mysqli_query($conn,$query);
	}
	
?>
<div class="contenedor">
	<div class="registro-cont">
	<h1 class="titulo centrar">Registro</h1>
		<div class="contenedor-tabla">
		<table width="100%" class="blueTable">
			<tr>
				<td width="38%">Nombre</td>
				<td width="62%"><?php echo $nombre.' '.$apellido; ?></td>
			</tr>
			<tr>
				<td>Cédula</td>
				<td><?php echo $cedula; ?></td>
			</tr>
			<tr>
				<td>Teléfono</td>
				<td><?php echo $telefono; ?></td>
			</tr>
			<tr>
				<td>Estado Civil</td>
				<td><?php echo $ecivil; ?></td>
			</tr>
			<tr>
				<td>Lugar de Trabajo</td>
				<td><?php echo $ltrabajo; ?></td>
			</tr>
			<tr>
				<td>Dirección</td>
				<td><?php echo $direccion; ?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo $email; ?></td>
			</tr>
			<tr>
				<td>Edad</td>
				<td><?php echo $edad." año/s"; ?></td>
			</tr>
		</table>
		</div>
		<?php
		if($resultado){
			?>
		<p class="exito centrar2"><i class="fas fa-check fa-fw"></i> Alumno guardado existosamente</p><?php
		}
		else{
			//echo '<p class="error centrar"><i class="fas fa-times fa-fw"></i> Ha ocurrido un error al guardar</p>';
			?><p class="error centrar2"><i class="fas fa-times fa-fw"></i> Ha ocurrido un error al guardar</p><?php
			if($repetido != 0){
				?><p class="error centrar3"><i class="fas fa-times fa-fw"></i> El alumno ingresado con la cédula <?php echo $cedula." ";?> ya existe</p><?php
			}
		}
	?>
	<p class="centrar">
		<a href="../index.html"><button type="button" name="volver" id="idvolver" value="volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a>
	</p>
	</div>
</div>
</body>
</html>
