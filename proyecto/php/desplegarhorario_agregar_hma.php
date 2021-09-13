<?php 
$conn = new mysqli("localhost", "admin", "admin", "horarios");
if ($conn ->connect_error) {
	die("Connection failed: " . $conn ->connect_error);
}
$paralelo=$_POST['paralelo'];
	
$hor;
$sql="Select * From paralelo Where AUL_CODIGO = '$paralelo' AND AUL_ESTADO=1";
$result1=mysqli_query($conn,$sql);
while($row1=mysqli_fetch_array($result1)){
	if($row1["AUL_CODIGO"] == $paralelo){
		$nivel = $row1["NIV_CODIGO"];
		$hor = $row1["HOR_CODIGO"];
	}
}

horario($hor, $paralelo, $nivel, $conn);

function horario($horar, $paralelo, $nivel, $conn){

	$cadena = '<a href="agregar_horario_materia.php?h='.$horar.'&p='.$paralelo.'&n='.$nivel.'" id="idcrear" ><button type="button">Agregar</button></a>';
	
	echo $cadena;

}
?>