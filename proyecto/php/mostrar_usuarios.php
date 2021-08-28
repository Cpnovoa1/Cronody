<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link href="../css/estiloMostrar.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h1>Usuarios</h1>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "select * from usuario u, roles r where u.rol_codigo=r.rol_codigo" );
	$activos = mysqli_query( $conn, "select * from usuario u, roles r where u.usu_estado=1 and u.rol_codigo=r.rol_codigo" );
	$desactivos = mysqli_query( $conn, "select * from usuario u, roles r where u.usu_estado=0 and u.rol_codigo=r.rol_codigo" );
	?>

	<div class="filtro">
		<form id="form1" name="form1" method="post" action="#">
			<label for="select">Mostar usuarios:</label>
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
				<th>Rol</th>
				<th>Usuario</th>
				<th>Clave</th>
				<th>Estado</th>
			</tr>
		</thead>
		<tbody>

			<?php
			//Mostramos los registros
			$estado = $_POST[ 'estado' ];

			if ( $estado == 'Todos' ) {
				while ( $row = mysqli_fetch_array( $result ) ) {
					echo '<tr><td>' . $row[ "USU_CODIGO" ] . '</td>';
					echo '<td>' . $row[ "ROL_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "USU_USER" ] . '</td>';
					echo '<td>' . $row[ "USU_CLAVE" ] . '</td>';
					echo '<td>' . $row[ "USU_ESTADO" ] . '</td></tr>';
				}
				mysqli_free_result( $result );

			} else if ( $estado == 'Activos' ) {
				while ( $row = mysqli_fetch_array( $activos ) ) {
					echo '<tr><td>' . $row[ "USU_CODIGO" ] . '</td>';
					echo '<td>' . $row[ "ROL_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "USU_USER" ] . '</td>';
					echo '<td>' . $row[ "USU_CLAVE" ] . '</td>';
					echo '<td>' . $row[ "USU_ESTADO" ] . '</td></tr>';
				}
				mysqli_free_result( $activos );

			} else if ( $estado == 'Desactivados' ) {
				while ( $row = mysqli_fetch_array( $desactivos ) ) {
					echo '<tr><td>' . $row[ "USU_CODIGO" ] . '</td>';
					echo '<td>' . $row[ "ROL_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "USU_USER" ] . '</td>';
					echo '<td>' . $row[ "USU_CLAVE" ] . '</td>';
					echo '<td>' . $row[ "USU_ESTADO" ] . '</td></tr>';
				}
				mysqli_free_result( $desactivos );
			}
			?>
		</tbody>
	</table>
</body>
</html>