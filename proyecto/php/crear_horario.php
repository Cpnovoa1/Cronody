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
			$sSQL_ver="Select * From paralelo p, horarios h Where (p.HOR_CODIGO=h.HOR_CODIGO and h.HOR_ESTADO = 0) or p.HOR_CODIGO is null  AND p.AUL_ESTADO=1 Group by p.AUL_CURSO  Order by p.AUL_CURSO";

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
		<div class="opciones">
			<a href="guardar_horario.php"><input type="button" value="Guardar"></a>
			<a href="super_bienvenidoprincipal.php" id="idcancelar"><button type="button" value="cancelar">Cancelar</button></a>
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
	//Ojito aca inicia.
	
	
	crearmovimiento();
            function crearmovimiento() {
                var dragged;
                var copia;
                var idmateria;
				var iddocente;
				var tipo;
				var icon;
				var materia;
				var docenten;
                /* events fired on the draggable target */
                document.addEventListener("drag", function (event) {

                }, false);

                document.addEventListener("dragstart", function (event) {
                    // store a ref. on the dragged elem
                    dragged = event.target;
                    // make it half transparent
                    event.target.style.opacity = .5;

                    idmateria = event.target.getAttribute("idmateria");
					iddocente = event.target.getAttribute("iddocente");
					
					tipo = event.target.getAttribute("tipo");
					icon = event.target.getAttribute("icono");
					materia = event.target.getAttribute("materia");
					docenten = event.target.getAttribute("docente");

                    //copia = "<div>"  + dragged.innerHTML + "</div>";
					
					copia = '<div class="cont-elem '+tipo+'"><div class="elem-icono"><i class="'+icon+' fa-2x"></i></div>'+
							'<div class="elem-box"><div class="box-docen">'+ materia +'</div><div class="box-info">'+ docenten +'</div></div></div>';

                    event.dataTransfer.setData('Text', copia);

                }, false);

                document.addEventListener("dragend", function (event) {
                    // reset the transparency
                    event.target.style.opacity = "";
                }, false);

                /* events fired on the drop targets */
                document.addEventListener("dragover", function (event) {
                    // prevent default to allow drop
                    event.preventDefault();
                }, false);

                document.addEventListener("dragenter", function (event) {
                    // highlight potential drop target when the draggable element enters it
                    if (event.target.className == "dropzone") {
                        
                    }

                }, false);

                document.addEventListener("dragleave", function (event) {
                    // reset background of potential drop target when the draggable element leaves it
                    if (event.target.className == "dropzone") {
						
                    } 

                }, false);

                document.addEventListener("drop", function (event) {
                    // prevent default action (open as link for some elements)
                    event.preventDefault();
                    // move dragged elem to the selected drop target
					
                    if (event.target.className == "dropzone") {
                        
                        
                        //event.target.innerHTML = event.dataTransfer.getData("Text");
                        //ojo aca puede que sea
						
						var horaIni = event.target.getAttribute("idhoraIni");
						var horaFin = event.target.getAttribute("idhoraFin");
						var dia = event.target.getAttribute("iddia");
						var aula = document.getElementById("idparal").value;
						<?php 
						$user = $_SESSION['user']; 
						$sup = "";
						$sql="Select * From supervisor Where USU_CODIGO = '$user'";
						$result=mysqli_query($conn,$sql);
						while ($ver=mysqli_fetch_row($result)) {
							$sup = $ver[0];
						}
						if(!$result){$sup = 9;}
						?>
						var anioLectivo = anio();
						//var materia = event.getAttribute("idmateria");
						var materia1 = idmateria;
						//var docente = event.getAttribute("iddocente");
						var docente1 = iddocente;
						var supervisor = <?php echo $sup;?>;
                        event.target.style.height = "auto";
						//docnete no guardar porque la materia ya especifica que docente es
						//alert("HOra ini" +horaIni + "\n"+ "Hora fin" + horaFin + "\n DIa"+ dia + "\n MAteria" + materia1 + "\n Docente"+ docente1 + "\n Aula" + aula + "\n Supervisor" + supervisor + "\n Año" + anioLectivo);
						//window.location = "recibehorario.php?horaIni=" + horaIni + "&horaFin=" + horaFin + "&dia=" + dia + "&materia=" + materia;
						var recibio = "";
						var variable = 0;
						
						jQuery.extend({
							getValues: function(url) {
								var result = null;
								$.ajax(
									{
										url: url,
										type: 'get',
										async: false,
										success: function(data){
											result = data;
										}
									}
								);
								return result;
							}		
						});
							
						recibio = $.getValues('recibeDatos.php?doc='+docente1+'&sup='+ supervisor+'&anio='+anioLectivo+'&materia='+materia1+'&aula='+aula+'&dia='+dia+'&horini='+horaIni+'&horfin='+horaFin+'');
						
						if(recibio == '1'){
							event.target.innerHTML = event.dataTransfer.getData("Text");
							$("#idmateria option:selected").each(function () {
								docente = $(this).val();
								$.post("desplegardocentesdrag.php", { docente: docente}, function(data){
									$("#iddocente").html(data);
								});            
							});
						} else if(recibio == '0'){
							alert("No se pudo colocar la materia");
						} else if(recibio == '2'){
							alert("El docente ya no está disponible");
						} else if(recibio == '3'){
							alert("Ya se cumplió el total de horas pedagógicas de esta materia");
						} else if(recibio == '4'){
							alert("El docente ya imparte una materia en ese dia a esa hora");
						} else if(recibio == '5'){
							alert("No puede colocar más de 2 horas por día de una misma materia");
						}
						
                    }
					

                }, true);
            }
	
			function anio(){
				var fecha = new Date();
				if(fecha.getMonth()+1 >= 9){
					return (fecha.getFullYear()+"-"+(fecha.getFullYear()+1));
				} else {
					return ((fecha.getFullYear()-1)+"-"+fecha.getFullYear());
				}
			}
	
	//Ojito Aca termina.
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
	//OJO aca comienza el dropzone.
	
	//Ojo aca termina el dropzone.
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>