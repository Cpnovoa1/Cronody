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
	<div class="cabeza">Modificar Horario</div>
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
			$sSQL_ver="Select * From paralelo p, horarios h Where (p.HOR_CODIGO=h.HOR_CODIGO and h.HOR_ESTADO = 1) AND p.AUL_ESTADO=1 Group by p.AUL_CURSO  Order by p.AUL_CURSO";

			$result_ver=mysqli_query($conn,$sSQL_ver);
			$valor=0;
			?>
			<div class="select"><label>Curso</label>
			<select name="curso" id="idcurso">
			<option value="">Seleccione una opción</option>
			<!--<option value="" selected>Selecciona una opcion</option>-->
			<?php 
			while ($row=mysqli_fetch_array($result_ver)){
				echo '<option value="'.$row["AUL_CURSO"].'">'.$row["AUL_CURSO"].'</option>';
			}
		?> 
		</select></div>
		<div id="idparalelo1" class="select"><label>Paralelo</label><select id='idparal' name='paral'></select></div>
		<div style="display: inline-block; float: right;" id="idagregar"></div>
		</form></div>
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
		$('#idcurso').change(function(){
			$('#idtabla').find('td').remove().end();
			$('#idtabla').find('tr').remove().end();
			
			$("#idcurso option:selected").each(function () {
				curso = $(this).val();
				$.post("desplegarparalelo_mostrar.php", { curso: curso }, function(data){
					$("#idparal").html(data);
				});            
			});
		});

		//Cuando se seleccione un paralelo se desplegará una tabla con el horario respectivo
		$('#idparal').change(function(){
			$('#idtabla').find('td').remove().end();
			$('#idtabla').find('tr').remove().end();
			
			$("#idparal option:selected").each(function () {
				paralelo = $(this).val();
				$.post("desplegarhorario_modificar.php", { paralelo: paralelo }, function(data){
					$("#idtabla").html(data);
				}); 
				$.post("desplegarhorario_agregar_hma.php", { paralelo: paralelo }, function(data){
					$("#idagregar").html(data);
				}); 
			});
		});	
	})	
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/confirmacion.js"></script>
</body>
</html>