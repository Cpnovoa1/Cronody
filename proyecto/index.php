<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Cronody - Login</title>
<link href="css/estiloIndex.css" rel="stylesheet" type="text/css">
<link href="css/estiloformindex.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link rel="shortcut icon" href="img/logo_login_icono.svg">
</head>
<?php
	
	include_once 'php/conexion.php';
	session_start();
	
	if(isset($_GET['cerrar_sesion'])){
        session_unset(); 

        // destroy the session 
        session_destroy(); 
    }
    
    if(isset($_SESSION['rol'])){
        switch($_SESSION['rol']){
            case 1:
				header('location: php/admin.php');
			break;

			case 2:
				header('location: php/supervisor.php');
			break;

			case 3:
				header('location: php/docente.php');
			break;

			case 4:
				header('location: php/alumno.php');
			break;

            default:
        }
    }
	
	$validar = true;

    if(isset($_POST['usuario']) && isset($_POST['password'])){
        $username = $_POST['usuario'];
        $password = $_POST['password'];
			
        $db = new Database();
        $query = $db->connect()->prepare("SELECT * FROM usuario WHERE USU_USER = :username");
        $query->execute(['username' => $username]);

        $row = $query->fetch(PDO::FETCH_NUM);
        $validar = true;
        if(($row == true) && (password_verify($password,$row[3]))){
			
            $rol = $row[1];
            $usu = $row[0];
			
			$myIP=getRealIP();
			
			$auditoria =$db->connect()->prepare("INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES ($usu,'$myIP','ENTRO',curTime(),CURDATE())");
			$auditoria->execute();
			
            $_SESSION['rol'] = $rol;
			$_SESSION['user'] = $usu;
            switch($rol){
                case 1:
                    header('location: php/admin.php');
                break;

                case 2:
                	header('location: php/supervisor.php');
                break;
				
				case 3:
                	header('location: php/docente.php');
                break;
				
				case 4:
                	header('location: php/alumno.php');
                break;

                default:
            }
        }else{
            // no existe el usuario
            $validar = false;
        }
        

    }
	
	
		
	function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];

		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];


	return $_SERVER['REMOTE_ADDR'];
	}	
	
?>
<body>
	<div class="contenedor-logo">
		<img src="img/logo_login.svg" alt="logo" width="60%">
	</div>
	<div class="contenedor centrar">
		<form id="form1" name="form1" method="post" action="#">
		  <h1 class="titulo">Iniciar Sesión</h1>
		  <?php
			if(!$validar){
				?><p class="error margin-bottom"><i class="fas fa-times fa-fw"></i> El nombre de usuario o contraseña es incorrecto</p><?php
			}
		  ?>
		  <div><span class="icono-form" for="usuario"><i class="fas fa-user fa-fw"></i></span>
		  <input type="text" name="usuario" id="idusuario" placeholder="Usuario" required></div>
		  
		  <div><span class="icono-form" for="password"><i class="fas fa-key fa-fw"></i></span>
          <input type="password" name="password" id="idgpassword" placeholder="Contraseña" required></div>
          
		  <div class="margin-top">
		    <button type="submit" name="submit" id="idsubmit" value="Iniciar sesión"><i class="fas fa-sign-in-alt fa-fw"></i>&nbsp;&nbsp;Ingresar</button>
			<button type="reset" name="reset" id="idreset" value="limpiar"><i class="fas fa-times-circle fa-fw"></i></button>
		  </div>
		</form>
	</div>
</body>
</html>
