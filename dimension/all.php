<?php
// Headers requeridos 
/* header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: x-requested-with, Content-Type, origin, authorization, accept, client-security-token"); */

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
 
//Conexion a la BD

//Incluir los archivos de configuracion y vendedor
include_once '../config.php';
include_once '../clases/dimension.php';
 
//Instanciar objeto de DB y conexion
$database = new Database();
$db = $database->getConnection();
 
// Iniciar objeto
$dimension = new Dimension($db);
 
$stmt = $dimension->read();
$num = $stmt->rowCount();
 
// Chequear si hay datos
if($num>0){
 
    // Arreglo de dimensiones
    $dimensiones_arr=array();
   
    // recibe los registros de las tablas
    // fetch()es mas rapido que fetchAll()
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // Extraer fila
        extract($row);
 
        $dimension_item=array(
            "iddimensiones" => $iddimensiones,
            "nombre" => $nombre,
            "descripcion" => $descripcion,
            "rutaimagen" => $rutaimagen,
            "sit_fichastecnicas_idsit_fichatecnica" => $sit_fichastecnicas_idsit_fichatecnica          
        );
 
        array_push($dimensiones_arr, $dimension_item);
    }
 
    // Codigo 200 para indicar que fue exitoso
    http_response_code(200);
 
    // Mostrar los datos 
    echo json_encode($dimensiones_arr);
}

else{
 
    // Codigo respuesta de error
    http_response_code(404);
 
    // Mensaje de que no se encontro nada
    echo json_encode(
        array("message" => "No fueron encontradas dimensiones")
    );
}

?>
