<?php
// Headers requeridos
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// Incluir archivos de configuracion
include_once '../config.php';
include_once '../clases/dimension.php';
 
// Establecer conexion a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// Preparar objeto dimension
$dimension = new Dimension($db);
 
// Setear ID al cod_vend (recibe de la peticion)
$dimension->iddimensiones = isset($_GET['id']) ? $_GET['id'] : die();
 
// Leer los detalles de una sola dimension
$dimension->readOne();
 
if($dimension->nombre!=null){
    // Crear arreglo
    $dimension_arr = array(
        "iddimensiones" =>  $dimension->iddimensiones,
        "nombre" => $dimension->nombre,
        "descripcion" => $dimension->descripcion,
        "rutaimagen" => $dimension->rutaimagen,
        "sit_fichastecnicas_idsit_fichatecnica" => $dimension->sit_fichastecnicas_idsit_fichatecnica
    );
 
    // Codigo de respuesta del servidor
    http_response_code(200);
 
    // Convertir arreglo en JSON e imprimirlo
    echo json_encode($dimension_arr);
}
 
else{
    // Codigo de respuesta del servidor
    http_response_code(404);
 
    //Imprimir mensaje
    echo json_encode(array("message" => "La dimensión no existe"));
}
?>