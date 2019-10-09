<?php
class Indicaterri{
 
    // Conexion a la base de datos
    private $conn;
    private $table_name = "indicadores_territorios";
 
    // Campos de la clase
    public $id;
    public $periodo;
    public $valor;
    public $indicadores_idindicadores;
    public $territorios_codigo_dane;
     
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
                    id=:id,
                    periodo=:periodo, 
                    valor=:valor, 
                    indicadores_idindicadores=:indicadores_idindicadores, 
                    territorios_codigo_dane=:territorios_codigo_dane"; 
                 
        // Preparar query (sentencia)
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->periodo=htmlspecialchars(strip_tags($this->periodo));
        $this->valor=htmlspecialchars(strip_tags($this->valor));
        $this->indicadores_idindicadores=htmlspecialchars(strip_tags($this->indicadores_idindicadores));  
        $this->territorios_codigo_dane=htmlspecialchars(strip_tags($this->territorios_codigo_dane));
        
        // Bind valores
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":periodo", $this->periodo);
        $stmt->bindParam(":valor", $this->valor);
        $stmt->bindParam(":indicadores_idindicadores", $this->indicadores_idindicadores); 
        $stmt->bindParam(":territorios_codigo_dane", $this->territorios_codigo_dane);
  
        //  Ejecutar query
        if($stmt->execute()){
            return true;
        } 
        return false;
        
    }
// Funcion para leer un solo registro
function readOne(){
 
    // Query para leer uno solo
    $query = "SELECT  *  FROM  " . $this->table_name . "  WHERE id = ?  LIMIT  0,1";
 
    // Preparar sentencia
    $stmt = $this->conn->prepare( $query ); 
    $stmt->bindParam(1, $this->id);
 
    // Ejecutar query
    $stmt->execute();
 
    // Recibir datos de la consulta y guardarlos en una variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // Setear valores a las propiedades del objeto
    $this->id = $row['id'];
    $this->periodo = $row['periodo'];
    $this->valor = $row['valor'];
    $this->indicadores_idindicadores = $row['indicadores_idindicadores'];
    $this->territorios_codigo_dane = $row['territorios_codigo_dane'];
 }

 // Funcion para leer un solo registro
function search(){
 
    // Query para leer uno solo
    $query = "SELECT DISTINCT territorios.nombre, territorios.codigo_dane  FROM  " . $this->table_name . " INNER JOIN territorios ON indicadores_territorios.territorios_codigo_dane = territorios.codigo_dane AND indicadores_territorios.indicadores_idindicadores = ?";
    
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