<?php ob_start() ?>
<h1>Acces restricted</h1>
<?php 
$m=new Model();
?>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>