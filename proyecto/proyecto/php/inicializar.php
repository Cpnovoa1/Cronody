<?php
session_start();

$horario = array();

$_SESSION['hor'] = $horario;

header("Location: crear_horario.php");

?>