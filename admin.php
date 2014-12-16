<!DOCTYPE html>
<?php
echo '<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>';
session_start();
$server = "localhost";
$user = "root";
$pass = "";
$db = "masbaratouai";
mysql_connect($server,$user,$pass);
mysql_select_db($db);
if(!isset($_SESSION['admin']) && !isset($_POST['user']))
{
	echo '<form action = "admin.php" method = "POST">
	Nombre usuario: <input type = "text" name = "user"><br>
	Password: <input type = "password" name = "pass"><br>
	<input type = "submit" value = "Ingresar"></form>';
}
if(!isset($_SESSION['admin']) && isset($_POST['user']))
{
	$q = 'SELECT * FROM admin WHERE nombreAdmin  = "'.$_POST['user'].'" AND passAdmin  = "'.$_POST['pass'].'"';
	$query = mysql_query($q) or die ('Error mysql: '.mysql_error());
	if(mysql_num_rows($query) > 0)
	{
		$_SESSION['admin'] = $_POST['user'];
		echo 'Logeado correctamente';
	}
	else
	{
		echo 'Usuario o contrasena incorrecto';
		echo '<form action = "admin.php" method = "POST">
		Nombre usuario: <input type = "text" name = "user"><br>
		Password: <input type = "password" name = "pass"><br>
		<input type = "submit" value = "Ingresar"></form>';
	}
}
if(isset($_SESSION['admin']))
{
?>
	<div data-role="page" id="admin">
		<div data-role="header">
			<h1>Super admin</h1>
		</div>
		<div data-role="main" class="ui-content">
			<h2>Producto:</h2>
		<ul data-role="listview">
			<li><a href="#aprod">Agregar producto</a></li>
			<li><a href="#mprod">Modificar producto</a></li>
			<li><a href="#eprod">Eliminar producto</a></li>
		</ul>
			<h2>Lugares:</h2>
		<ul data-role="listview">
			<li><a href="#alug">Agregar lugar</a></li>
			<li><a href="#mlug">Modificar lugar</a></li>
			<li><a href="#elug">Eliminar lugar</a></li>
		</ul>
		</div>
	</div> 
<?php
}

?>