<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link href="../css/estiloMostrar.css" rel="stylesheet" type="text/css">
</head>

<body>
	<hr size="2px" color="black" />
	<h1><div align="center">Administrador</div></h1>
	<hr size="2px" color="black" />
	<br>
	<br>

	<?php
	$conn = new mysqli("localhost", "admin", "admin", "horarios");

	//Ejecutamos la sentencia SQL
	$result=mysqli_query($conn,"select * from administrador");
	$activos=mysqli_query($conn,"select * from administrador where ADM_ESTADO=1");
	$desactivos=mysqli_query($conn,"select * from administrador where ADM_ESTADO=0");
	?>

	<div class="filtro">
		<form id="form1" name="form1" method="post" action="mostrar_administrador.php">
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
				<th>Codigo Usuario</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Telefono</th>
				<th>Cedula</th>
				<th>Fecha de nacimiento</th>
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
				echo '<tr><td>'.$row["ADM_CODIGO"].'</td>';
				echo '<td>'.$row["USU_CODIGO"].'</td>';
				echo '<td>'.$row["ADM_NOMBRE"].'</td>';
				echo '<td>'.$row["ADM_APELLIDO"].'</td>';
				echo '<td>'.$row["ADM_TELEFONO"].'</td>';
				echo '<td>'.$row["ADM_CEDULA"].'</td>';
				echo '<td>'.$row["ADM_FNACIMIENTO"].'</td>';
				echo '<td>'.$row["ADM_DIRECCION"].'</td>';
				echo '<td>'.$row["ADM_ESTADO"].'</td></tr>';
				}
				mysqli_free_result($result);

			}else if($estado == 'Activos'){
				while ($row=mysqli_fetch_array($activos))
				{
				echo '<tr><td>'.$row["ADM_CODIGO"].'</td>';
				echo '<td>'.$row["USU_CODIGO"].'</td>';
				echo '<td>'.$row["ADM_NOMBRE"].'</td>';
				echo '<td>'.$row["ADM_APELLIDO"].'</td>';
				echo '<td>'.$row["ADM_TELEFONO"].'</td>';
				echo '<td>'.$row["ADM_CEDULA"].'</td>';
				echo '<td>'.$row["ADM_FNACIMIENTO"].'</td>';
				echo '<td>'.$row["ADM_DIRECCION"].'</td>';
				echo '<td>'.$row["ADM_ESTADO"].'</td></tr>';
				}
				mysqli_free_result($activos);

			}else if($estado == 'Desactivados'){
				while ($row=mysqli_fetch_array($desactivos))
				{
				echo '<tr><td>'.$row["ADM_CODIGO"].'</td>';
				echo '<td>'.$row["USU_CODIGO"].'</td>';
				echo '<td>'.$row["ADM_NOMBRE"].'</td>';
				echo '<td>'.$row["ADM_APELLIDO"].'</td>';
				echo '<td>'.$row["ADM_TELEFONO"].'</td>';
				echo '<td>'.$row["ADM_CEDULA"].'</td>';
				echo '<td>'.$row["ADM_FNACIMIENTO"].'</td>';
				echo '<td>'.$row["ADM_DIRECCION"].'</td>';
				echo '<td>'.$row["ADM_ESTADO"].'</td></tr>';
				}
				mysqli_free_result($desactivos);
			}

		?>
		</tbody>
	</table>


</body>
</html>