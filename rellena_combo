<!DOCTYPE html>
<!--
Esta página rellena un combo tomando los datos de la tabla ciudades y te dice cuál se ha seleccionado
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>Seleccione una ciudad del desplegable</p>
        <form method="get" name="form">
        <select name="ciudad">
            
        <?php
        require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
        $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
        if (mysqli_connect_errno()){
            echo "No se ha podido conectar con la BD";
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
        mysqli_set_charset($conexion, "utf8");
        $sql="SELECT * FROM ciudades";
        $resultado= mysqli_query($conexion, $sql);
        while($fila= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            echo '<option value="'.$fila[Nombre].'">'.$fila[Nombre].'</option>';//Rellena el combo con las ciudades de la BBDD
        }
        ?>
        </select>
        <p><input type="submit" name="ok" value="Enviar"</p>
        <?php
        if (isset($_GET["ok"])){
            $respuesta=$_GET["ciudad"];
            echo"<p>La ciudad escogida es $respuesta</p>";
        }
        ?>
        </form>
    </body>
</html>
