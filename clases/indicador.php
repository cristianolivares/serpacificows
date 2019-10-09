<?php
class Indicador{
 
    // Conexion a la base de datos
    private $conn;
    private $table_name = "indicadores";
 
    // Campos de la clase
    public $idindicadores;
    public $nombre;
    public $periodicidad;
    public $tipo_valor;
    public $nivel;
    public $fuentes_idfuentes;
    public $unidad_idunidad;
    public $indicadores_idindicadores;
    public $categorias_idcategorias;
     
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
                    idindicadores=:idindicadores,
                    nombre=:nombre, 
                    periodicidad=:periodicidad, 
                    tipo_valor=:tipo_valor,
                    nivel=:nivel, 
                    fuentes_idfuentes=:fuentes_idfuentes, 
                    unidad_idunidad=:unidad_idunidad, 
                    indicadores_idindicadores=:indicadores_idindicadores, 
                    categorias_idcategorias=:categorias_idcategorias"; 
                 
        // Preparar query (sentencia)
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->idindicadores=htmlspecialchars(strip_tags($this->idindicadores));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->periodicidad=htmlspecialchars(strip_tags($this->periodicidad));
        $this->tipo_valor=htmlspecialchars(strip_tags($this->tipo_valor));  
        $this->nivel=htmlspecialchars(strip_tags($this->nivel));
        $this->fuentes_idfuentes=htmlspecialchars(strip_tags($this->fuentes_idfuentes));
        $this->unidad_idunidad=htmlspecialchars(strip_tags($this->unidad_idunidad));
        $this->indicadores_idindicadores=htmlspecialchars(strip_tags($this->indicadores_idindicadores));  
        $this->categorias_idcategorias=htmlspecialchars(strip_tags($this->categorias_idcategorias));
        
        // Bind valores
        $stmt->bindParam(":idindicadores", $this->idindicadores);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":periodicidad", $this->periodicidad);
        $stmt->bindParam(":tipo_valor", $this->tipo_valor); 
        $stmt->bindParam(":nivel", $this->nivel);
        $stmt->bindParam(":fuentes_idfuentes", $this->fuentes_idfuentes);
        $stmt->bindParam(":unidad_idunidad", $this->unidad_idunidad);
        $stmt->bindParam(":indicadores_idindicadores", $this->indicadores_idindicadores); 
        $stmt->bindParam(":categorias_idcategorias", $this->categorias_idcategorias);
  
        //  Ejecutar query
        if($stmt->execute()){
            return true;
        } 
        return false;
        
    }
// Funcion para leer un solo registro
function readOne(){
 
    // Query para leer uno solo
    $query = "SELECT  *  FROM  " . $this->table_name . "  WHERE idindicadores = ?  LIMIT  0,1";
 
    // Preparar sentencia
    $stmt = $this->conn->prepare( $query ); 
    $stmt->bindParam(1, $this->idindicadores);
 
    // Ejecutar query
    $stmt->execute();
 
    // Recibir datos de la consulta y guardarlos en una variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // Setear valores a las propiedades del objeto
    $this->idindicadores = $row['idindicadores'];
    $this->nombre = $row['nombre'];
    $this->periodicidad = $row['periodicidad'];
    $this->tipo_valor = $row['tipo_valor'];
    $this->nivel = $row['nivel'];
    $this->fuentes_idfuentes = $row['fuentes_idfuentes'];
    $this->unidad_idunidad = $row['unidad_idunidad'];
    $this->indicadores_idindicadores = $row['indicadores_idindicadores'];
    $this->categorias_idcategorias = $row['categorias_idcategorias'];
 }

 // Funcion para leer un solo registro
function search(){
 
    // Query para leer uno solo
    $query = "SELECT  *  FROM  " . $this->table_name . "  WHERE categorias_idcategorias = ? AND  nivel = 0";
 
    // Preparar sentencia
    $stmt = $this->conn->prepare( $query ); 
    $stmt->bindParam(1, $this->categorias_idcategorias);
 
    // Ejecutar query
    $stmt->execute();
    return $stmt;
 
 }

 function subniv(){
   // Query para leer uno solo
   $query = "SELECT  *  FROM  " . $this->table_name . "  WHERE indicadores_idindicadores = ? AND  nivel != 0";
 
   // Preparar sentencia
   $stmt = $this->conn->prepare( $query ); 
   $stmt->bindParam(1, $this->indicadores_idindicadores);

   // Ejecutar query
   $stmt->execute();
   return $stmt;
 }

function update(){
 
    // Query de actualizar
    $query = "UPDATE " . $this->table_name . "  SET
                idindicadores = :idindicadores,
                nombre = :nombre,
                periodicidad = :periodicidad,
                tipo_valor = :tipo_valor,
                nivel = :nivel,
                fuentes_idfuentes = :fuentes_idfuentes,
                unidad_idunidad = :unidad_idunidad,
                indicadores_idindicadores = :indicadores_idindicadores,
                categorias_idcategorias = :categorias_idcategorias
               WHERE  idindicadores = :idindicadores";
 
    // Preparar Query (sentencia)
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->idindicadores=htmlspecialchars(strip_tags($this->idindicadores));
    $this->nombre=htmlspecialchars(strip_tags($this->nombre));
    $this->periodicidad=htmlspecialchars(strip_tags($this->periodicidad));
    $this->tipo_valor=htmlspecialchars(strip_tags($this->tipo_valor));
    $this->nivel=htmlspecialchars(strip_tags($this->nivel));
    $this->fuentes_idfuentes=htmlspecialchars(strip_tags($this->fuentes_idfuentes));
    $this->unidad_idunidad=htmlspecialchars(strip_tags($this->unidad_idunidad));
    $this->indicadores_idindicadores=htmlspecialchars(strip_tags($this->indicadores_idindicadores));
    $this->categorias_idcategorias=htmlspecialchars(strip_tags($this->categorias_idcategorias));
        
    // Bind nuevos valores
    $stmt->bindParam(':idindicadores', $this->idindicadores);
    $stmt->bindParam(':nombre', $this->nombre);
    $stmt->bindParam(':periodicidad', $this->periodicidad);
    $stmt->bindParam(':tipo_valor', $this->tipo_valor);
    $stmt->bindParam(':nivel', $this->nivel);
    $stmt->bindParam(':fuentes_idfuentes', $this->fuentes_idfuentes);
    $stmt->bindParam(':unidad_idunidad', $this->unidad_idunidad);
    $stmt->bindParam(':indicadores_idindicadores', $this->indicadores_idindicadores);
    $stmt->bindParam(':categorias_idcategorias', $this->categorias_idcategorias);
   
    // Ejecutar query
    if($stmt->execute()){
        return true;
    } 
    return false;
}

function delete(){
 
    // Query de borrar
    $query = "DELETE FROM " . $this->table_name . " WHERE idindicadores = ?";
 
    // Preparar query
    $stmt = $this->conn->prepare($query);    
    
    // sanitize
    $this->idindicadores=htmlspecialchars(strip_tags($this->idindicadores));
 
    // Bind para borrar
    $stmt->bindParam(1, $this->idindicadores);
 
    // Ejecutar query
    if($stmt->execute()){
        return true;
    }
     
    return false;
     
}
}
?>