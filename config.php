<?php
class Database{
 
    // Especificar credenciales de conexion
    private $host = "cristianolivares.com";
    private $db_name = "cristia2_pacifico";
    private $username = "cristia2";
    private $password = "guaricho2019";
    public $conn;
 
    // Conexion a la base de datos
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Error de conexion: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>