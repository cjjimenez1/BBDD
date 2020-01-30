<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" name="form">
            <p>Introduzca nombre a buscar: <input type="text" name="nombre"></p>
            <p><input type="submit" name="boton" value="Buscar"</p>
            
        </form>
        <?php
        //$busqueda=$_POST['nombre'];//Guardo en $busqueda lo que el usuario pone en el cuadro de texto
        require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
        $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
        if (mysqli_connect_errno()){
            echo "No se ha podido conectar con la BD";
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
        mysqli_set_charset($conexion, "utf8");
        $consulta="Select * from alumnos";//los caracteres % al principio y al final sirven de comodines. Busco nombre car y lo encuentra
        $resultado= mysqli_query($conexion, $consulta);
        echo "<table border=1>";
        echo "<tr><th>Id</th>";
        echo "<th>Nombre</th>";
        echo "<th>Ciudad</th>";
        echo "<th>Asignatura</th>";
        echo "<th>Nota</th>";
        while($fila= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            echo "<tr><td>";
            echo $fila['Id'] . "</td><td>";
            echo $fila['Nombre'] . "</td><td> ";
            echo $fila['Ciudad'] . "</td><td> ";
            echo $fila['Asignatura'] . "</td><td> ";
            echo $fila['Nota'] . "</td></tr>";
         }
        echo"</table>";
        
        // Hasta aquí muestra una tabla con los registros que hay en la tabla alumnos
        ?>
        <form method="get" name="form_borrar">
            <p>Introduzca el código el alumno a borrar: <input type="text" name="cod_borrar"></p>
            <p><input type="submit" name="boton_borrar" value="Borrar"></p>
        </form>
        <!--Esto es un formulario que pregunta por el código del alumno que se quiere borrar-->
        <?php
        if (isset($_GET["boton_borrar"])){
            $cod_alumn=$_GET['cod_borrar'];
            $sql_borrar="delete from alumnos where Id = '$cod_alumn'";
            $result_borrar= mysqli_query($conexion, $sql_borrar);
            if ($result_borrar==FALSE){
                echo "Error en la consulta";
            }else{
                if (mysqli_affected_rows($conexion)==0){
                    //mysqli_affected_rows() devuelve el número de filas afectadas en la consulta. Si no hoy ninguna fila que borrar muestra el mensaje
                    echo "No hay registros que borrar";
                }else{
                    echo "Se ha borrado el alumno con código $cod_alumn";
                }
            }
        }
        ?>
    </body>
</html>
