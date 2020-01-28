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
        $nota=$_POST['nota'];//Guardo en $nombre lo que el usuario pone en el cuadro de texto nota
        require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
        $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
        if (mysqli_connect_errno()){
            echo "No se ha podido conectar con la BD";
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
        mysqli_set_charset($conexion, "utf8");
        $sql="INSERT INTO alumnos (Id, Nombre, Ciudad, Asignatura, Nota) VALUES ((SELECT MAX(Id)+1 FROM (SELECT * FROM alumnos) as a), '$nombre','$ciudad','$asignatura','$nota')";
        /*La forma de sacar el id es "SELECT MAX(Id)+1 FROM alumnos" Con eso tengo el último id y le sumo 1. Pero MySQL no me deja poner "FROM alumnos" directamente en el INSERT porque
         hace referencia a la misma tabla que el INSERT. Así que hay que crear otra subconsulta en la que se pone "SELECT * FROM alumnos) as 'lo que sea'" para sustituir a alumnos*/
        $resultado= mysqli_query($conexion, $sql);
        if($resultado==FALSE){
            echo"Error en la consulta";
        }else{
            echo "Registro insertado<br><br>";
            echo "<table><tr><td>$nombre</td></tr>";
            echo "<tr><td>$ciudad</td></tr>";
            echo "<tr><td>$asignatura</td></tr>";
            echo "<tr><td>$nota</td></tr></table>";
                        
        }
        // put your code here
        ?>
    </body>
</html>
