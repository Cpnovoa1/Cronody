<?php

    session_start();

	if(isset($_GET['cerrar_sesion'])){
        session_unset(); 

        // destroy the session 
        session_destroy(); 
    }

    if(!isset($_SESSION['rol'])){
        header('location: ../index.php');
    }else{
        if($_SESSION['rol'] != 2){
            header('location: ../index.php');
        }
    }

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Supervisor</title>
<link href="../css/estilocrearhorario.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
<div class="contenedor">
	<div class="cabeza">Crear Horario</div>
	<div class="cuerpo">
		<form id="form1" name="form1" method="post" action="#">
		<div class="opciones-1">
			<?php

			//Conexion con la base
			$conn = new mysqli("localhost", "admin", "admin", "horarios");
			if ($conn ->connect_error) {
				die("Connection failed: " . $conn ->connect_error);
			}
			$sSQL_ver="Select * From paralelo Where HOR_CODIGO is null AND AUL_ESTADO=1 Group by AUL_CURSO  Order by AUL_CURSO";

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
		</div>
		<div class="opciones-2">
			<div class="cont-seleccion">
				<div id="idarea1" class="select"><label>Área</label><select id='idarea' name='area'></select></div>
				<div id="idmateria1" class="select"><label>Materia</label><select id='idmateria' name='materia'></select></div> 
				<label>Docentes disponibles</label>
				<div id="iddocente" class="cont-drop"></div> 
				<!--<div id="iddocente1" class="select"><label>Docentes disponibles</label><select id='iddocente' name='docente'></select></div> -->
			</div>
			<div class="cont-horario">
				<div class="titulo">Horario</div>
				<div class="subtitulo"><i class="far fa-question-circle"></i> Arrastre al docente hacia la casilla del horario que desee para agregar a dicho procesor y materia al horario</div>
				<table class="tabla-horario">
				<thead>
					<tr>
						<th>Hora</th>
						<th>Lunes</th>
						<th>Martes</th>
						<th>Miercoles</th>
						<th>Jueves</th>
						<th>Viernes</th>
					</tr>
				</thead>
				<tbody id="idtabla">
					
					</tbody>
				</table>
			</div>
		</div>
		<div class="guardar">
			<button type="submit" value="Aceptar" disabled>Guardar</button>
		</div>
		</form>
	</div>
</div>
<script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous">
</script>

<script type="text/javascript">
	$(document).ready(function(){
		//$('#idcurso').val('');
			//recargarLista("#idcurso","#idparalelo","curso=","desplegarparalelo.php");
			
		$('#idcurso').change(function(){
			$('#idarea').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
			$('#idmateria').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
			$('#iddocente').find('div').remove().end();
			$('#idtabla').find('td').remove().end();
			$('#idtabla').find('tr').remove().end();
			
			$("#idcurso option:selected").each(function () {
				curso = $(this).val();
				$.post("desplegarparalelo.php", { curso: curso }, function(data){
					$("#idparal").html(data);
				});            
			});
		});

		//$('#idparal').val('');
			//recargarLista("#idparal","#idarea","paralelo=","desplegararea.php");
		$('#idparal').change(function(){
			$('#idarea').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
			$('#idmateria').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
			$('#iddocente').find('div').remove().end();
			$('#idtabla').find('td').remove().end();
			$('#idtabla').find('tr').remove().end();
			
			$("#idparal option:selected").each(function () {
				paralelo = $(this).val();
				$.post("desplegararea.php", { paralelo: paralelo }, function(data){
					$("#idarea").html(data);
				}); 
				$.post("desplegarhorario.php", { paralelo: paralelo }, function(data){
					$("#idtabla").html(data);
				}); 
			});
		});	
		
		$('#idarea').change(function(){
			$('#idmateria').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
			$('#iddocente').find('div').remove().end();
			
			$("#idarea option:selected").each(function () {
				materia = $(this).val();
				$.post("desplegarmaterias.php", { materia: materia }, function(data){
					$("#idmateria").html(data);
				});            
			});
		});
		
		
		$('#idmateria').change(function(){
			$("#idmateria option:selected").each(function () {
				docente = $(this).val();
				$.post("desplegardocentesdrag.php", { docente: docente}, function(data){
					$("#iddocente").html(data);
				});            
			});
		});
	})
</script>
</body>

</html>