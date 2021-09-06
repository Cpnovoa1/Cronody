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
        if($_SESSION['rol'] != 1){
            header('location: ../index.php');
        }
    }

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Materias</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link href="../css/estiloMostrar.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="contenedor2">
	<div class="cabeza">Asignar Materias</div>
	<div class="cuerpo2">
		<form id="form1" name="form1" method="post" action="asignarmaterias-guardar.php">
		<div class="cont-tabla">
			<?php

			//Conexion con la base
			$conn = new mysqli("localhost", "admin", "admin", "horarios");
			if ($conn ->connect_error) {
				die("Connection failed: " . $conn ->connect_error);
			}
			$sSQL_ver="Select * From docente Where DOC_ESTADO=1 Order by DOC_NOMBRE";

			$result_ver=mysqli_query($conn,$sSQL_ver);
			$valor=0;
			?>
			<div class="row formulario__grupo" id="grupo__docente"><p><label for="docente" class="formulario__label">Docente</label></p>
			<select name="docente" id="iddocente">
			<!--<option value="" selected>Selecciona una opcion</option>-->
			<?php 
			while ($row=mysqli_fetch_array($result_ver)){
				echo '<option value="'.$row["DOC_CODIGO"].'">'.$row["DOC_NOMBRE"].' '.$row["DOC_APELLIDO"].'</option>';
			}
		?> 
		</select></div>
			<div class="row formulario__grupo" id="grupo__nivel"><p><label for="nivel" class="formulario__label">Nivel</label></p>
				<select id='idnivel' name='nivel' class="formulario__input">
					<option value="">Seleccione un nivel</option>
				<?php
				$sSQLniv="Select * From nivel n, materias m Where n.NIV_CODIGO=m.NIV_CODIGO and n.NIV_ESTADO=1 group by m.NIV_CODIGO Order by NIV_NOMBRE";

				$resultniv=mysqli_query($conn,$sSQLniv);
				
				while ($row=mysqli_fetch_array($resultniv)){
					echo '<option value="'.$row["NIV_CODIGO"].'">'.$row["NIV_NOMBRE"].' '.$row["NIV_SUBNIVEL"].'</option>';
				}
				?>			
			</select></div>
			<div class="row formulario__grupo" id="grupo__area"><p><label for="area" class="formulario__label">Área</label></p><select id='idarea' name='area' class="formulario__input"></select></div>
			<div class="row formulario__grupo" id="grupo__mat"><p><label for="mat" class="formulario__label">Materia</label></p><select id='idmat' name='mat' class="formulario__input"></select></div>
		</div>
		<div class="opciones">
			<input type="submit" value="Guardar">
			<a href="javascript:window.history.go(-1);" id="idcancelar"><button type="button" value="cancelar">Cancelar</button></a>
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
			
		$('#idnivel').change(function(){
			$('#idarea').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
			$('#idmat').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
			
			$("#idnivel option:selected").each(function () {
				nivel = $(this).val();
				$.post("asignarmateria-areas.php", { nivel: nivel }, function(data){
					$("#idarea").html(data);
				});            
			});
		});

		
		$('#idarea').change(function(){
			$('#idmat').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
			
			$("#idarea option:selected").each(function () {
				materia = $(this).val();
				$.post("asignarmaterias-materia.php", { materia: materia }, function(data){
					$("#idmat").html(data);
				});            
			});
		});
		
	})
</script>
</body>

</html>