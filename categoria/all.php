<?php
// Headers requeridos 
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
 
//Conexion a la BD

//Incluir los archivos de configuracion y vendedor
include_once '../config.php';
include_once '../clases/categoria.php';
 
//Instanciar objeto de DB y conexion
$database = new Database();
$db = $database->getConnection();
 
// Iniciar objeto
$categoria = new Categoria($db);
 
$stmt = $categoria->read();
$num = $stmt->rowCount();
 
// Chequear si hay datos
if($num>0){
 
    // Arreglo de dimensiones
    $categorias_arr=array();
   
    // recibe los registros de las tablas
    // fetch()es mas rapido que fetchAll()
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // Extraer fila
        extract($row);
 
        $categoria_item=array(
            "idcategorias" => $idcategorias,
            "nombre" => $nombre,
            "subcategoria" => $subcategoria,
            "categorias_idcategorias" => $categorias_idcategorias,
            "dimensiones_iddimensiones" => $dimensiones_iddimensiones          
        );
 
        array_push($categorias_arr, $categoria_item);
    }
 
    // Codigo 200 para indicar que fue exitoso
    http_response_code(200);
 
    // Mostrar los datos 
    echo json_encode($categorias_arr);
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
