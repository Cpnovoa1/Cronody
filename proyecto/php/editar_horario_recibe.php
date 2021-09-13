<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link href="../css/estiloMostrar.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
<div class="contenedor2">
	<div class="cabeza">Modificar Horario</div>
	<?php
	$conn = new mysqli("localhost", "admin", "admin", "horarios");
	if ($conn ->connect_error) {
		die("Connection failed: " . $conn ->connect_error);
	}
	$id = $_GET['u'];
	$hor = $_GET['h'];
	$par = $_GET['p'];
	$niv = $_GET['n'];
	?>
	<div class="cuerpo2">
	<form name="form1" id="form1" method="post" action="editar_horario_actualizar.php">
	<div class="cont-tabla">
		<input type="text" name="id" value="<?php echo $id; ?>" hidden>
		<input type="text" name="horario" value="<?php echo $hor; ?>" hidden>
		<div class="row formulario__grupo" id="grupo__area"><p><label for="area" class="formulario__label">Área</label></p><select id='idarea' name='area' class="formulario__input">
			<?php
			$buscar = mysqli_query($conn, "Select * From horarios_materias h, materias m Where m.MAT_CODIGO = h.MAT_CODIGO AND h.HMA_CODIGO = '$id'");
			while($row=mysqli_fetch_row($buscar)) {
				$area = $row[10];
			}
			
			$sql="Select * From materias Where NIV_CODIGO = '$niv' AND MAT_ESTADO=1 Group by MAT_AREA  Order by MAT_AREA";
			$result=mysqli_query($conn,$sql);

			echo "<option value=''>Seleccione un área</option>";

			while ($ver=mysqli_fetch_row($result)) {
				if($area == $ver[3]){echo '<option value="'.$ver[0].'" selected>'.$ver[3].'</option>';}
				else {echo '<option value="'.$ver[0].'">'.$ver[3].'</option>';}
			}
			?>
			</select></div>
		<div class="row formulario__grupo" id="grupo__mat"><p><label for="mat" class="formulario__label">Materia</label></p><select id='idmat' name='mat' class="formulario__input">
			<?php
			
			$buscar = mysqli_query($conn, "Select * From horarios_materias h, materias m Where m.MAT_CODIGO = h.MAT_CODIGO AND h.HMA_CODIGO = '$id'");
			while($row=mysqli_fetch_row($buscar)) {
				$area = $row[10];
				$materia = $row[7];
				$mate = $row[9];
			}

			$sql1="Select * From materias Where MAT_CODIGO = '$materia' AND MAT_ESTADO=1";
			$result1=mysqli_query($conn,$sql1);
			while($row=mysqli_fetch_array($result1)){
				if($row["MAT_CODIGO"] == $materia){
					$nivel = $row["NIV_CODIGO"];
					$mat = $row["MAT_AREA"];
				}
			}

			$sql="Select * From materias Where MAT_AREA = '$area' AND NIV_CODIGO = '$niv' AND MAT_ESTADO=1 Group by MAT_AREA, MAT_NOMBRE  Order by MAT_NOMBRE";

			$result=mysqli_query($conn,$sql);

			echo "<option value=''>Seleccione una materia</option>";

			while ($ver=mysqli_fetch_row($result)) {
				if($mate == $ver[2]){echo '<option value="'.$ver[0].'" selected>'.$ver[2].'</option>';}
				else {echo '<option value="'.$ver[0].'">'.$ver[2].'</option>';}
			}
			
			?>
			</select></div>
		<div class="row formulario__grupo" id="grupo__doc"><p><label for="doc" class="formulario__label">Docentes disponibles</label></p><select id='iddocente' name='doc' class="formulario__input">
			<?php
			
			$buscar = mysqli_query($conn, "Select * From horarios_materias h, materias m, docente d Where m.MAT_CODIGO = h.MAT_CODIGO AND d.DOC_CODIGO = m.DOC_CODIGO AND h.HMA_CODIGO = '$id'");
			while($row=mysqli_fetch_row($buscar)) {
				$doc = $row[8];
			}

			$sql="Select * From docente Where DOC_CODIGO = 
					Any (Select DOC_CODIGO From materias Where NIV_CODIGO 
					IN (Select NIV_CODIGO From materias Where MAT_CODIGO = '$materia') AND MAT_NOMBRE 
					IN (Select MAT_NOMBRE From materias Where MAT_CODIGO = '$materia')) AND DOC_ESTADO = 1";

			$result=mysqli_query($conn,$sql);

			echo "<option value=''>Seleccione un docente</option>";

			while ($ver=mysqli_fetch_row($result)) {
				if($doc == $ver[0]){echo '<option value="'.$ver[0].'" selected>'.$ver[2].' '.$ver[3].'</option>';}
				else {echo '<option value="'.$ver[0].'">'.$ver[2].' '.$ver[3].'</option>';}
			}
			
			?>
		</select></div>
		<div class="row formulario__grupo" id="grupo__dia"><p><label for="dia" class="formulario__label">Día</label></p><select id='iddia' name='dia' class="formulario__input">
			<?php
			
			$buscar = mysqli_query($conn, "Select * From horarios_materias h, materias m, docente d Where m.MAT_CODIGO = h.MAT_CODIGO AND d.DOC_CODIGO = m.DOC_CODIGO AND h.HMA_CODIGO = '$id'");
			while($row=mysqli_fetch_row($buscar)) {
				$dia = $row[3];
			}

			$sql="Select * From dias Where DIA_ESTADO = 1";

			$result=mysqli_query($conn,$sql);

			echo "<option value=''>Seleccione un día</option>";

			while ($ver=mysqli_fetch_row($result)) {
				if($dia == $ver[0]){echo '<option value="'.$ver[0].'" selected>'.$ver[1].'</option>';}
				else {echo '<option value="'.$ver[0].'">'.$ver[1].'</option>';}
			}
			
			?>
			</select></div>
		<div class="row formulario__grupo" id="grupo__hora"><p><label for="hora" class="formulario__label">Hora</label></p><select id='idhora' name='hora' class="formulario__input">
			<?php
			
			$buscar = mysqli_query($conn, "Select * From horarios_materias h, materias m, docente d Where m.MAT_CODIGO = h.MAT_CODIGO AND d.DOC_CODIGO = m.DOC_CODIGO AND h.HMA_CODIGO = '$id'");
			while($row=mysqli_fetch_row($buscar)) {
				$dia = $row[3];
			}

			$sql="Select * From horarios_materias Where HMA_CODIGO = '$id' Group by HMA_HORAINICIO, HMA_HORAFIN order by HMA_HORAINICIO";
			$result=mysqli_query($conn,$sql);
			while ($ver=mysqli_fetch_row($result)) {
				$horas = $ver[4].' - '.$ver[5];
			}

			echo "<option value=''>Seleccione un hora</option>";
			
			$array = array("07:15:00 - 07:55:00", "07:55:00 - 08:35:00", "08:35:00 - 09:15:00", "09:35:00 - 10:15:00", "10:15:00 - 10:55:00", "10:55:00 - 11:15:00", "11:15:00 - 11:55:00", "11:55:00 - 12:35:00");
			
			$array2 = array("07:15:00 - 07:30:00", "07:30:00 - 12:00:00", "12:00:00 - 12:35:00");
			
			switch($niv){
				case '1':
				case '2':
				case '3':
				case '4':
				case '5':
				case '6':
					foreach ($array as $a) {
						if($horas == $a){echo '<option value="'.$a.'" selected>'.$a.'</option>';}
						else {echo '<option value="'.$a.'">'.$a.'</option>';}
					}
					break;
				case '7':
					foreach ($array2 as $a) {
						if($horas == $a){echo '<option value="'.$a.'" selected>'.$a.'</option>';}
						else {echo '<option value="'.$a.'">'.$a.'</option>';}
					}
					break;
			}
			
			?>
			</select></div>
	</div>
	<div class="opciones">
		<input type="submit" value="Actualizar">
		<a href="modificarHorairo.php" id="idcancelar"><button type="button" value="cancelar">Cancelar</button></a>
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

	$('#idarea').change(function(){
		$('#idmat').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
		$('#iddocente').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

		$("#idarea option:selected").each(function () {
			materia = $(this).val();
			id = "<?php echo $id; ?>";
			$.post("desplegar_editar_materias.php", { materia: materia, id: id }, function(data){
				$("#idmat").html(data);
			});            
		});
	});

	$('#idmat').change(function(){
		$("#idmat option:selected").each(function () {
			docente = $(this).val();
			id = "<?php echo $id; ?>";
			$.post("desplegar_editar_docentes.php", { docente: docente, id: id}, function(data){
				$("#iddocente").html(data);
			});            
		});
	});
})
</script>
</body>
</html>