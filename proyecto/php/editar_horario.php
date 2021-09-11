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
	<div class="cabeza">Eliminar horarios</div>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "Select * From paralelo p, horarios h, nivel n, supervisor s where (HOR_ESTADO=1) and h.HOR_CODIGO=p.HOR_CODIGO group by h.HOR_CODIGO" );
	
	
	?>
	<div class="cuerpo">
	<div class="opciones">
		<div class="bloque margen-top">
			
		</div>
		
	</div>
	<div class="cont-tabla">
	<table>
		<thead>
			<tr>
				<th>N</th>
				<th>Curso Actual</th>
				<th>Creado por</th>
				<th>Año alectivo</th>
				<th>Estado</th>
				
				<th>Eliminar</th>
				
				
			</tr>
		</thead>
		<tbody>

			<?php
			//Mostramos los registros
			$estado = 'Todos';
			
			if ( $estado == 'Todos' ||  $estado == '') {
				$cont = 1;
				while ( $row = mysqli_fetch_array( $result ) ) {
					echo '<tr><td>' .$cont. '</td>';
					echo '<td>' . $row[ "AUL_CURSO" ] .'"' .$row[ "AUL_NOMBRE" ].'"'.'</td>';
					echo '<td>' . $row[ "SUP_NOMBRE" ] . ' ' . $row[ "SUP_APELLIDO" ] .'</td>';
					echo '<td>' . $row[ "HOR_ALECTIVO" ] . '</td>';
					
					if($row['HOR_ESTADO']=='1'){$estado = 'title="Eliminar" class="tabla-registro-elim btn-eliminar-a"><i class="fas fa-trash"></i>'; $est = "Activo";}
					
					echo '<td>' .$est. '</td>';
					echo '<td> 
							   <a href="eliminar_horario.php?u='.$row[ "HOR_CODIGO" ].'" '.$estado.'</a></td></tr>';
					$cont++;
				}
				mysqli_free_result( $result );

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