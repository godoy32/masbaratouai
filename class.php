<?php
class Local
{
	public $seudonimo;
	public $nombre;
	public $ubicacion;
	public $edificio;
	
	function __construct($seudonimo,$nombre,$ubicacion,$edificio)
	{
		$this -> seudonimo = $seudonimo;
		$this -> nombre = $nombre;
		$this -> ubicacion = $ubicacion;
		$this -> edificio = $edificio;
	}
	
	function AgregarLocal(Local $local)
	{
		$query = 'INSERT INTO local (seudonimoLocal,nombreLocal,ubicacionLocal ,edificio_idEdificio) VALUES ("'.$local -> seudonimo.'", "'.$local -> nombre .'", "'.$local -> ubicacion.'", '.$local ->edificio .')';
		mysql_query($query) or die ('Error mysql: '.mysql_error());
	}
	
	function BorrarLocal($id)
	{
		$query = 'DELETE FROM local WHERE idLocal = '.$id;
		mysql_query($query) or die ('Error mysql: '.mysql_error());
	}
	
	function ModificarLocal(Local $local,$id)
	{
		$query = 'UPDATE local SET
		seudonimoLocal  = "'.$local -> seudonimo .'",
		nombreLocal  = "'.$local -> nombre .'",
		ubicacionLocal = "'.$local -> ubicacion .'",
		edificio_idEdificio  = '.$local -> edificio .'
		WHERE idLocal = '.$id;
		mysql_query($query) or die ('Error mysql: '.mysql_error());
	}
}

class Producto
{
	public $nombreProducto ;
	public $precioProducto ;
	public $skuProducto ;
	public $local_idLocal ;
	public $categoria_idCategoria ;
	public $imgProducto;
	
	function __construct($nombreProducto,$precioProducto,$skuProducto,$local_idLocal,$categoria_idCategoria,$imgProducto)
	{
		$this -> nombreProducto = $nombreProducto;
		$this -> precioProducto = $precioProducto;
		$this -> skuProducto = $skuProducto;
		$this -> local_idLocal = $local_idLocal;
		$this -> categoria_idCategoria = $categoria_idCategoria;
		$this -> imgProducto = $imgProducto;
	}
	
	function AgregarProducto(Producto $producto)
	{
		$query = 'INSERT INTO productos (nombreProducto,precioProducto,skuProducto ,local_idLocal,categoria_idCategoria, imgProducto)
		VALUES 	("'.$producto -> nombreProducto.'", '.$producto -> precioProducto .', '.$producto -> skuProducto.', '.$producto ->local_idLocal .','.$producto ->categoria_idCategoria .',"'.$producto -> imgProducto .'")';
		mysql_query($query) or die ('Error mysql: '.mysql_error());
	}
	
	function BorrarProducto($id)
	{
		$query = 'DELETE FROM productos WHERE idProducto  = '.$id;
		mysql_query($query) or die ('Error mysql: '.mysql_error());
	}
	
	function ModificarLocal(Local $local,$id)
	{
		$query = 'UPDATE productos SET
		nombreProducto  = "'.$producto -> nombreProducto .'",
		precioProducto  = "'.$producto -> precioProducto .'",
		skuProducto = "'.$producto -> skuProducto .'",
		categoria_idCategoria  = '.$producto -> categoria_idCategoria .'
		imgProducto = '.$producto -> imgProducto .'
		WHERE idProducto = '.$id;
		mysql_query($query) or die ('Error mysql: '.mysql_error());
	}
}