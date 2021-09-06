<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link href="../css/estiloMostrar.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h1>Materias</h1>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "select * from materias m, docente d where m.doc_codigo = d.doc_codigo" );
	$activos = mysqli_query( $conn, "select * from materias m, docente d where m.doc_codigo = d.doc_codigo and mat_estado=1" );
	$desactivos = mysqli_query( $conn, "select * from materias m, docente d where m.doc_codigo = d.doc_codigo and mat_estado=0" );
	?>

	<div class="filtro">
		<form id="form1" name="form1" method="post" action="#">
			<label for="select">Filtro materias:</label>
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
				<th>Docente</th>
				<th>Materia</th>
				<th>Área</th>
				<th>Estado</th>
			</tr>
		</thead>
		<tbody>

			<?php
			//Mostramos los registros
			$estado = $_POST[ 'estado' ];

			if ( $estado == 'Todos' ) {
				while ( $row = mysqli_fetch_array( $result ) ) {
					echo '<tr><td>' . $row[ "MAT_CODIGO" ] . '</td>';
					echo '<td>' . $row[ "DOC_NOMBRE" ].' '. $row[ "DOC_APELLIDO" ] . '</td>';
					echo '<td>' . $row[ "MAT_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "MAT_AREA" ] . '</td>';
					echo '<td>' . $row[ "MAT_ESTADO" ] . '</td></tr>';
				}
				mysqli_free_result( $result );

			} else if ( $estado == 'Activos' ) {
				while ( $row = mysqli_fetch_array( $activos ) ) {
					echo '<tr><td>' . $row[ "MAT_CODIGO" ] . '</td>';
					echo '<td>' . $row[ "DOC_NOMBRE" ].' '. $row[ "DOC_APELLIDO" ] . '</td>';
					echo '<td>' . $row[ "MAT_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "MAT_AREA" ] . '</td>';
					echo '<td>' . $row[ "MAT_ESTADO" ] . '</td></tr>';
				}
				mysqli_free_result( $activos );

			} else if ( $estado == 'Desactivados' ) {
				while ( $row = mysqli_fetch_array( $desactivos ) ) {
					echo '<tr><td>' . $row[ "MAT_CODIGO" ] . '</td>';
					echo '<td>' . $row[ "DOC_NOMBRE" ].' '. $row[ "DOC_APELLIDO" ] . '</td>';
					echo '<td>' . $row[ "MAT_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "MAT_AREA" ] . '</td>';
					echo '<td>' . $row[ "MAT_ESTADO" ] . '</td></tr>';
				}
				mysqli_free_result( $desactivos );
			}
			?>
		</tbody>
	</table>
</body>
</html>