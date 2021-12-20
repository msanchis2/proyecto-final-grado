<?php

class Validacion{

    protected $_atributos;
    protected $_error;
    public $mensaje;

    public function _noEmpty($valor)
    {
        if(isset($valor) && !empty($valor)){
            return true;
        }
        else{
            return false;
        }
    }

    public function recoge($var)
    {
        if (isset($_REQUEST[$var]))
            $tmp=strip_tags($this->sinEspacios($_REQUEST[$var]));
            else
                $tmp= "";
                
                return $tmp;
    }

    public function sinEspacios($frase) {
        $frase =str_replace(' ', '', $frase);
        return $frase;
    }

    public function quitar_tildes($cadena) {
        $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
        $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
        $texto = str_replace($no_permitidas, $permitidas ,$cadena);
        return $texto;
    }

    public function campoImagen($nombre, $dir, &$errores, $extensionesValidas, $usuario){
        if ($_FILES[$nombre]['error'] != 0) {
            switch ($_FILES[$nombre]['error']) {
                case 1:
                    $errores[$nombre] = "File is too heavy";
                    break;
                case 2:
                    $errores[$nombre] = 'File size is too big';
                    break;
                case 3:
                    $errores[$nombre] = 'File could not be uploaded';
                    break;
                case 4:
                    $errores[$nombre] = 'File could not be uploaded';
                    break;
                case 6:
                    $errores[$nombre] = "Image folder is not created";
                    break;
                case 7:
                    $errores[$nombre] = "File could not be uploaded";
                    break;
                default:
                    $errores[$nombre] = 'Unknow error';
            }
            return 0;
        } else {

            $nombreArchivo = $_FILES[$nombre]['name'];
            $directorioTemp = $_FILES[$nombre]['tmp_name'];
            $extension = $_FILES['imagen']['type'];
            if (! in_array($extension, $extensionesValidas)) {
                $errores[$nombre] = "File extension is not allowed. Use png/ jpg/ gif<br>";
                return 0;
            }

            if (! isset($errores[$nombre])) {
                $nombreArchivo = $dir . $usuario .'.'. explode("/",$extension)[1];;
                echo $dir;
                if (is_dir($dir))
                    if (move_uploaded_file($directorioTemp, $nombreArchivo)) {
                        return explode("/",$extension)[1];
                    } else {
                        $errores[$nombre] = "Error: File could not be moved to its destiny";
                        return 0;
                    }
                else
                    $errores[] = "Error: File could not be moved to its destiny";
            }
        }
    }

}
    ?>

