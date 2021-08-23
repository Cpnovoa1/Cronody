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
        if($_SESSION['rol'] != 3){
            header('location: ../index.php');
        }
    }

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Docente</title>
</head>

<body>
	<h1>DOCENTE</h1>
</body>
</html>