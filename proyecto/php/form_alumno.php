<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/barra_lateral.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
  <h1>Ingreso Docentes</h1>
  <form action="conexion.php" method="post">
    <input type="text" name="doc_codigo" placeholder="Codigo"><br>
    <input type="text" name="usu_codigo" placeholder="Codigo Usuario"><br>
    <input type="text" name="doc_nombre" placeholder="Nombre"><br>
    <input type="text" name="doc_apellido" placeholder="Apellido"><br>
    <input type="text" name="doc_telefono" placeholder="Telefono"><br>
    <input type="text" name="doc_cedula" placeholder="Cedula"><br>
    <input type="date" name="doc_fnacimiento" placeholder="Fecha de Nacimiento"><br>
    <input type="text" name="doc_direccion" placeholder="Direccion Domicilio"><br>
    <input type="number" name="doc_cargahoraria" placeholder="Carga Horaria"><br>
    <input type="number" name="doc_estado" placeholder="Estado"><br>
    <button type="submit" name="enviar">Registrar</button>
  </form>

</body>
</html>
