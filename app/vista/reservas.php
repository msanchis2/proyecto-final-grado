<?php ob_start() ?>
<h1><?php echo $_SESSION['user'] ?>reservations</h1>
<table>
    <tr>
        <td class="tableIndex"><b>Classroom</b></td>
        <td class="tableIndex"><b>Date</b></td>
        <td class="tableIndex"><b>Time</b></td>
    </tr>
<?php 

if(!empty($params)){
    for($a=0; $a<count($params); $a++){
        echo '<tr>';
        echo '<td class="tableIndex">'.$params[$a]['IdAula'].'</td>';
        echo '<td class="tableIndex">'.$params[$a]['Fecha'].'/2020</td>';
        echo '<td class="tableIndex">'.$params[$a]['Hora'].'</td>';
        echo '</tr>';
    }
}

?>
</table>
<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>