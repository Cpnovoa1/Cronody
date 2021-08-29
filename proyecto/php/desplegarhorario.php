<?php 
$conexion=mysqli_connect('localhost','admin','admin','horarios');
$paralelo=$_POST['paralelo'];
		
	$sql="Select * From paralelo Where AUL_CODIGO = '$paralelo' AND AUL_ESTADO=1";
	$result=mysqli_query($conexion,$sql);
	while($row=mysqli_fetch_array($result)){
		if($row["AUL_CODIGO"] == $paralelo){$nivel = $row["NIV_CODIGO"];}
	}

	switch($nivel){
		case '7':
			llenarInicial();
			break;
		case '1':
		case '2':
		case '3':
			llenarBasica_BGU();
			break;
		case '4':
		case '5':
		case '6':
			llenarBasica_BGU();
			break;			
	}
		
	function llenarInicial(){
		$horaInicial="07:15";
		$minutoAnadir=15;
		$nuevaHora = sumarHora($horaInicial,$minutoAnadir);
		$ver = 3;
		$cadena="";
		while ($ver!=0) {
			$cadena=$cadena.'<tr><td>'.$horaInicial.' A '.$nuevaHora.'</td><td></td><td></td><td></td><td></td><td></td></tr>';
			$horaInicial = $nuevaHora;
			$minutoAnadir = 270;
			if($ver == 2){$minutoAnadir = 35;}
			$nuevaHora = sumarHora($horaInicial,$minutoAnadir);
			$ver--;
		}
		echo  $cadena;
	}

	function llenarBasica_BGU(){
		$horaInicial="07:15";
		$minutoAnadir=40;
		$minutoReceso=20;
		$ver = 9;
		$cadena="";
		while ($ver!=0) {
			if($ver == 3 || $ver == 6){
				$nuevaHora = sumarHora($horaInicial,$minutoReceso);
				$cadena=$cadena.'<tr><td>'.$horaInicial.' A '.$nuevaHora.'</td><td colspan="5" class="colspan">RECESO</td></tr>';
				$horaInicial = $nuevaHora;
			} else {
				$nuevaHora = sumarHora($horaInicial,$minutoAnadir);
				$cadena=$cadena.'<tr><td>'.$horaInicial.' A '.$nuevaHora.'</td><td></td><td></td><td></td><td></td><td></td></tr>';
				$horaInicial = $nuevaHora;
			}
			$ver--;
		}
		echo  $cadena;
	}
		
	function sumarHora($horaInicial,$minutoAnadir){
		$segundos_horaInicial=strtotime($horaInicial);
		$segundos_minutoAnadir=$minutoAnadir*60;
		$nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
		return $nuevaHora;
	}
	
	

?>