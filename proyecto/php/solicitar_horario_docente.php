<?php

 session_start();

if(!isset($_SESSION['rol'])){
	header('location: ../index.php');
}else{
	if($_SESSION['rol'] != 3){
		header('location: ../index.php');
	}
}

include('obtener_usuario.php');

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link href="../css/estilocrearhorario.css" rel="stylesheet" type="text/css">
	<link href="../css/estiloMostrar_horario.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
<div class="contenedor">
	<div class="cabeza">Horarios</div>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "Select * From horarios_materias o, horarios h, dias d, materias m, paralelo p Where o.HOR_CODIGO = h.HOR_CODIGO and o.DIA_CODIGO = D.DIA_CODIGO and o.MAT_CODIGO = m.MAT_CODIGO and p.HOR_CODIGO = h.HOR_CODIGO");
	?>
	<div class="cuerpo">
	<div class="opciones">
		<div class="bloque"><form id="form1" name="form1" method="post" action="#">
			<?php

			//Conexion con la base
			$conn = new mysqli("localhost", "admin", "admin", "horarios");
			if ($conn ->connect_error) {
				die("Connection failed: " . $conn ->connect_error);
			}
			$sSQL_ver="Select n.NIV_CODIGO, n.NIV_NOMBRE, n.NIV_SUBNIVEL From paralelo p, materias m, docente d, nivel n, horarios h, horarios_materias o where m.DOC_CODIGO = d.DOC_CODIGO and m.NIV_CODIGO = n.NIV_CODIGO and n.NIV_ESTADO = 1 and m.MAT_ESTADO = 1 and d.DOC_ESTADO = 1 and d.DOC_CODIGO = '$codigo' and (o.MAT_CODIGO = m.MAT_CODIGO and o.HMA_ESTADO = 1) and (o.HOR_CODIGO = h.HOR_CODIGO and h.HOR_ESTADO = 1) group by n.NIV_NOMBRE order by n.NIV_CODIGO";

			$result_ver=mysqli_query($conn,$sSQL_ver);
			$valor=0;
			?>
			<div class="select"><label>Nivel</label>
			<select name="nivel" id="idnivel">
			<option value="">Seleccione una opción</option>
			<!--<option value="" selected>Selecciona una opcion</option>-->
			<?php 
			while ($row=mysqli_fetch_array($result_ver)){
				echo '<option value="'.$row["NIV_CODIGO"].'">'.$row["NIV_NOMBRE"].' '.$row["NIV_SUBNIVEL"].'</option>';
			}
		?> 
		</select></div></div>
		<div class="imprimir"><a href="../impresion/final/index_docente.php"><input type="button" value="Imprimir"></a></div>
	</div>
	<div class="cont-tabla" id="idtabla">
		</tbody>
	</table>
	</div>
	</div>
</div>
<script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous">
</script>
<script>
$(document).ready(function(){
	//Cuando se seleccione un curso se mostrarán los paralelos que tengan asignado un horario
	$('#idnivel').change(function(){
		$('#idtabla').find('td').remove().end();
		$('#idtabla').find('tr').remove().end();

		$("#idnivel option:selected").each(function () {
			nivel = $(this).val();
			docente = "<?php echo $codigo; ?>";
			$.post("desplegarhorario_mostrar_docente.php", { nivel: nivel, docente:docente }, function(data){
				$("#idtabla").html(data);
			});            
		});
	});
})	
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>