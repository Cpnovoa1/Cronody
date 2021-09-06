<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link href="../css/estiloMostrar.css" rel="stylesheet" type="text/css">
</head>

<body>

	<div class="cabeza">Auditoria</div>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "SELECT * FROM `auditoria`" );
	
	
	?>
	<div class="cuerpo">
	<table>
		<thead>
			<tr>
				<th>Codigo</th>
				<th>Codigo de Usuario</th>
				<th>IP</th>
				<th>Accion</th>
				<th>Hora</th>
				<th>Fecha</th>
			</tr>
		</thead>
		<tbody>

			<?php
			//Mostramos los registros
			$arrayDatos2 = array();				
			$contador = 0;
			$valor2 = array();
			$valor_id = array();
			

			if ( $result) {

				//////////////////////////////////////////////////////////////////
				while ( $row = mysqli_fetch_array( $result ) ) {

					$valor_id[] = $row;
					$aux =  $valor_id[$contador][1];
					$aux2 = "SELECT `USU_USER` FROM `usuario` WHERE `USU_CODIGO` = $aux";
					$resultado2 = mysqli_query($conn,$aux2);	
					while ( $row2 = mysqli_fetch_array( $resultado2 ) ) {
						$arrayDatos2[] = $row2;
					}
					
					echo '<tr><td>' . $row[ "AUD_ID" ] . '</td>';
					echo '<td>' . $arrayDatos2[$contador][0]. '</td>';
					echo '<td>' . $row[ "AUD_IP" ] . '</td>';
					echo '<td>' . $row[ "AUD_EVENTO" ] . '</td>';
					echo '<td>' . $row[ "AUD_HORA" ] . '</td>';
					echo '<td>' . $row[ "AUD_FECHA" ] . '</td></tr>';
					
					$contador = $contador + 1;
				}
				
				//var_dump($arrayDatos2);
				mysqli_free_result( $result );

			} 
			
			?>
		</tbody>
	</table>
	</div>
</body>
</html>