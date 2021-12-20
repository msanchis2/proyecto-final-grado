<?php ob_start() ?>
<h1>Classroom administration</h1>

    <h3>Classroom list</h3>
    <table>
    <form action="index.php?ctl=aulas" method="POST">
    <tr>
        <td class="tableIndex">Number</td>
        <td class="tableIndex">Disable</td>
    </tr>
    <?php 
        foreach($params as $name){
            $name=$name['IdAula'];
            if($name==0){
                echo" <tr><td>Assembly hall</td>";
            }
            else{
                $value=$name;
                echo '<tr><td>Classroom: '.$value.'</td>';
            }
            echo "<td><input type='submit' value='Disable' class='rojo' name='disable:".$name."'</td></tr>";
            }
          ?>
    </form>
    </table>
    <br><br>
<div id="form">
    <form method="POST" action="index.php?ctl=aulas">
        <h3>Add new classroom</h3>
        <input type="text" placeholder="Classroom id" name="id">
        <input type="submit" value="Add" class="verde" name="addAula">
    </form>
</div>


<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>