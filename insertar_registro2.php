<html>
    <!--
Esta página pinta un formulario que se rellena para insertar esos datos en una BBDD
-->
    <head>
        <meta charset="UTF-8">
        <title>Formulario insertar registos en BBDD</title>
    </head>
    <body>
        <form method="post" name="form">
            <p>Introduzca Nombre: <input type="text" name="nombre"></p>
            <p>Introduzca Ciudad: <input type="text" name="ciudad"></p>
            <p>Introduzca Asignatura: <input type="text" name="asignatura"></p>
            <p>Introduzca Nota: <input type="number" name="nota" min="0" max="10"></p>
            <p><input type="submit" name="boton" value="Insertar"</p>
            
        </form>
        <?php
        $nombre=$_POST['nombre'];//Guardo en $nombre lo que el usuario pone en el cuadro de texto nombre
        $ciudad=$_POST['ciudad'];//Guardo en $nombre lo que el usuario pone en el cuadro de texto ciudad
        $asignatura=$_POST['asignatura'];//Guardo en $nombre lo que el usuario pone en el cuadro de texto asignatura
        $nota=$_POST['nota'];//Guardo en $nota lo que el usuario pone en el cuadro de texto nota
        require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
        $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
        if (mysqli_connect_errno()){
            echo "No se ha podido conectar con la BD";
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
        mysqli_set_charset($conexion, "utf8");
        $sql_id="SELECT MAX(Id)+1 FROM alumnos";//guardo en $sql_id el mayor número id y le sumo 1
        $resulset_id= mysqli_query($conexion, $sql_id);//ejecuto la sentencia
        $resultado_id= mysqli_fetch_row($resulset_id);//guardo el resultado de la sentencia en $resultado_id que es un array
        $sql="INSERT INTO alumnos (Id, Nombre, Ciudad, Asignatura, Nota) VALUES ('$resultado_id[0]', '$nombre','$ciudad','$asignatura','$nota')";
        /*Esto es otra forma de sacar el id. Primero hago el SELECT MAX(id)+1 y lo guardo en $SQL_id, ejecuto la consulta y la guardo en $resulset_id
         luego recorro el resulset y guardo el resultado en $resultado_id que es un array. Después inserto y muestro en la tabla la primera posición del array "$resultado_id[0]"*/
        $resultado= mysqli_query($conexion, $sql);
        if($resultado==FALSE){
            echo"Error en la consulta";
        }else{
            echo "Registro insertado<br><br>";
            echo "<table><tr><td>Id</td><td>$resultado_id[0]</td></tr>";
            echo "<tr><td>Nombre</td><td>$nombre</td></tr>";
            echo "<tr><td>Ciudad</td><td>$ciudad</td></tr>";
            echo "<tr><td>Asignatura</td><td>$asignatura</td></tr>";
            echo "<tr><td>Nota</td><td>$nota</td></tr></table>";
                        
        }
        // put your code here
        ?>
    </body>
</html>
