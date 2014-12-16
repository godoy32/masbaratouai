<?php
session_start();
$server = "localhost";
$user = "root";
$pass = "";
$db = "masbaratouai";
mysql_connect($server,$user,$pass);
mysql_select_db($db);
include 'class.php';
if(!isset($_POST['sku'])) $_POST['sku'] = '00000';
if(!isset($_POST['url'])) $_POST['url'] = "";
$prod = new Producto($_POST['nombre'],$_POST['precio'],$_POST['sku'],$_POST['local'],$_POST['cat'],$_POST['url']);
$prod -> AgregarProducto($prod);
$_SESSION['msg'] = 'Se ha agregado correctamente';
header('Location: admin.php');


?>