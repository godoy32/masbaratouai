<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<style>
tr {
    border-bottom: 1px solid lightgray;
}
</style>
<body>
<div data-role="page" id = "inicio">

	<div data-role="header">
		<h1>Mas barato UAI</h1>
	</div><!-- /header -->
	<form>
    <input id="filterTable-input" data-type="search" placeholder="Buscar productos/SKU">
	</form>
	<font size=2>
	<div data-role="main" class="ui-content">
	<table data-role="table" id="movie-table" data-filter="true" data-input="#filterTable-input" class="ui-responsive"  data-mode="columntoggle" data-column-btn-text="Columnas">
      <thead>
	  
        <tr>
          <th data-priority="6">SKU</th>
          <th>Nombre</th>
          <th >Precio</th>
          <th data-priority="1">Lugar</th>
		  <th data-priority= "3">Categoria</th>
          <th data-priority="6">Edificio</th>
        </tr>
      </thead>
	  <tbody>
	  <?php
		$host = 'localhost';
		$user = 'root';
		$pass = '';
		$db = 'masbaratouai';
		mysql_connect($host,$user,$pass);
		mysql_select_db($db);
		$query = 'SELECT * FROM productos P, local L, edificio E, categoria C WHERE C.idCategoria  = P.categoria_idCategoria  AND P.local_idLocal  = L.idLocal AND edificio_idEdificio  = idEdificio ORDER BY precioProducto ASC'; 
		$consulta = mysql_query($query) or die ('Error mysql: '.mysql_error());
		echo '<ul data-role="listview" data-filter="true" data-input="#myFilter" data-autodividers="true" data-inset="true">';
		$c=0;
		while($row = mysql_fetch_object($consulta))
		{
			echo '<tr><td>'.$row -> skuProducto .'</td>
			<td><a href = "#producto'.$row -> idProducto  .'">'.$row -> nombreProducto  .'</a></td>
			<td>$'.$row -> precioProducto  .'</td>
			<td><a href = "#local'.$row-> idLocal .'">'.$row -> seudonimoLocal .'</a></td>
			<td>'.$row -> nombreCategoria .'</td>
			<td>'.$row -> nombreEdificio   .'</td></tr>';
			$idProducto[$c] = $row -> idProducto;
			$idLocal[$c] = $row -> idLocal;
			$c++;
		}
		echo '</ul>';
	  ?>
	
	</table>
	</font>
	</div>

  <div data-role="footer">
    <h1>&copy; 2014 <font size = "1"><i>V0.1</i></font></h1>
  </div>

</div><!-- /page -->
<?php
	echo '<div data-role="page" data-dialog="true" id="enviado">';
			$asunto = 'Se ha detectado error "'.$_POST['motivo'].'" en la ID "'.$_POST['id'];
			if(isset($_POST['text'])) $cuerpo = $_POST['text'];
			else $cuerpo = "";
			$query = 'SELECT emailAdmin FROM admin';
			$consulta4 = mysql_query($query);
			while($mail = mysql_fetch_object($consulta4))
			{
				mail($mail -> emailAdmin,$asunto,$cuerpo);
			}
			echo '<div data-role="header">
			<h1>Error enviado</h1>
			</div>
			<div data-role="main" class="ui-content">
			<p>Se notificaa a un administrador sobre el problema, gracias por colaborar!</p>
			</div>
			<div data-role="footer">
			<h1><a href="#inicio">Atras</a></h1>
			</div>';			
	echo '</div>';


	$sinrepetir = array_unique($idLocal);
	sort($sinrepetir);
	for($i = 0; $i<count($sinrepetir); $i++)
	{
		$q2 = 'SELECT seudonimoLocal, descripcionLocal FROM local WHERE idLocal = '.$sinrepetir[$i];
		$consulta2 = mysql_query($q2) or die ('Error mysql: '.mysql_error());
		while($row2 = mysql_fetch_object($consulta2))
		{
			echo '<div data-role="page" data-dialog="true" id="local'.$sinrepetir[$i].'">
					<div data-role="header">
						<h1>'.$row2 -> seudonimoLocal.'</h1>
					</div>

					<div data-role="main" class="ui-content">
						<p>'.$row2 -> descripcionLocal .'</p>
					</div>
					<div data-role="footer">
						<h1><a href="#inicio">Atras</a></h1>
					</div>
				</div>';
		}
	}
	for($i = 0; $i<count($idLocal); $i++)
	{
		$q3 = 'SELECT * FROM productos P, local L, edificio E, categoria C WHERE C.idCategoria  = P.categoria_idCategoria  AND P.local_idLocal  = L.idLocal AND edificio_idEdificio  = idEdificio AND idProducto = '.$idProducto[$i];
		$consulta3 = mysql_query($q3) or die ('Error mysql: '.mysql_error());
		while($row4 = mysql_fetch_object($consulta3))
		{
			echo '<div data-role="page" data-dialog="true" id="producto'.$idProducto[$i].'">
					<div data-role="header">
						<h1>'.$row4 -> nombreProducto.'</h1>
					</div>

					<div data-role="main" class="ui-content">
						<p>Precio: $'.$row4 -> precioProducto .'<br>
							SKU: '.$row4-> skuProducto .'<br>
							Local: '.$row4 -> nombreLocal .' ('.$row4 -> seudonimoLocal .')<br>
							Categoria: '.$row4 -> nombreCategoria .'<br>
							Imagen:<br><center><img src="'.$row4 -> imgProducto.'" style="width:214px;height:214px" ><br>
							<a href = "#error'.$row4 -> idProducto .'">Reportar un error</a></center>
							
					</div>
					<div data-role="footer">
						<h1><a href="#inicio">Atras</a></h1>
					</div>
				</div>';
			echo '<div data-role="page" data-dialog="true" id="error'.$idProducto[$i].'">
					<div data-role="header">
						<h1>Error en: '.$row4 -> nombreProducto.'</h1>
					</div>

					<div data-role="main" class="ui-content">
						<p>
						<form action = "#enviado" method = "POST" id = "form" data-ajax = "false">
						<select name="motivo">
						<option value = "precio">Precio erroneo</option>
						<option value = "sku">Numero SKU erroneo</option>
						<option value = "nombre">Nombre erroneo</option>
						<option value = "lugar">Lugar erroneo</option>
						<option value = "imagen">Imagen erronea</option>
						<option value = "otro">Otro</option>
						</select>
						<textarea name = "text" form = "form"></textarea>
						<input type = "hidden" name = "id" value = "'.$idProducto[$i].'">
						<input type = "submit" value = "Enviar">
						</form>
						</p>
							
					</div>
					<div data-role="footer">
						<h1><a href="#inicio">Atras</a></h1>
					</div>
				</div>';
		}
	}
?>

</body>
</html>