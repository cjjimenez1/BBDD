<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $db_host="localhost";//Dirección de la BD
        $db_nombre="pruebas";//Nombre de la BD
        $db_usuario="root";//Nombre usuario BD
        $db_clave="";//Contraseña de la BD
        $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
        //La función mysqli_connect() permite crear la conexión a la BBDD con los 3 parámetros requeridos
        if (mysqli_connect_errno()){
            echo "No se ha podido conectar con la BD";
            //Si hay algún error en la conexión, muestra en el mensaje de error
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
        //la funcion mysqli_select_db() comprueba el nombre de la BD
        mysqli_set_charset($conexion, "utf8");
        // La función mysqli_set_charset () se usa para corregir tildes que no las reconoce y le dicimos que trabaje con UTF8
        $sql="SELECT * FROM alumnos"; //Creamos la consulta a la BD y la guardamos en una variable
        $resultado= mysqli_query($conexion, $sql);//Con mysqli_query ejecutamos la consulta y lo guardamos en $resultado
        //Esto crea un recordset o resulset con todos los datos de la consulta y lo guarda en $resultado
        $fila= mysqli_fetch_row($resultado); //mysqli_fetch_row recorre el recordset línea a línea y lo guarda en $fila que es un array
        echo $fila[0];
        echo $fila[1];
        echo $fila[2];
        echo $fila[3];//Esto muestra las posiciones sólo de la primera fila.
        /*La funcion mysqli_fetch_row() accede al primer registro. Si la llamas una segunda vez, accede al segundo y así sucesivamente
        Entonces metemos la función dentro de un bucle para que recorra todos los registros*/
        while ($fila = mysqli_fetch_row($resultado)) {//Mientras sea cierto. Osea mientras haya información en $resultado
            echo $fila[0];
            echo $fila[1];
            echo $fila[2];
            echo $fila[3];
        }
        //Y para no repetir la instrucción echo $fila[], lo metemos dentro de un for que recorra todos los campos del array
        while ($fila = mysqli_fetch_row($resultado)) {
            for ($i=0;$i<count($fila);$i++)
                echo $fila[$i] . " ";
            }
        /*También se puede trabajar con arrays asociativos y a la hora de imprimirlos usamos el nombre de los campos en lugar de un índice
        Esto se haría con la función mysqli_fetch_array()A la función hay que ponerle 2 parámetros (nombre_recorset, MYSQLI_ASSOC)
        el segundo parámetro es como una constante que dice que estamos trabajando con arrays asociativos
        Quedaría así*/
        while ($fila= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            echo $fila['Id'] . "<br>";
            echo $fila['Nombre'] . "<br>";
            echo $fila['Asignatura'] . "<br>";
        }
        mysqli_close($conexion);

        ?>
    </body>
</html>
