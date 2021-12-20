<?php
include ('libs/Validacion.php');

class Controller{

    public function login(){
    try {
        $m = new Model();
        $valid = new Validacion();
        if (isset($_POST['login'])) {
            $email = $valid->recoge("email");
            $email=$email.'@iesabastos.org';
            $pass = $valid->recoge("pass");
            $pass= crypt($pass, Config::$salt);
            $correcto= $m->loginComp($email,$pass);

            if(!empty($correcto)){
                session_start();
                $nombreComp = $m->getNombre($email);
                $nombreComp = $nombreComp['Nombre'].$nombreComp['Apellido'];
                $_SESSION['imgname']=$valid->quitar_tildes(strtolower($nombreComp).'.'.$m->getImg($email)[0]);
                $_SESSION['mail']=$email;
                $_SESSION['user']=explode("@", $email)[0];
                header('Location: index.php?ctl=reservas');
            }
            else{
                echo 'Name and password do not match';
            }
        }
        if (isset($_POST['signup']) ){  
            $pass = $valid->recoge("pass");
            $pass2 = $valid->recoge("pass2");
            $nombre = $valid->recoge("nombre");
            $apellido = $valid->recoge("apellido");

            $nombre = $valid->sinEspacios($nombre);
            echo $nombre;
            $apellido = $valid->sinEspacios($apellido);

            $email = $valid->quitar_tildes($nombre).'.'.$valid->quitar_tildes($apellido).'@iesabastos.org';
            $email = strtolower($email);

            $errores = [];
            $extensionesValidas = ['image/jpg','image/png','image/gif','image/jpeg'];
            $nombreImg = $valid->quitar_tildes($nombre).$valid->quitar_tildes($apellido);
            $extension = $valid->campoImagen("imagen", '../app/vista/imgUsers/', $errores, $extensionesValidas, $nombreImg);

            $correcto = true;
            $correcto = $valid->_noEmpty($pass);
            $correcto = $valid->_noEmpty($pass2);
            $correcto = $valid->_noEmpty($nombre);
            $correcto = $valid->_noEmpty($apellido);

            $coincide = $m->buscaUsuario($email);

            if($pass==$pass2){
                $pass = crypt($pass, Config::$salt);
            }
            else{
                $correcto = false;
                echo 'Passwords do not match ';
            }

            if(empty($coincide) && $correcto && !empty($extension)){
                if($m->insertarUser($email,$nombre,$apellido,$pass,$extension)){
                    header('Location:index.php? ctl=login');
                }   
            }
            else if(!empty($coincide)){
                echo 'User is already registered ';
            }
            else if(!$correcto){
                echo 'Please fill all inputs correctly ';
            }
            else{
                foreach ($errores as &$valor) {
                    echo $valor;
                }
            }
        }
        if(isset($_POST['forgot']) && !empty($valid->recoge('email'))){
            mail($valid->recoge('email').'@iesabastos.org', 'Change your password', '<a href="index.php?ctl=cambiarPass"></a>');
        }
    } 
        catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
             error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '\vista\login.php';
    }

    function logout(){
        if (isset($_POST['logout']) ){
            session_unset();
            session_destroy();
        }
        header('location:index.php?ctl=login');
    }

    function calendario(){  
        try {
            $m = new Model();
            $params=$m->cargarAulas();
        }
        catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
             error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '\vista\calendario.php';
    }

    function admin(){
        try{
            $m = new Model();
            $usuarios= $m->usuarios();

            foreach($usuarios as $a){
                $u=explode("@", $a['Mail'])[0];
                if(isset($_POST['enable:'.$u])){
                    $m->autorizar($a['Mail']);
                }
                if(isset($_POST['disable:'.$u])){
                    $m->desautorizar($a['Mail']);
                }
            }
        
        }
        catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/vista/admin.php';
}

    function reservas(){
        try{
            $m = new Model();
            $params= $m->reservas($_SESSION['mail']);
        }
        catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/vista/reservas.php';
    }

    function aulas(){
        try{
            $m = new Model();
            $valid = new Validacion();
            $params=$m->cargarAulas();

            if(isset($_POST['addAula'])){
                $m->addAula($valid->recoge('id'));
                header('Location: index.php?ctl=aulas');
            }
            foreach($params as $name){
                if(isset($_POST['disable:'.$name['IdAula']])){
                    $m->borrarAula($name['IdAula']);
                    header('Location: index.php?ctl=aulas');
                }
            }
            
        }
        catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/vista/aulas.php';
    }

    function cambiarPass(){
        try{
            $m = new Model();
            $valid = new Validacion();
            if(isset($_POST['change'])){
                if($valid->recoge('pass')==$valid->recoge('pass2')){
                    $pass = crypt($valid->recoge('pass'), Config::$salt);
                    $m->cambiaPass($pass,$_SESSION['mail'].'@iesabastos.org');
                }
                else echo "Passwords do not match";
            }
        }
         catch (Exception $e) {
             error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
             header('Location: index.php?ctl=error');
         } catch (Error $e) {
             error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
             header('Location: index.php?ctl=error');
         }
        require __DIR__ . '/vista/cambiarPass.php';
    }
    
    
    function sinpermisos(){
        $params['mensaje']="No tienes permisos para acceder a esta página";
        require __DIR__ . '/vista/sinpermisos.php';
    }

    function error(){
        require __DIR__ . '/vista/error.php';
    }

    function AJAX(){ 
        $m = new Model();

        if(isset($_POST['fecha']) && isset($_POST['hora']) && isset($_POST['aula']) && isset($_POST['id'])){
            $fecha=$_POST['fecha'];
            $hora=$_POST['hora'];
            $aula=$_POST['aula'];
            $id=$_POST['id'];
            $m->insertarEvento($id,intval($aula),$hora,$fecha,$_SESSION['mail']);
        }

        if(isset($_POST['idremove'])){
            $m->borrarEvento($_POST['idremove']);
        }

        if(isset($_POST['fechareservas'])){
            echo $m->cargarEventos($_POST['fechareservas']);
        }
    }
}
?>
