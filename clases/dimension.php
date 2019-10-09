<?php
class Dimension{
 
    // Conexion a la base de datos
    private $conn;
    private $table_name = "dimensiones";
 
    // Campos de la clase
    public $iddimensiones;
    public $nombre;
    public $descripcion;
    public $rutaimagen;
    public $sit_fichastecnicas_idsit_fichatecnica;
     
    // Constructor de la conexion a la bd
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
 
        // Query para leer todo
        $query = "SELECT  *  FROM  " . $this->table_name . " ";
     
        // Prepara sentencia query
        $stmt = $this->conn->prepare($query);
     
        // Ejecutar Query
        $stmt->execute();
     
        return $stmt;
    }
    // Crear cliente
    function create(){

        // Query para insertar un vendedor
        $query = "INSERT INTO  " . $this->table_name . "  SET 
                    iddimensiones=:iddimensiones,
                    nombre=:nombre, 
                    descripcion=:descripcion, 
                    rutaimagen=:rutaimagen, 
                    sit_fichastecnicas_idsit_fichatecnica=:sit_fichastecnicas_idsit_fichatecnica"; 
                 
        // Preparar query (sentencia)
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->iddimensiones=htmlspecialchars(strip_tags($this->iddimensiones));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->rutaimagen=htmlspecialchars(strip_tags($this->rutaimagen));  
        $this->sit_fichastecnicas_idsit_fichatecnica=htmlspecialchars(strip_tags($this->sit_fichastecnicas_idsit_fichatecnica));
        
        // Bind valores
        $stmt->bindParam(":iddimensiones", $this->iddimensiones);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":rutaimagen", $this->rutaimagen); 
        $stmt->bindParam(":sit_fichastecnicas_idsit_fichatecnica", $this->sit_fichastecnicas_idsit_fichatecnica);
  
        //  Ejecutar query
        if($stmt->execute()){
            return true;
        } 
        return false;
        
    }
// Funcion para leer un solo registro
function readOne(){
 
    // Query para leer uno solo
    $query = "SELECT  *  FROM  " . $this->table_name . "  WHERE iddimensiones = ?  LIMIT  0,1";
 
    // Preparar sentencia
    $stmt = $this->conn->prepare( $query ); 
    $stmt->bindParam(1, $this->iddimensiones);
 
    // Ejecutar query
    $stmt->execute();
 
    // Recibir datos de la consulta y guardarlos en una variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // Setear valores a las propiedades del objeto
    $this->iddimensiones = $row['iddimensiones'];
    $this->nombre = $row['nombre'];
    $this->descripcion = $row['descripcion'];
    $this->rutaimagen = $row['rutaimagen'];
    $this->sit_fichastecnicas_idsit_fichatecnica = $row['sit_fichastecnicas_idsit_fichatecnica'];
 }

function update(){
 
    // Query de actualizar
    $query = "UPDATE " . $this->table_name . "  SET
                iddimensiones = :iddimensiones,
                nombre = :nombre,
                descripcion = :descripcion,
                rutaimagen = :rutaimagen,
                sit_fichastecnicas_idsit_fichatecnica = :sit_fichastecnicas_idsit_fichatecnica
               WHERE  iddimensiones = :iddimensiones";
 
    // Preparar Query (sentencia)
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->iddimensiones=htmlspecialchars(strip_tags($this->iddimensiones));
    $this->nombre=htmlspecialchars(strip_tags($this->nombre));
    $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
    $this->rutaimagen=htmlspecialchars(strip_tags($this->rutaimagen));
    $this->sit_fichastecnicas_idsit_fichatecnica=htmlspecialchars(strip_tags($this->sit_fichastecnicas_idsit_fichatecnica));
        
    // Bind nuevos valores
    $stmt->bindParam(':iddimensiones', $this->iddimensiones);
    $stmt->bindParam(':nombre', $this->nombre);
    $stmt->bindParam(':descripcion', $this->descripcion);
    $stmt->bindParam(':rutaimagen', $this->rutaimagen);
    $stmt->bindParam(':sit_fichastecnicas_idsit_fichatecnica', $this->sit_fichastecnicas_idsit_fichatecnica);
   
    // Ejecutar query
    if($stmt->execute()){
        return true;
    } 
    return false;
}

function delete(){
 
    // Query de borrar
    $query = "DELETE FROM " . $this->table_name . " WHERE iddimensiones = ?";
 
    // Preparar query
    $stmt = $this->conn->prepare($query);    
    
    // sanitize
    $this->iddimensiones=htmlspecialchars(strip_tags($this->iddimensiones));
 
    // Bind para borrar
    $stmt->bindParam(1, $this->iddimensiones);
 
    // Ejecutar query
    if($stmt->execute()){
        return true;
    }
     
    return false;
     
}
}
?>