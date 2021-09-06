<?php
  include_once 'conexion.php';

  $codigo = $_POST['doc_codigo'];
  $usucodi = $_POST['usu_codigo'];
  $nombre = $_POST['doc_nombre'];
  $apellido = $_POST['doc_apellido'];
  $telefono = $_POST['doc_telefono'];
  $cedula = $_POST['doc_cedula'];
  $fnacimiento = $_POST['doc_fnacimiento'];
  $direccion = $_POST['doc_direccion'];
  $cargahoraria = $_POST['doc_cargahoraria'];
  $estado = $_POST['doc_estado'];


  $sql = "INSERT INTO docente(doc_codigo,usu_codigo,doc_nombre,doc_apellido,doc_telefono,doc_cedula,doc_fnacimiento
  ,doc_direccion,doc_cargahoraria,doc_estado)VALUES('$codigo','$usucodi','$nombre','$apellido','$telefono',
  '$cedula','$fnacimiento','$direccion','$cargahoraria','$estado')";
  mysqli_query($connection, $sql);

  header("Location: ../admin.php?registro=succes");
?>
