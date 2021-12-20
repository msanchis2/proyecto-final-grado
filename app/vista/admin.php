<?php ob_start() ?>
<h1>Users administration</h1>

<table>
<form action="index.php?ctl=admin" method="POST">
    <tr>
        <td class="tableIndex">Mail</td>
        <td class="tableIndex">Enable/ Disable</td>
    </tr>
<?php 
if(!empty($usuarios)){
    foreach($usuarios as &$value){
        $id=explode("@", $value['Mail'])[0];
        echo '<tr>';
        echo '<td>'.$value['Mail'].'</td>';
        if(!$value['DadoAlta'])
            echo '<td><input type="submit" value="Enable" class="verde" name="enable:'.$id.'"></td></tr>';
        else
            echo '<td><input type="submit" value="Disable" class="rojo" name="disable:'.$id.'"></td></tr>';
    }
}

?>
</form>
</table>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>