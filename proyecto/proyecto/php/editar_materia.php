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
	<div class="cabeza">Materias</div>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "select * from materias m, docente d, nivel n where (m.doc_codigo=d.doc_codigo or m.DOC_CODIGO is null) and m.niv_codigo=n.niv_codigo group by m.MAT_CODIGO order by m.MAT_NOMBRE" );
	$activos = mysqli_query( $conn, "select * from materias m, docente d, nivel n where (m.doc_codigo=d.doc_codigo or m.DOC_CODIGO is null) and m.niv_codigo=n.niv_codigo and m.mat_estado=1 group by m.MAT_CODIGO order by m.MAT_NOMBRE" );
	$desactivos = mysqli_query( $conn, "select * from materias m, docente d, nivel n where (m.doc_codigo=d.doc_codigo or m.DOC_CODIGO is null) and m.niv_codigo=n.niv_codigo and m.mat_estado=0 group by m.MAT_CODIGO order by m.MAT_NOMBRE" );
	$materiasq = mysqli_query($conn, "select *, count(case MAT_ESTADO when '1' then 1 else null end and case d.DOC_ESTADO when '1' then 1 else null end) docentes, sum(m.MAT_ESTADO) estado from materias m, docente d, nivel n where (m.doc_codigo=d.doc_codigo or m.doc_codigo is null) and m.niv_codigo=n.niv_codigo group by m.MAT_NOMBRE, m.NIV_CODIGO order by mat_nombre");
	?>
	<div class="cuerpo">
	<div class="opciones">
		<div class="bloque margen-top">
			<a href="../html/forms/materia_form_ing.php" id="idcrear" ><button type="button">Agregar Nuevo</button></a>
			<a href="asignarmaterias.php" class="crear" ><button type="button">Asignar materia a docente</button></a>
		</div>
		<div class="bloque"><form id="form1" name="form1" method="post" action="#">
			<label class="filtro" for="select">Filtro materias</label>
			<select name="estado" class="filtro">
				<option value="Todos" selected>Todos</option>
				<option value="Activos">Activos</option>
				<option value="Desactivados">Desactivados</option>
				<option value="Materias">Por Materias</option>
			</select>
			<input type="submit" value="Aceptar">
		</form></div>
	</div>
	<div class="cont-tabla">
	<table>
		<thead>
			<tr>
				<th>N°</th>
				<th>Materia</th>
				<th>Área</th>
				<th>Nivel</th>
				<th>Docente</th>
				<th>Horas<br>Pedagógicas</th>
				<th>Operaciones</th>
			</tr>
		</thead>
		<tbody>

			<?php
			//Mostramos los registros
			$estado = $_POST[ 'estado' ];
			$e='0';
			if ( $estado == 'Todos' ||  $estado == '') {
				$cont = 1;
				while ( $row = mysqli_fetch_array( $result ) ) {
					echo '<tr><td>' .$cont. '</td>';
					echo '<td>' . $row[ "MAT_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "MAT_AREA" ] . '</td>';
					if($row['NIV_ESTADO']=='1'){$niv = ucfirst(mb_strtolower($row[ "NIV_NOMBRE" ], 'UTF-8')). ' ' .ucfirst(mb_strtolower($row[ "NIV_SUBNIVEL" ], 'UTF-8'));}
					else {$niv = "Ninguno";}
					echo '<td>' .$niv. '</td>';
					if($row['DOC_ESTADO']=='0' || is_null($row[1])){$doc = "Ninguno";}
					else {$doc = $row[ "DOC_NOMBRE" ] . ' ' . $row[ "DOC_APELLIDO" ];}
					echo '<td>' .$doc. '</td>';
					echo '<td>' . $row[ "MAT_CARGAHORARIA" ] . '</td>';
					if($row['MAT_ESTADO']=='1'){$estado = 'title="Eliminar" class="tabla-registro-elim btn-eliminar-a"><i class="fas fa-trash"></i>'; $est = "Activo";}
					else {$estado = 'title="Activar" class="btn-eliminar-i"><i class="fas fa-trash-restore"></i>'; $est = "Inactivo";}
					echo '<td> <a href="editar_materia_recibe.php?u='.$row[ "MAT_CODIGO" ].'" title="Editar" class="btn-editar"><i class="fas fa-edit"></i></a>
							   <a href="eliminar_materia.php?u='.$row[ "MAT_CODIGO" ].'" '.$estado.'</a></td></tr>';
					$cont++;
				}
				mysqli_free_result( $result );

			} else if ( $estado == 'Activos' ) {
				$cont = 1;
				while ( $row = mysqli_fetch_array( $activos ) ) {
					echo '<tr><td>' .$cont. '</td>';
					echo '<td>' . $row[ "MAT_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "MAT_AREA" ] . '</td>';
					if($row['NIV_ESTADO']=='1'){$niv = ucfirst(mb_strtolower($row[ "NIV_NOMBRE" ], 'UTF-8')). ' ' .ucfirst(mb_strtolower($row[ "NIV_SUBNIVEL" ], 'UTF-8'));}
					else {$niv = "Ninguno";}
					echo '<td>' .$niv. '</td>';
					if($row['DOC_ESTADO']=='0' || is_null($row[1])){$doc = "Ninguno";}
					else {$doc = $row[ "DOC_NOMBRE" ] . ' ' . $row[ "DOC_APELLIDO" ];}
					echo '<td>' .$doc. '</td>';
					echo '<td>' . $row[ "MAT_CARGAHORARIA" ] . '</td>';
					echo '<td> <a href="editar_materia_recibe.php?u='.$row[ "MAT_CODIGO" ].'" title="Editar" class="btn-editar"><i class="fas fa-edit"></i></a>
							   <a href="eliminar_materia.php?u='.$row[ "MAT_CODIGO" ].'" title="Eliminar" class="tabla-registro-elim  btn-eliminar-a"><i class="fas fa-trash"></i></a></td></tr>';
					$cont++;
				}
				mysqli_free_result( $activos );

			} else if ( $estado == 'Desactivados' ) {
				$cont = 1;
				while ( $row = mysqli_fetch_array( $desactivos ) ) {
					echo '<tr><td>' .$cont. '</td>';
					echo '<td>' . $row[ "MAT_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "MAT_AREA" ] . '</td>';
					if($row['NIV_ESTADO']=='1'){$niv = ucfirst(mb_strtolower($row[ "NIV_NOMBRE" ], 'UTF-8')). ' ' .ucfirst(mb_strtolower($row[ "NIV_SUBNIVEL" ], 'UTF-8'));}
					else {$niv = "Ninguno";}
					echo '<td>' .$niv. '</td>';
					if($row['DOC_ESTADO']=='0' || is_null($row[1])){$doc = "Ninguno";}
					else {$doc = $row[ "DOC_NOMBRE" ] . ' ' . $row[ "DOC_APELLIDO" ];}
					echo '<td>' .$doc. '</td>';
					echo '<td>' . $row[ "MAT_CARGAHORARIA" ] . '</td>';
					echo '<td> <a href="editar_materia_recibe.php?u='.$row[ "MAT_CODIGO" ].'" title="Editar" class="btn-editar"><i class="fas fa-edit"></i></a>
							   <a href="eliminar_materia.php?u='.$row[ "MAT_CODIGO" ].'" title="Activar"  class="btn-eliminar-i"><i class="fas fa-trash-restore"></i></a></td></tr>';
					$cont++;
				}
				mysqli_free_result( $desactivos );
			} else if ( $estado == 'Materias' ) {
				$cont = 1;
				while ( $row = mysqli_fetch_array( $materiasq ) ) {
					echo '<tr><td>' .$cont. '</td>';
					echo '<td>' . $row[ "MAT_NOMBRE" ] . '</td>';
					echo '<td>' . $row[ "MAT_AREA" ] . '</td>';
					if($row['NIV_ESTADO']=='1'){$niv = ucfirst(mb_strtolower($row[ "NIV_NOMBRE" ], 'UTF-8')). ' ' .ucfirst(mb_strtolower($row[ "NIV_SUBNIVEL" ], 'UTF-8'));}
					else {$niv = "Ninguno";}
					echo '<td>' .$niv. '</td>';
					if($row['DOC_ESTADO']=='1'){$doc = $row[ "DOC_NOMBRE" ] . ' ' . $row[ "DOC_APELLIDO" ];}
					else {$doc = "Ninguno";}
					echo '<td>' .$row['docentes']. ' docente/s' .'</td>';
					echo '<td>' . $row[ "MAT_CARGAHORARIA" ] . '</td>';
					if($row['estado']=='0'){$estado = 'title="Activar" class="btn-eliminar-i"><i class="fas fa-trash-restore"></i>'; $est = "Inactivo"; $esta="0";}
					else {$estado = 'title="Eliminar" class="tabla-registro-elim btn-eliminar-a"><i class="fas fa-trash"></i>'; $est = "Activo"; $esta="1";}
					echo '<td> <a href="editar_materiaG_recibe.php?u='.$row[ "MAT_CODIGO" ].'?e='.$esta.'" title="Editar" class="btn-editar"><i class="fas fa-edit"></i></a>
							   <a href="eliminar_materiaG.php?u='.$row[ "MAT_CODIGO" ].'&e='.$esta.'" '.$estado.'</a></td></tr>';
					$cont++;
				}
				mysqli_free_result( $desactivos );
			}
			?>
		</tbody>
	</table>
	<table>
	  <tbody>
	    </tbody>
	  </table>
	</div>
	</div>
</div>
<script src="../js/confirmacion.js"></script>
</body>
</html>