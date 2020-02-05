<!DOCTYPE html>
<!--
Esta página muestra en una tabla los datos de la tabla alumnos.
Tiene un combo que se rellana con los nombres de los alumnos de la tabla y al pulsar el botón "Enviar"
muestra un formulario con los datos del alumno seleccionado. En ese formulario podemos editar todos
los datos del alumnos excepto el "Id" y al pulsar el botón "Actualizar" se actualizan los nuevos datos en 
la tabla alumnos y los muestra en una tabla.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h3><p>Esta página muestra la tabla alumnos para poder modificarla con un UPDATE</p></h3>
        <?php
        
        require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
        $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
        if (mysqli_connect_errno()){
            echo "No se ha podido conectar con la BD";
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
        mysqli_set_charset($conexion, "utf8");
        $consulta="Select * from alumnos";//consulta que muestra todo el contenido de la tabla
        $resultado= mysqli_query($conexion, $consulta);
        echo "<table border=1>";
        echo "<tr><th bgcolor='#BDC3C7'>Id</th>";
        echo "<th bgcolor='#BDC3C7'>Nombre</th>";
        echo "<th bgcolor='#BDC3C7'>Ciudad</th>";
        echo "<th bgcolor='#BDC3C7'>Asignatura</th>";
        echo "<th bgcolor='#BDC3C7'>Nota</th></tr>";
        while($fila= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            echo "<tr><td>";
            echo $fila['Id'] . "</td><td>";
            echo $fila['Nombre'] . "</td><td> ";
            echo $fila['Ciudad'] . "</td><td> ";
            echo $fila['Asignatura'] . "</td><td> ";
            echo $fila['Nota'] . "</td></tr>";
        }
        echo"</table>";
        ?>
        <form method="get" name="form">
        <p>Selecciona el alumno que quieres modificar</p>
        <select name="nombre">
        <?php
        $sql="select Nombre from alumnos";
        $result_nombre= mysqli_query($conexion, $sql);
        while($fila= mysqli_fetch_array($result_nombre,MYSQLI_ASSOC)){
            echo '<option value="'.$fila[Nombre].'">'.$fila[Nombre].'</option>';//Rellena el combo con los nombres de los alumnos
        }
        ?>
        </select>
        <input type="submit" name="ok" value="Enviar">
        <input type="submit" name="cancel" value="Buscar otro">
        <?php
        if (isset($_GET["ok"])){
            $seleccionado=$_GET["nombre"];
            echo "El nombre del alumno es $seleccionado";
            echo "<p>Los datos del alumno seleccionado son los siguientes:</p>";
            echo "<table border='1'>";
            $sql_buscar="select * from alumnos where Nombre like '%$seleccionado%'";
            $result_buscar= mysqli_query($conexion, $sql_buscar);
            while ($fila_busc= mysqli_fetch_array($result_buscar,MYSQLI_ASSOC)){//Muestro una tabla con los datos del alumno seleccionado para editarla
                echo "<tr><th bgcolor='#BDC3C7'>Campo</th><th bgcolor='#BDC3C7'>Valor</th></tr>";//Se le puede poner colores en hexadecimal. En RGB no lo pilla bien
                echo "<tr><td bgcolor='#87CEEB'>Id</td><td><input type='text' name='id' readonly value='{$fila_busc['Id']}'></td></tr>";
                echo "<tr><td bgcolor='#87CEEB'>Nombre</td><td><input type='text' name='nombre' value='{$fila_busc['Nombre']}'></td></tr>";
                echo "<tr><td bgcolor='#87CEEB'>Ciudad</td><td><input type='text' name='ciudad' value='{$fila_busc['Ciudad']}'></td></tr>";
                echo "<tr><td bgcolor='#87CEEB'>Asignatura</td><td><input type='text' name='asignatura' value='{$fila_busc['Asignatura']}'></td></tr>";
                echo "<tr><td bgcolor='#87CEEB'>Nota</td><td><input type='text' name='nota' value='{$fila_busc['Nota']}'></td></tr>";
            }
            echo"</table>";
            echo '<br><input type="submit" name="otro" value="Cancelar">';
            echo '&nbsp<input type="submit" name="actualizar" value="Actualizar">';
        }    
        if (isset($_GET['actualizar'])){
            $id=$_GET['id'];
            $nombre=$_GET['nombre'];
            $ciudad=$_GET['ciudad'];
            $asignatura=$_GET['asignatura'];
            $nota=$_GET['nota'];
            $sql_actualizar="update alumnos set Nombre='$nombre', Ciudad='$ciudad', Asignatura='$asignatura', Nota='$nota' where Id='$id'";
            $result_actualizar= mysqli_query($conexion, $sql_actualizar);
            if ($result_actualizar==FALSE){
                echo 'Error en la consulta';
            }else{
                echo "<br><br>Registro actualizado<br><br>";
                echo "<table border='1'>";
                echo "<tr><th colspan='5'>Estos son los nuevos datos</th></tr>";
                echo "<tr><td>$id</td><td>$nombre</td><td>$ciudad</td><td>$asignatura</td><td>$nota</td></tr>";
                echo "</table>";
            }
        }
        ?>
        </form>
    </body>
</html>
