<?php
//guardar mail en base de datos mysql
$correo= htmlspecialchars($_POST["email"]);
// Primero comprobamos que ningún campo esté vacío y que todos los campos existan.
// Si entramos es que todo se ha realizado correctamente
$link = mysql_connect("localhost","m2000364_mail","nu68SEkizi");
if (!$link) {
 die("No se logró conexión con la base de datos: " . mysql_error());
 }
mysql_select_db("m2000364_mail",$link);
// Con esta sentencia SQL insertaremos los datos en la base de datos
mysql_query("INSERT INTO email (mail) VALUES ('$correo')",$link);
//cierro conexion
mysql_close($link);
//muestro mensaje de ok
echo "Gracias por enviarnos tu correo";


?>