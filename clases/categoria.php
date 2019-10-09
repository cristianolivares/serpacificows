<?php
class Categoria{
 
    // Conexion a la base de datos
    private $conn;
    private $table_name = "categorias";
 
    // Campos de la clase
    public $idcategorias;
    public $nombre;
    public $subcategoria;
    public $categorias_idcategorias;
    public $dimensiones_iddimensiones;
     
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
                    idcategorias=:idcategorias,
                    nombre=:nombre, 
                    subcategoria=:subcategoria, 
                    categorias_idcategorias=:categorias_idcategorias, 
                    dimensiones_iddimensiones=:dimensiones_iddimensiones"; 
                 
        // Preparar query (sentencia)
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->idcategorias=htmlspecialchars(strip_tags($this->idcategorias));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->subcategoria=htmlspecialchars(strip_tags($this->subcategoria));
        $this->categorias_idcategorias=htmlspecialchars(strip_tags($this->categorias_idcategorias));  
        $this->dimensiones_iddimensiones=htmlspecialchars(strip_tags($this->dimensiones_iddimensiones));
        
        // Bind valores
        $stmt->bindParam(":idcategorias", $this->idcategorias);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":subcategoria", $this->subcategoria);
        $stmt->bindParam(":categorias_idcategorias", $this->categorias_idcategorias); 
        $stmt->bindParam(":dimensiones_iddimensiones", $this->dimensiones_iddimensiones);
  
        //  Ejecutar query
        if($stmt->execute()){
            return true;
        } 
        return false;
        
    }
// Funcion para leer un solo registro
function readOne(){
 
    // Query para leer uno solo
    $query = "SELECT  *  FROM  " . $this->table_name . "  WHERE idcategorias = ?  LIMIT  0,1";
 
    // Preparar sentencia
    $stmt = $this->conn->prepare( $query ); 
    $stmt->bindParam(1, $this->idcategorias);
 
    // Ejecutar query
    $stmt->execute();
 
    // Recibir datos de la consulta y guardarlos en una variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // Setear valores a las propiedades del objeto
    $this->idcategorias = $row['idcategorias'];
    $this->nombre = $row['nombre'];
    $this->subcategoria = $row['subcategoria'];
    $this->categorias_idcategorias = $row['categorias_idcategorias'];
    $this->dimensiones_iddimensiones = $row['dimensiones_iddimensiones'];
 }

 // Funcion para leer un solo registro
function search(){
 
    // Query para leer uno solo
    $query = "SELECT  *  FROM  " . $this->table_name . "  WHERE dimensiones_iddimensiones = ? AND subcategoria = 'NO'";
    
    // Preparar sentencia
    $stmt = $this->conn->prepare( $query ); 
    $stmt->bindParam(1, $this->dimensiones_iddimensiones);
 
    // Ejecutar query
    $stmt->execute();
    return $stmt;
 
    // Recibir datos de la consulta y guardarlos en una variable
    //$row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Setear valores a las propiedades del objeto
    /*$this->idcategorias = $row['idcategorias'];
    $this->nombre = $row['nombre'];
    $this->subcategoria = $row['subcategoria'];
    $this->categorias_idcategorias = $row['categorias_idcategorias'];
    $this->dimensiones_iddimensiones = $row['dimensiones_iddimensiones'];
  */
   // return $row;
 }

function subcat(){
 
    // Query para leer uno solo
    $query = "SELECT  *  FROM  " . $this->table_name . "  WHERE categorias_idcategorias = ?  AND subcategoria = 'SI'";
 
    // Preparar sentencia
    $stmt = $this->conn->prepare( $query ); 
    $stmt->bindParam(1, $this->categorias_idcategorias);
 
    // Ejecutar query
    $stmt->execute();
    return $stmt;
 
    // Recibir datos de la consulta y guardarlos en una variable
    //$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
   
}

function update(){
 
    // Query de actualizar
    $query = "UPDATE " . $this->table_name . "  SET
                idcategorias = :idcategorias,
                nombre = :nombre,
                subcategoria = :subcategoria,
                categorias_idcategorias = :categorias_idcategorias,
                dimensiones_iddimensiones = :dimensiones_iddimensiones
               WHERE  idcategorias = :idcategorias";
 
    // Preparar Query (sentencia)
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->idcategorias=htmlspecialchars(strip_tags($this->idcategorias));
    $this->nombre=htmlspecialchars(strip_tags($this->nombre));
    $this->subcategoria=htmlspecialchars(strip_tags($this->subcategoria));
    $this->categorias_idcategorias=htmlspecialchars(strip_tags($this->categorias_idcategorias));
    $this->dimensiones_iddimensiones=htmlspecialchars(strip_tags($this->dimensiones_iddimensiones));
        
    // Bind nuevos valores
    $stmt->bindParam(':idcategorias', $this->idcategorias);
    $stmt->bindParam(':nombre', $this->nombre);
    $stmt->bindParam(':subcategoria', $this->subcategoria);
    $stmt->bindParam(':categorias_idcategorias', $this->categorias_idcategorias);
    $stmt->bindParam(':dimensiones_iddimensiones', $this->dimensiones_iddimensiones);
   
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