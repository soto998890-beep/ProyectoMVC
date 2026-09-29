<?php
header("Content-Type: application/json");

require_once '../config/database.php';
require_once '../models/Producto.php';

$database = new Database();
$db = $database->conectar();
$producto = new Producto($db);
$metodo = $_SERVER['REQUEST_METHOD'];
switch($metodo){
  case "GET":
    $stmt = $producto->listar();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($productos);
  break;

  case "POST":
    $datos = json_decode(file_get_contents("php://input"));
    $producto->nombre = $datos->nombre;
    $producto->descripcion = $datos->descripcion;
    $producto->precio = $datos->precio;
    $producto->stock = $datos->stock;
    if($producto->crear()){
      echo json_encode([
        "mensaje"=>"Producto creado"
      ]);
    }
  break;

  case "PUT":
    $datos=json_decode(
      file_get_contents("php://input")
    );
    $producto->id=$datos->id;
    $producto->nombre=$datos->nombre;
    $producto->descripcion=$datos->descripcion;
    $producto->precio=$datos->precio;
    $producto->stock=$datos->stock;
    if($producto->actualizarAPI()){
      echo json_encode([
        "mensaje"=>"Producto actualizado"
      ]);
    }
  break;

  case "DELETE":
    $datos=json_decode(
      file_get_contents("php://input")
    );
    $producto->id=$datos->id;
    if($producto->eliminarAPI()){
      echo json_encode([
        "mensaje"=>"Producto eliminado"
      ]);
    }
  break;
}
?>