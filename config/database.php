<<<<<<< HEAD
<?php
class Database 
{
    private $hostname ="localhost";
    private $database ="tienda_online";
    private $username ="sa";
    private $password ="sa";
    private $charset ="utf8";
    
    function conectar()
    {
        try{
    $conexion = "mysql:host=" . $this->hostname ."; dbname=" . $this->database . "; 
    charset=". $this->charset;
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ];
    $pdo = new PDO($conexion, $this->username,  $this->password, $options); 
    return $pdo;
    }catch(PDOException $e){
echo 'Error conexion: ' . $e->getMessage();
exit;
    }
    }
}
=======
<?php
class Database 
{
    private $hostname ="localhost";
    private $database ="tienda_online";
    private $username ="sa";
    private $password ="sa";
    private $charset ="utf8";
    
    function conectar()
    {
        try{
    $conexion = "mysql:host=" . $this->hostname ."; dbname=" . $this->database . "; 
    charset=". $this->charset;
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ];
    $pdo = new PDO($conexion, $this->username,  $this->password, $options); 
    return $pdo;
    }catch(PDOException $e){
echo 'Error conexion: ' . $e->getMessage();
exit;
    }
    }
}
>>>>>>> aa635ac89f4ca6c2a74ce5a3c47f6b80dcc738d0
?>