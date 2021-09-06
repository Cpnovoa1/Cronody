<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link href="../css/estiloMostrar.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h1>Aulas</h1>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "select * from paralelo" );
	$activos = mysqli_query( $conn, "select * from paralelo where aul_estado=1" );
	$desactivos = mysqli_query( $conn, "select * from paralelo where aul_estado=0" );
	?>

	<div class="filtro">
		<form id="form1" name="form1" method="post" action="#">
			<label for="select">Filtro aulas:</label>
			<select name="estado" id="select">
				<option value="Todos">Todos</option>
				<option value="Activos">Activos</option>
				<option value="Desactivados">Desactivados</option>
			</select>
			<input type="submit" value="Aceptar">
		</form>
	</div>
	<table>
		<thead>
			<tr>
				<th>Codigo</th>
				<th>Horario</th>
				<th>Nombre</th>
				<th>Curso</th>
				<th>Estado</th>
			</tr>
		</thead>
		<tbody>

			<?php
			//Mostramos los registros
			$estado = $_POST[ 'estado' ];

			if ( $estado == 'Todos' ) {
				while ( $row = mysqli_fetch_array( $result ) ) {
					echo '<tr><td>' . $row[ "AUL_CODIGO" ] . '</td>';
					echo '<td>' . $row[ "HOR_CODIGO" ]. '</td>';
					echo '<td>' . $row[ "AUL_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "AUL_CURSO" ] . '</td>';
					echo '<td>' . $row[ "AUL_ESTADO" ] . '</td></tr>';
				}
				mysqli_free_result( $result );

			} else if ( $estado == 'Activos' ) {
				while ( $row = mysqli_fetch_array( $activos ) ) {
					echo '<tr><td>' . $row[ "AUL_CODIGO" ] . '</td>';
					echo '<td>' . $row[ "HOR_CODIGO" ]. '</td>';
					echo '<td>' . $row[ "AUL_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "AUL_CURSO" ] . '</td>';
					echo '<td>' . $row[ "AUL_ESTADO" ] . '</td></tr>';
				}
				mysqli_free_result( $activos );

			} else if ( $estado == 'Desactivados' ) {
				while ( $row = mysqli_fetch_array( $desactivos ) ) {
					echo '<tr><td>' . $row[ "AUL_CODIGO" ] . '</td>';
					echo '<td>' . $row[ "HOR_CODIGO" ]. '</td>';
					echo '<td>' . $row[ "AUL_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "AUL_CURSO" ] . '</td>';
					echo '<td>' . $row[ "AUL_ESTADO" ] . '</td></tr>';	
				}
				mysqli_free_result( $desactivos );
			}
			?>
		</tbody>
	</table>
</body>
</html>