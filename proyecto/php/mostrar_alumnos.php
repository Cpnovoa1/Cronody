<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link href="../css/estiloMostrar.css" rel="stylesheet" type="text/css">
</head>

<body>
	<hr size="2px" color="black" />
	<h1><div align="center">Alumnos</div></h1>
	<hr size="2px" color="black" />
	<br>
	<br>

	<?php
	$conn = new mysqli("localhost", "admin", "admin", "horarios");

	//Ejecutamos la sentencia SQL
	$result=mysqli_query($conn,"select * from alumno");
	$activos=mysqli_query($conn,"select * from alumno where ALU_ESTADO=1");
	$desactivos=mysqli_query($conn,"select * from alumno where ALU_ESTADO=0");
	?>

	<div class="filtro">
		<form id="form1" name="form1" method="post" action="mostrar_alumnos.php">
		  <label for="select">Select:</label>
		  <select name="estado" id="select">
		  <option value="Todos">Todos</option>
		  <option value="Activos">Activos</option>
		  <option value="Desactivados">Desactivados</option>
		  </select>
		  <input type="submit" value="Aceptar">
		</form>
	</div>

	<table align="center">
		<thead>
			<tr>
				<th>Codigo</th>
				<th>Aula</th>
				<th>Codigo de usuario</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Email</th>
				<th>Telefono</th>
				<th>Cedula</th>
				<th>Fecha de Nacimiento</th>
				<th>Direccion</th>
				<th>Estado</th>
			</tr>
		</thead>

		<tbody>
		<?php
		//Mostramos los registros
			$estado=$_POST['estado'];	

			if($estado == 'Todos'){
				while ($row=mysqli_fetch_array($result))
				{
				echo '<tr><td>'.$row["ALU_CODIGO"].'</td>';
				echo '<td>'.$row["AUL_CODIGO"].'</td>';
				echo '<td>'.$row["USU_CODIGO"].'</td>';
				echo '<td>'.$row["ALU_NOMBRE"].'</td>';
				echo '<td>'.$row["ALU_APELLIDO"].'</td>';
				echo '<td>'.$row["ALU_EMAIL"].'</td>';
				echo '<td>'.$row["ALU_TELEFONO"].'</td>';
				echo '<td>'.$row["ALU_CEDULA"].'</td>';
				echo '<td>'.$row["ALU_FNACIMIENTO"].'</td>';
				echo '<td>'.$row["ALU_DIRECCION"].'</td>';
				echo '<td>'.$row["ALU_ESTADO"].'</td></tr>';
				}
				mysqli_free_result($result);

			}else if($estado == 'Activos'){
				while ($row=mysqli_fetch_array($activos))
				{
				echo '<tr><td>'.$row["ALU_CODIGO"].'</td>';
				echo '<td>'.$row["AUL_CODIGO"].'</td>';
				echo '<td>'.$row["USU_CODIGO"].'</td>';
				echo '<td>'.$row["ALU_NOMBRE"].'</td>';
				echo '<td>'.$row["ALU_APELLIDO"].'</td>';
				echo '<td>'.$row["ALU_EMAIL"].'</td>';
				echo '<td>'.$row["ALU_TELEFONO"].'</td>';
				echo '<td>'.$row["ALU_CEDULA"].'</td>';
				echo '<td>'.$row["ALU_FNACIMIENTO"].'</td>';
				echo '<td>'.$row["ALU_DIRECCION"].'</td>';
				echo '<td>'.$row["ALU_ESTADO"].'</td></tr>';
				}
				mysqli_free_result($activos);

			}else if($estado == 'Desactivados'){
				while ($row=mysqli_fetch_array($desactivos))
				{
				echo '<tr><td>'.$row["ALU_CODIGO"].'</td>';
				echo '<td>'.$row["AUL_CODIGO"].'</td>';
				echo '<td>'.$row["USU_CODIGO"].'</td>';
				echo '<td>'.$row["ALU_NOMBRE"].'</td>';
				echo '<td>'.$row["ALU_APELLIDO"].'</td>';
				echo '<td>'.$row["ALU_EMAIL"].'</td>';
				echo '<td>'.$row["ALU_TELEFONO"].'</td>';
				echo '<td>'.$row["ALU_CEDULA"].'</td>';
				echo '<td>'.$row["ALU_FNACIMIENTO"].'</td>';
				echo '<td>'.$row["ALU_DIRECCION"].'</td>';
				echo '<td>'.$row["ALU_ESTADO"].'</td></tr>';
				}
				mysqli_free_result($desactivos);
			}

		?>
		</tbody>
	</table>


</body>
</html>