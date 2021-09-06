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
	<div class="cabeza">Horarios</div>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "Select * From horarios_materias o, horarios h, dias d, materias m, paralelo p Where o.HOR_CODIGO = h.HOR_CODIGO and o.DIA_CODIGO = D.DIA_CODIGO and o.MAT_CODIGO = m.MAT_CODIGO and p.HOR_CODIGO = h.HOR_CODIGO");

	
	
	$activos = mysqli_query( $conn, "select * from materias m, docente d, nivel n where m.doc_codigo=d.doc_codigo and m.niv_codigo=n.niv_codigo and m.mat_estado=1" );
	$desactivos = mysqli_query( $conn, "select * from materias m, docente d, nivel n where m.doc_codigo=d.doc_codigo and m.niv_codigo=n.niv_codigo and m.mat_estado=0" );
	$materiasq = mysqli_query($conn, "select *, count(case MAT_ESTADO when '1' then 1 else null end and case d.DOC_ESTADO when '1' then 1 else null end) docentes, sum(m.MAT_ESTADO) estado from materias m, docente d, nivel n where (m.doc_codigo=d.doc_codigo or m.doc_codigo is null) and m.niv_codigo=n.niv_codigo group by m.MAT_NOMBRE, m.NIV_CODIGO order by mat_nombre");
	?>
	<div class="cuerpo">
	<div class="opciones">
		<div class="bloque"><form id="form1" name="form1" method="post" action="#">
			<label class="filtro" for="select">Filtro de horarios</label>
			<select name="estado" class="filtro">
				<option value="Todos" selected>Todos</option>
			</select>
			<input type="submit" value="Aceptar">
			<a href="../impresion/final/index.php"><input type="button" value="Imprimir"></a>
		</form></div>
	</div>
	<div class="cont-tabla">
	<table>
		<thead>
			<tr>
				<th>N°</th>
				<th>Curso</th>
				<th>Materia</th>
				<th>Día</th>
				<th>Hora Inicio - Final</th>
				<th>Estado</th>
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
					echo '<tr><td>' . $cont . '</td>';
					if($row['HOR_ESTADO']=='1' && $row['AUL_ESTADO']=='1'){$curso = $row[ "AUL_CURSO" ]. ' "'.  $row[ "AUL_NOMBRE" ] .'" ';}
					else {$curso = "Sin horario";}
					echo '<td>' . $curso . '</td>';
					if($row['MAT_ESTADO']=='1'){$mat = $row['MAT_NOMBRE'];}
					else {$mat = "Ninguno";}
					echo '<td>' .$mat. '</td>';
					echo '<td>' .$row['DIA_NOMBRE']. '</td>';
					if($row['HMA_ESTADO']=='1'){$doc = $row[ "HMA_HORAINICIO" ] . ' - ' . $row[ "HMA_HORAFIN" ];}
					else {$doc = "Ninguno";}	
					echo '<td>' .$doc. '</td>';
					if($row['HMA_ESTADO']=='1'){$est = 'Activo';}
					else {$est = "Inactivo";}	
					echo '<td>' .$est. '</td></tr>';
					
					$cont++;
				}
				mysqli_free_result( $result );
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