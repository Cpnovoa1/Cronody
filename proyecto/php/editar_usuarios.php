<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link href="../css/estiloMostrar.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
<div class="contenedor">
	<div class="cabeza">Usuarios</div>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "select * from usuario u, roles r where u.rol_codigo=r.rol_codigo" );
	$activos = mysqli_query( $conn, "select * from usuario u, roles r where u.usu_estado=1 and u.rol_codigo=r.rol_codigo" );
	$desactivos = mysqli_query( $conn, "select * from usuario u, roles r where u.usu_estado=0 and u.rol_codigo=r.rol_codigo" );
	?>
	<div class="cuerpo">
	<div class="opciones">
		<div class="bloque margen-top"><a href="../html/forms/usuario_form_ing.php" id="idcrear" ><button type="button">Agregar Nuevo</button></a></div>
		<div class="bloque"><form id="form1" name="form1" method="post" action="#">
			<label class="filtro" for="select">Filtro usuarios</label>
			<select name="estado" class="filtro">
				<option value="Todos" selected>Todos</option>
				<option value="Activos">Activos</option>
				<option value="Desactivados">Desactivados</option>
			</select>
			<input type="submit" value="Aceptar">
		</form></div>
	</div>
	<div class="cont-tabla">
	<table>
		<thead>
			<tr>
				<th>N°</th>
				<th>Rol</th>
				<th>Usuario</th>
				<th>Estado</th>
				<th>Operaciones</th>
			</tr>
		</thead>
		<tbody>

			<?php
			//Mostramos los registros
			$estado = $_POST[ 'estado' ];
			
			if ( $estado == 'Todos' ||  $estado == '') {
				$cont = 1;
				while ( $row = mysqli_fetch_array( $result ) ) {
					echo '<tr><td>' .$cont. '</td>';
					echo '<td>' . $row[ "ROL_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "USU_USER" ] . '</td>';
					if($row['USU_ESTADO']=='1'){$estado = 'title="Eliminar" class="tabla-registro-elim btn-eliminar-a"><i class="fas fa-trash"></i>'; $est = "Activo";}
					else {$estado = 'title="Activar" class="btn-eliminar-i"><i class="fas fa-trash-restore"></i>'; $est = "Inactivo";}
					echo '<td>' .$est. '</td>';
					echo '<td> <a href="editar_usuarios_recibe.php?u='.$row[ "USU_CODIGO" ].'" title="Editar" class="btn-editar"><i class="fas fa-edit"></i></a>
							   <a href="eliminar_usuario.php?u='.$row[ "USU_CODIGO" ].'" '.$estado.'</a></td></tr>';
					$cont++;
				}
				mysqli_free_result( $result );

			} else if ( $estado == 'Activos' ) {
				$cont = 1;
				while ( $row = mysqli_fetch_array( $activos ) ) {
					echo '<tr><td>' .$cont. '</td>';
					echo '<td>' . $row[ "ROL_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "USU_USER" ] . '</td>';
					echo '<td>' . $row[ "USU_CLAVE" ] . '</td>';
					if($row['USU_ESTADO']=='1'){$est = "Activo";}
					else {$est = "Inactivo";}
					echo '<td>' .$est. '</td>';
					echo '<td> <a href="editar_usuarios_recibe.php?u='.$row[ "USU_CODIGO" ].'" title="Editar" class="btn-editar"><i class="fas fa-edit"></i></a>
							   <a href="eliminar_usuario.php?u='.$row[ "USU_CODIGO" ].'" title="Eliminar" class="tabla-registro-elim  btn-eliminar-a"><i class="fas fa-trash"></i></a></td></tr>';
					$cont++;
				}
				mysqli_free_result( $activos );

			} else if ( $estado == 'Desactivados' ) {
				$cont = 1;
				while ( $row = mysqli_fetch_array( $desactivos ) ) {
					echo '<tr><td>' .$cont. '</td>';
					echo '<td>' . $row[ "ROL_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "USU_USER" ] . '</td>';
					echo '<td>' . $row[ "USU_CLAVE" ] . '</td>';
					if($row['USU_ESTADO']=='1'){$est = "Activo";}
					else {$est = "Inactivo";}
					echo '<td>' .$est. '</td>';
					echo '<td> <a href="editar_usuarios_recibe.php?u='.$row[ "USU_CODIGO" ].'" title="Editar" class="btn-editar"><i class="fas fa-edit"></i></a>
							   <a href="eliminar_usuario.php?u='.$row[ "USU_CODIGO" ].'" title="Activar"  class="btn-eliminar-i"><i class="fas fa-trash-restore"></i></a></td></tr>';
					$cont++;
				}
				mysqli_free_result( $desactivos );
			}
			?>
		</tbody>
	</table>
	</div>
	</div>
</div>
<script src="../js/confirmacion.js"></script>
</body>
</html>