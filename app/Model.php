<?php
include_once ('Config.php');

class Model extends PDO{

    protected $conexion;

    public function __construct(){  
            $this->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
            $this->conexion->exec("set names utf8");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //INSERTS

    public function insertarUser($email,$nombre,$apellido,$pass,$img){
        $consulta = "insert into usuario (Mail,Nombre,Apellido,Password,Imagen,Admin,DadoAlta) values (?, ?, ?, ?, ?, 0, 0)";
            
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(1, $email);
            $result->bindParam(2, $nombre);
            $result->bindParam(3, $apellido);
            $result->bindParam(4, $pass);
            $result->bindParam(5, $img);
            $result->execute();     
    }

    public function insertarEvento($idreserva,$idaula,$hora,$fecha,$mail){
        $consulta = "insert into reserva (IdReserva,IdAula,Hora,Fecha,MailProfesor) values (?, ?, ?, ?, ?)";
            
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(1, $idreserva);
            $result->bindParam(2, $idaula);
            $result->bindParam(3, $hora);
            $result->bindParam(4, $fecha);
            $result->bindParam(5, $mail);
            $result->execute();
    }

    public function addAula($numaula){
        $consulta = "insert into aula (IdAula) values (:numaula)";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':numaula', $numaula);
        $result->execute();
    }

    //UPDATES

    public function cambiaPass($pass,$user){
        $consulta = "update usuario set Password=:pass where Mail=:user";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':pass', $pass);
        $result->bindParam(':user', $user);
        $result->execute(); 
    }

    public function autorizar($mail){
        $consulta = "update usuario set DadoAlta=1 where (Mail=:mail)";
    
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':mail', $mail);
        $result->execute();
    }

    public function desautorizar($mail){
        $consulta = "update usuario set DadoAlta=0 where (Mail=:mail)";
    
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':mail', $mail);
        $result->execute();
    }

    //BORRAR

    public function borrarEvento($id){
        $consulta = "DELETE FROM reserva WHERE IdReserva=:id";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':id', $id);
        $result->execute();
    }

    public function borrarAula($id){
        $consulta = "DELETE FROM aula WHERE IdAula=:id";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':id', $id);
        $result->execute();
    }

    //LOGIN Y REGISTRO

    public function loginComp($mail,$pass){
            $consulta = "select Mail from usuario where Mail=:mail AND Password=:pass";
            
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(':mail', $mail);
            $result->bindParam(':pass', $pass);
            $result->execute();
            return $result->fetch();       
    }

    public function buscaUsuario($nombre){
            $consulta = "select Mail from usuario where Mail=:nombre";
            
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(':nombre', $nombre);
            $result->execute();
            return $result->fetch();       
    }

    public function getNombre($mail){
        $consulta = "select Nombre,Apellido from usuario where Mail=:mail";
            
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':mail', $mail);
        $result->execute();
        return $result->fetch();  
    }

    public function getImg($mail){
        $consulta = "select Imagen from usuario where Mail=:mail";
            
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':mail', $mail);
        $result->execute();
        return $result->fetch();  
    }

    //MOVIDAS DE LA WEB

    public function esAdmin($email){
        $consulta = "select Admin from usuario where Mail=:nombre";
                
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombre', $email);
        $result->execute();
        return $result->fetch();       
    }

    public function reservas($email){
        $consulta = "select IdAula,Fecha,Hora from reserva where MailProfesor=:mail";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':mail', $email);
        $result->execute();
        return $result->fetchAll();   
    }

    public function usuarios(){
        $consulta = "select Mail,DadoAlta from usuario";
        
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        return $result->fetchAll(); 
    }

    public function cargarEventos($fecha){
        $consulta = "select IdReserva,IdAula,Hora,Fecha,MailProfesor from reserva where Fecha=:fecha";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':fecha', $fecha);
        $result->execute();
        return $result->fetchAll(); 
    }

    public function cargarAulas(){
        $consulta = "select IdAula from aula";
        
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        return $result->fetchAll(); 
    }

}
?>
