<?php

    session_start();

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
<title>Admin</title>
</head>

<body>
	<h1>ADMINISTRADOR</h1>
</body>
</html>