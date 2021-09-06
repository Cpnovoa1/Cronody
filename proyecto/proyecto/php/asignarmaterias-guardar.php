<?php 
$conn = new mysqli("localhost", "admin", "admin", "horarios");
if ($conn ->connect_error) {
	die("Connection failed: " . $conn ->connect_error);
}
$doc = $_POST['docente'];    //recoger los datos del formulario enviado por POST - del arreglo POST seleccionamos el dato
$area = $_POST['area'];
$nivel = $_POST['nivel'];
$mat = $_POST['mat'];
	
$vacio = false;
$horas = "";
$repetido=false;

if($doc=="" || $area=="" || $area=="" || $nivel==""){
	$vacio = true;
} else{
	$sql="Select * from materias Where MAT_CODIGO = '$mat'";

	$result=mysqli_query($conn,$sql);

	while($row = mysqli_fetch_array($result)){
		$horas = $row['MAT_CARGAHORARIA'];
		$materia = $row['MAT_NOMBRE'];
		$a = $row['MAT_AREA'];
	}
}

if(!$vacio){
	$sql3="Select * from materias";

	$result3=mysqli_query($conn,$sql3);

	while($row3 = mysqli_fetch_array($result3)){
		if($row3['MAT_AREA'] == $a && $row3['MAT_NOMBRE']==$materia && $row3['NIV_CODIGO']==$nivel && $row3['DOC_CODIGO'] == $doc){
			$repetido = true;
		}
	}

	
	if(!$repetido){
		$query = "INSERT INTO materias(DOC_CODIGO, MAT_NOMBRE, MAT_AREA, MAT_CARGAHORARIA, NIV_CODIGO) VALUES ('$doc','$materia','$a','$horas','$nivel')";
		$resultado = mysqli_query($conn,$query);
		if($resultado){
		echo '<script>
				alert("Los datos se han guardado correctamente");
				window.location="editar_materia.php";
			</script>';
		} else{
			echo '<script>
				alert("Hubo un error al guardar");
				window.history.go(-1);
			</script>';
		}
	}else {
		echo '<script>
			alert("El registro ya existe");
			window.history.go(-1);
		</script>';
	}
} else{
	echo '<script>
			alert("Complete todos los campos");
			window.history.go(-1);
		</script>';
}


	

?>