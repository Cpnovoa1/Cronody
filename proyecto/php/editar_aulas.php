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
	<div class="cabeza">Aulas</div>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "Select * From paralelo p, horarios h, nivel n where (p.HOR_CODIGO=h.HOR_CODIGO or p.hor_codigo is null) and p.NIV_CODIGO=n.NIV_CODIGO order by p.aul_curso" );
	$activos = mysqli_query( $conn, "Select * From paralelo p, horarios h, nivel n where (p.HOR_CODIGO=h.HOR_CODIGO or p.hor_codigo is null) and p.NIV_CODIGO=n.NIV_CODIGO and p.AUL_ESTADO=1 order by p.aul_curso" );
	$desactivos = mysqli_query( $conn, "Select * From paralelo p, horarios h, nivel n where (p.HOR_CODIGO=h.HOR_CODIGO or p.hor_codigo is null) and p.NIV_CODIGO=n.NIV_CODIGO and p.AUL_ESTADO=0 order by p.aul_curso" );
	?>
	<div class="cuerpo">
	<div class="opciones">
		<div class="bloque margen-top">
			<a href="#" id="idcrear" ><button type="button">Agregar Nuevo</button></a>
			<a href="#" id="idcrear" ><button type="button">Agregar Nivel</button></a>
		</div>
		<div class="bloque"><form id="form1" name="form1" method="post" action="#">
			<label class="filtro" for="select">Filtro aulas</label>
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
				<th>Curso</th>
				<th>Paralelo</th>
				<th>Nivel</th>
				<th>Año Lectivo</th>
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
					echo '<td>' . $row[ "AUL_CURSO" ] . '</td>';
					echo '<td>"' . $row[ "AUL_NOMBRE" ] . '"</td>';
					if($row['NIV_ESTADO']=='1'){$niv = ucfirst(mb_strtolower($row[ "NIV_NOMBRE" ], 'UTF-8')). ' ' .ucfirst(mb_strtolower($row[ "NIV_SUBNIVEL" ], 'UTF-8'));}
					else {$niv = "Ninguno";}
					echo '<td>' .$niv. '</td>';
					if(is_null($row[1])){$hor = "Ninguno";}
					else {$hor = $row['HOR_ALECTIVO'];}
					echo '<td>' .$hor. '</td>';
					if($row['AUL_ESTADO']=='1'){$estado = 'title="Eliminar" class="tabla-registro-elim btn-eliminar-a"><i class="fas fa-trash"></i>'; $est = "Activo";}
					else {$estado = 'title="Activar" class="btn-eliminar-i"><i class="fas fa-trash-restore"></i>'; $est = "Inactivo";}
					echo '<td> <a href="editar_aulas_recibe.php?u='.$row[ "AUL_CODIGO" ].'" title="Editar" class="btn-editar"><i class="fas fa-edit"></i></a>
							   <a href="eliminar_aulas.php?u='.$row[ "AUL_CODIGO" ].'" '.$estado.'</a></td></tr>';
					$cont++;
				}
				mysqli_free_result( $result );

			} else if ( $estado == 'Activos' ) {
				$cont = 1;
				while ( $row = mysqli_fetch_array( $activos ) ) {
					echo '<tr><td>' .$cont. '</td>';
					echo '<td>' . $row[ "AUL_CURSO" ] . '</td>';
					echo '<td>"' . $row[ "AUL_NOMBRE" ] . '"</td>';
					if($row['NIV_ESTADO']=='1'){$niv = ucfirst(mb_strtolower($row[ "NIV_NOMBRE" ], 'UTF-8')). ' ' .ucfirst(mb_strtolower($row[ "NIV_SUBNIVEL" ], 'UTF-8'));}
					else {$niv = "Ninguno";}
					echo '<td>' .$niv. '</td>';
					if(is_null($row[1])){$hor = "Ninguno";}
					else {$hor = $row['HOR_ALECTIVO'];}
					echo '<td>' .$hor. '</td>';
					echo '<td> <a href="editar_aulas_recibe.php?u='.$row[ "AUL_CODIGO" ].'" title="Editar" class="btn-editar"><i class="fas fa-edit"></i></a>
							   <a href="eliminar_aulas.php?u='.$row[ "AUL_CODIGO" ].'" title="Eliminar" class="tabla-registro-elim  btn-eliminar-a"><i class="fas fa-trash"></i></a></td></tr>';
					$cont++;
				}
				mysqli_free_result( $activos );

			} else if ( $estado == 'Desactivados' ) {
				$cont = 1;
				while ( $row = mysqli_fetch_array( $desactivos ) ) {
					echo '<tr><td>' .$cont. '</td>';
					echo '<td>' . $row[ "AUL_CURSO" ] . '</td>';
					echo '<td>"' . $row[ "AUL_NOMBRE" ] . '"</td>';
					if($row['NIV_ESTADO']=='1'){$niv = ucfirst(mb_strtolower($row[ "NIV_NOMBRE" ], 'UTF-8')). ' ' .ucfirst(mb_strtolower($row[ "NIV_SUBNIVEL" ], 'UTF-8'));}
					else {$niv = "Ninguno";}
					echo '<td>' .$niv. '</td>';
					if(is_null($row[1])){$hor = "Ninguno";}
					else {$hor = $row['HOR_ALECTIVO'];}
					echo '<td>' .$hor. '</td>';
					echo '<td> <a href="editar_aulas_recibe.php?u='.$row[ "AUL_CODIGO" ].'" title="Editar" class="btn-editar"><i class="fas fa-edit"></i></a>
							   <a href="eliminar_aulas.php?u='.$row[ "AUL_CODIGO" ].'" title="Activar"  class="btn-eliminar-i"><i class="fas fa-trash-restore"></i></a></td></tr>';
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