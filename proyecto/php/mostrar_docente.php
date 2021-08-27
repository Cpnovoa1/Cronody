<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<hr size="2px" color="black" />
	<h1><div align="center">Docentes</div></h1>
<hr size="2px" color="black" />
<br>
<br>

<?php
$conn = new mysqli("localhost", "admin", "admin", "horarios");
 
//Ejecutamos la sentencia SQL
$result=mysqli_query($conn,"select * from docente");
$activos=mysqli_query($conn,"select * from docente where DOC_ESTADO=1");
$desactivos=mysqli_query($conn,"select * from docente where DOC_ESTADO=0");
?>

<div>
<form id="form1" name="form1" method="post" action="mostrar_docente.php">
  <label for="select">Seleccione:</label>
  <select name="estado" id="select">
  <option value="Todos">Todos</option>
  <option value="Activos">Activos</option>
  <option value="Desactivados">Desactivados</option>
  </select>
  <input type="submit" value="Aceptar">
</form>
</div>

<table align="center">
  <tr>
<th>Codigo</th>
<th>Codigo Usuario</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Telefono</th>
<th>Cedula</th>
<th>Fecha de nacimiento</th>
<th>Direccion</th>
<th>Carga Horaria</th>
<th>Estado</th>
</tr>

<?php
//Mostramos los registros
	$estado=$_POST['estado'];	
	
	if($estado == 'Todos'){
		while ($row=mysqli_fetch_array($result))
		{
		echo '<tr><td>'.$row["DOC_CODIGO"].'</td>';
		echo '<td>'.$row["USU_CODIGO"].'</td>';
		echo '<td>'.$row["DOC_NOMBRE"].'</td>';
		echo '<td>'.$row["DOC_APELLIDO"].'</td>';
		echo '<td>'.$row["DOC_TELEFONO"].'</td>';
		echo '<td>'.$row["DOC_CEDULA"].'</td>';
		echo '<td>'.$row["DOC_FNACIMIENTO"].'</td>';
		echo '<td>'.$row["DOC_DIRECCION"].'</td>';
		echo '<td>'.$row["DOC_CARGAHORARIA"].'</td>';
		echo '<td>'.$row["DOC_ESTADO"].'</td></tr>';
		}
		mysqli_free_result($result);
		
	}else if($estado == 'Activos'){
		while ($row=mysqli_fetch_array($activos))
		{
		echo '<tr><td>'.$row["DOC_CODIGO"].'</td>';
		echo '<td>'.$row["USU_CODIGO"].'</td>';
		echo '<td>'.$row["DOC_NOMBRE"].'</td>';
		echo '<td>'.$row["DOC_APELLIDO"].'</td>';
		echo '<td>'.$row["DOC_TELEFONO"].'</td>';
		echo '<td>'.$row["DOC_CEDULA"].'</td>';
		echo '<td>'.$row["DOC_FNACIMIENTO"].'</td>';
		echo '<td>'.$row["DOC_DIRECCION"].'</td>';
		echo '<td>'.$row["DOC_CARGAHORARIA"].'</td>';
		echo '<td>'.$row["DOC_ESTADO"].'</td></tr>';
		}
		mysqli_free_result($activos);
		
	}else if($estado == 'Desactivados'){
		while ($row=mysqli_fetch_array($desactivos))
		{
		echo '<tr><td>'.$row["DOC_CODIGO"].'</td>';
		echo '<td>'.$row["USU_CODIGO"].'</td>';
		echo '<td>'.$row["DOC_NOMBRE"].'</td>';
		echo '<td>'.$row["DOC_APELLIDO"].'</td>';
		echo '<td>'.$row["DOC_TELEFONO"].'</td>';
		echo '<td>'.$row["DOC_CEDULA"].'</td>';
		echo '<td>'.$row["DOC_FNACIMIENTO"].'</td>';
		echo '<td>'.$row["DOC_DIRECCION"].'</td>';
		echo '<td>'.$row["DOC_CARGAHORARIA"].'</td>';
		echo '<td>'.$row["DOC_ESTADO"].'</td></tr>';
		}
		mysqli_free_result($desactivos);
	}

?>
</table>


</body>
</html>