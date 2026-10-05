<?php

require_once '../config/database.php';
require_once '../controllers/ProductoController.php';

$database = new Database();
$db = $database->conectar();
$controller = new ProductoController($db);
$modelo = new Producto($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $accion = $_POST['accion'] ?? '';
  if ($accion === 'crear') {
    $controller->store($_POST);
    header('Location: index.php?msg=Producto+creado');
    exit;
  }
  if ($accion === 'editar') {
    $controller->update($_POST);
    header('Location: index.php?msg=Producto+actualizado');
    exit;
  }
  if ($accion === 'eliminar') {
    $controller->delete($_POST['id']);
    header('Location: index.php?msg=Producto+eliminado');
    exit;
  }
}

$vista = $_GET['vista'] ?? 'listar';
$mensaje = $_GET['msg'] ?? '';

if ($vista === 'crear') {
  require_once '../views/productos/crear.php';
} elseif ($vista === 'editar') {
  $producto = $modelo->obtener($_GET['id'] ?? 0);
  if (!$producto) {
    header('Location: index.php');
    exit;
  }
  require_once '../views/productos/editar.php';
} else {
  $productos = $controller->index();
  require_once '../views/productos/index.php';
}