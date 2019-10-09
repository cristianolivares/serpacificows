<?php
// Headers requeridos 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
//Conexion a la BD

//Incluir los archivos de configuracion y vendedor
include_once '../config.php';
include_once '../clases/indicador.php';
 
//Instanciar objeto de DB y conexion
$database = new Database();
$db = $database->getConnection();
 
// Iniciar objeto
$indicador = new Indicador($db);
 
$stmt = $indicador->read();
$num = $stmt->rowCount();
 
// Chequear si hay datos
if($num>0){
 
    // Arreglo de dimensiones
    $indicadores_arr=array();
   
    // recibe los registros de las tablas
    // fetch()es mas rapido que fetchAll()
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // Extraer fila
        extract($row);
 
        $indicador_item=array(
            "idindicadores" => $idindicadores,
            "nombre" => $nombre,
            "periodicidad" => $periodicidad,
            "tipo_valor" => $tipo_valor,
            "nivel" => $nivel,
            "fuentes_idfuentes" => $fuentes_idfuentes,
            "unidad_idunidad" => $unidad_idunidad,
            "indicadores_idindicadores" => $indicadores_idindicadores,
            "categorias_idcategorias" => $categorias_idcategorias          
        );
 
        array_push($indicadores_arr, $indicador_item);
    }
 
    // Codigo 200 para indicar que fue exitoso
    http_response_code(200);
 
    // Mostrar los datos 
    echo json_encode($indicadores_arr);
}

else{
 
    // Codigo respuesta de error
    http_response_code(404);
 
    // Mensaje de que no se encontro nada
    echo json_encode(
        array("message" => "No fueron encontrados indicadores")
    );
}

?>
