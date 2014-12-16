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
	echo '<form action = "admin.php" method = "POST" data-ajax = "false">
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
		<?php
		if(isset($_SESSION['msg']) && $_SESSION['msg'] != "")
		{
			echo $_SESSION['msg'];
			$_SESSION['msg'] = "";
			unset($_SESSION['msg']);
		}
		?>
		<div data-role="main" class="ui-content">
			<h2>Producto:</h2>
		<ul data-role="listview">
			<li><a href="#aprod">Agregar producto</a></li>
			<li><a href="#mprod">Modificar producto</a></li>
			<li><a href="#eprod">Eliminar producto</a></li>
		</ul>
			<h2>Locales:</h2>
		<ul data-role="listview">
			<li><a href="#alug">Agregar Local</a></li>
			<li><a href="#mlug">Modificar Local</a></li>
			<li><a href="#elug">Eliminar Local</a></li>
		</ul>
		</div>
	</div> 
	<style>
	tr {
		border-bottom: 1px solid lightgray;
	}
</style>
	<div data-role = "page" id = "mprod">
		<div data-role="header">
			<h1>Modificar producto</h1>
		</div>
		<div data-role="main" class="ui-content">
			Mostrando productos:
		<form>
		<input id="filterTable-input" data-type="search" placeholder="Buscar productos/SKU">
		</form>
		<?php
		
		$productos = 'SELECT * FROM productos P, local L, edificio E, categoria C WHERE C.idCategoria  = P.categoria_idCategoria  AND P.local_idLocal  = L.idLocal AND edificio_idEdificio  = idEdificio ORDER BY precioProducto ASC';
		$qprod = mysql_query($productos) or die ('Error mysql: '.mysql_error());
		echo '<table data-role="table" id="movie-table" data-filter="true" data-input="#filterTable-input" class="ui-responsive"  data-mode="columntoggle" data-column-btn-text="Columnas">
		  <thead>
		  
			<tr>
			  <th data-priority="6">SKU</th>
			  <th>Nombre</th>
			  <th >Precio</th>
			  <th data-priority="1">Lugar</th>
			  <th data-priority= "3">Categoria</th>
			  <th data-priority="6">Edificio</th>
			  <th>Accion</th>
			</tr>
		  </thead>
		  <tbody>';
		echo '<ul data-role="listview" data-filter="true" data-input="#myFilter" data-autodividers="true" data-inset="true">';
		$c = 0;
		while($prod = mysql_fetch_object($qprod))
		{
			$idProducto[$c] = $prod -> idProducto;
			$c++;
			echo '<tr><td>'.$prod -> skuProducto .'</td>
			<td>'.$prod -> nombreProducto  .'</td>
			<td>$'.$prod -> precioProducto  .'</td>
			<td>'.$prod -> seudonimoLocal .'</a></td>
			<td>'.$prod -> nombreCategoria .'</td>
			<td>'.$prod -> nombreEdificio   .'</td>
			<td><div data-role="navbar" data-iconpos="right"><ul><li><a href = "#editar'.$prod -> idProducto .'" data-icon = "edit">Editar</a></li></ul></div></tr>';
		}
		echo '</table>';
		
		?>
		</div>
	</div>
	<?php
	$sinrepetir = array_unique($idProducto);
	sort($sinrepetir);
	for($i = 0; $i<count($sinrepetir); $i++)
	{
		$q2 = 'SELECT * FROM local, categoria, productos WHERE idProducto = '.$sinrepetir[$i].' AND idCategoria = categoria_idCategoria AND local_idLocal = idLocal';
		$consulta2 = mysql_query($q2) or die ('Error mysql: '.mysql_error());
		while($row2 = mysql_fetch_object($consulta2))
		{
			echo '<div data-role="page" id="editar'.$sinrepetir[$i].'">
				<div data-role = "header">
					<h1>Modificar producto: '.$row2 -> nombreProducto .'</h1>
				</div>
			<div data-role="main" class="ui-content">
			<form action = "editarp.php" method = "post" data-ajax = "false">
			Nombre: <input type = "text" value = "'.$row2 -> nombreProducto .'"><br>
			Precio: <input type = "number" value ="'.$row2 -> precioProducto .'"><br>
			Sku: <input type = "number" value = "'.$row2 -> skuProducto .'"><br></form>';
		}
	}
	?>
			
	</div>
	</div>
	
	
	<div data-role="page" id="aprod">
		<div data-role = "header">
			<h1>Agregar producto</h1>
		</div>
	<div data-role="main" class="ui-content">
		<form action = "agregarprod.php" method = "POST" data-ajax = "false">
		Nombre producto: <input type = "text" name = "nombre" required><br>
		Precio: <input type = "number" name = "precio" required><br>
		SKU: <input type = "number" name = "sku"><br>
		<?php
		$locales = 'SELECT idLocal, nombreLocal, seudonimoLocal FROM local';
		$qlocal = mysql_query($locales) or die ('Mysql error: '.mysql_error());
		echo 'Local: <select name = "local">';
		while($local = mysql_fetch_object($qlocal))
		{
			echo '<option value = "'.$local -> idLocal .'">'.$local -> nombreLocal .' ('.$local -> seudonimoLocal .')</option>';
		}
		echo '</select>';
		$categorias = 'SELECT idCategoria, nombreCategoria FROM categoria';
		$qcat = mysql_query($categorias) or die ('Error mysql: '.mysql_error());
		echo 'Categoria: <select name = "cat">';
		while($cat = mysql_fetch_object($qcat))
		{
			echo '<option value = "'.$cat -> idCategoria .'">'.$cat -> nombreCategoria .'</option>';
		}
		echo '</select>
		URL imagen: <input type = "text" name = "url">
		<input type = "submit" value = "Enviar"></form>';
		?>
	</div>
	

<?php
}

?>