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
        $busqueda=$_POST['nombre'];//Guardo en $busqueda lo que el usuario pone en el cuadro de texto
        require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
        $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
        if (mysqli_connect_errno()){
            echo "No se ha podido conectar con la BD";
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
        mysqli_set_charset($conexion, "utf8");
        $consulta="Select * from alumnos where Nombre like '%$busqueda%'";//los caracteres % al principio y al final sirven de comodines. Busco nombre car y lo encuentra
        $resultado= mysqli_query($conexion, $consulta);
        if (mysqli_affected_rows($conexion)==0){//Si el número de filas que devuelve el select es 0
            echo "No hay alumnos con el nombre de $busqueda";
        } else {
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
        }        // put your code here
        ?>
    </body>
</html>
