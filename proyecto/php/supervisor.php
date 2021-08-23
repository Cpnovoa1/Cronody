<?php

    session_start();

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
</head>

<body>
	<h1>SUPERVISOR</h1>
</body>
</html>