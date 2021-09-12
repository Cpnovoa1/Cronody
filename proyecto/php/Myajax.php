 <?php
	session_start();

	include('obtener_usuario.php');

	$myIP=getRealIP();
	$auditoria = mysqli_query( $conexion,"INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES ($user,'$myIP','SALIO',curTime(),CURDATE())");


	function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];

		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];

		return $_SERVER['REMOTE_ADDR'];
	}

	//header("Location: ../index.php");
?>   
    