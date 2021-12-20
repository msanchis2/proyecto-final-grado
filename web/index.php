<?php
// web/index.php
// carga del modelo y los controladores
require_once __DIR__ . '/../app/Config.php';
require_once __DIR__ . '/../app/Model.php';
require_once __DIR__ . '/../app/Controller.php';
session_start();
if(isset($_SESSION['mail'])){
    $user=$_SESSION['mail'];
}
else $user=0;
$m=new Model();

$map = array(
    'login' => array('controller' =>'Controller', 'action' =>'login'),
    'calendario' => array('controller' =>'Controller', 'action' =>'calendario'),
    'admin' => array('controller' =>'Controller', 'action' =>'admin'),
    'reservas' => array('controller' =>'Controller', 'action' =>'reservas'),
    'logout' => array('controller' =>'Controller', 'action' =>'logout'),
    'cambiarPass' => array('controller' =>'Controller', 'action' =>'cambiarPass'),
    'aulas' => array('controller' =>'Controller', 'action' =>'aulas'),
    'sinpermisos' => array('controller' =>'Controller', 'action' =>'sinpermisos'),
    'error' => array('controller' =>'Controller', 'action' =>'error'),
    'AJAX' => array('controller' =>'Controller', 'action' =>'AJAX')
);

if (isset($_GET['ctl'])) {
    if (isset($map[$_GET['ctl']])) {
        if($_GET['ctl']=='admin' && !$m->esAdmin($user)[0] ){
            $ruta='sinpermisos';
        }
        else if($_GET['ctl']=='aulas' && !$m->esAdmin($user)[0] ){
            $ruta='sinpermisos';
        }
        else $ruta = $_GET['ctl'];
    } else {
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: Path does not exist<i>' .
            $_GET['ctl'] .'</p></body></html>';
            exit;
    }
} else {
    $ruta = 'login';
}

$controlador = $map[$ruta];

if (method_exists($controlador['controller'],$controlador['action'])) {
    call_user_func(array(new $controlador['controller'],
        $controlador['action']));
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
        $controlador['controller'] .
        '->' .
        $controlador['action'] .
        '</i> no existe</h1></body></html>';
}


?>