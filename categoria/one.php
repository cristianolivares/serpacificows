<?php
// Headers requeridos
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// Incluir archivos de configuracion
include_once '../config.php';
include_once '../clases/categoria.php';
 
// Establecer conexion a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// Preparar objeto dimension
$categoria = new Categoria($db);
 
// Setear ID al cod_vend (recibe de la peticion)
$categoria->idcategorias = isset($_GET['id']) ? $_GET['id'] : die();
 
// Leer los detalles de una sola dimension
$categoria->readOne();
 
if($categoria->nombre!=null){
    // Crear arreglo
    $categoria_arr = array(
        "idcategorias" =>  $categoria->idcategorias,
        "nombre" => $categoria->nombre,
        "subcategoria" => $categoria->subcategoria,
        "categorias_idcategorias" => $categoria->categorias_idcategorias,
        "dimensiones_iddimensiones" => $categoria->dimensiones_iddimensiones
    );
 
    // Codigo de respuesta del servidor
    http_response_code(200);
 
    // Convertir arreglo en JSON e imprimirlo
    echo json_encode($categoria_arr);
}
 
else{
    // Codigo de respuesta del servidor
    http_response_code(404);
 
    //Imprimir mensaje
    echo json_encode(array("message" => "La categoria no existe"));
}
?>