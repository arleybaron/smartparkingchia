<?php
    session_start();
    include 'php/conexion_be.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" 
    rel="stylesheet">
</head>
<?php
    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
                alert("Pagina no encontrada);
                window.location="contact.php";
            </script
        ';
        session_destroy();
        die();
    }
    /*$Actualizar=mysqli_query($conexion,"UPDATE vehiculos set  idusuario='$idusuario', placa='$placa', idmarca='$idmarca', modelo='$modelo', color='$color' where idvehiculo='$idvehiculo'");
    $Adicionar=mysqli_query($conexion,"INSERT into  vehiculos (idusuario, placa,idmarca,modelo,color )values('$idusuario', '$placa', '$idmarca', '$modelo', ='$color');
    $Eliminar=mysqli_query($conexion,"DELETE FROM vehiculos where idvehiculo='$idvehiculo');*/
?>
<body>

    <div class="tabla_datos_usuario">
        <?php
            // Consulta a la base de datos
            $correo=$_SESSION['usuario'];
            $query = 
            "SELECT nombre_completo, correo, usuario, NIV
            FROM usuarios 
            LEFT JOIN vehiculos ON usuarios.idusuarios = vehiculos.idusuarios
            WHERE usuarios.correo='$correo'";
            $result = mysqli_query($conexion, $query);
            echo "<table>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>imagen</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<tr>";
                echo "<th>Nombre completo</th>";
                echo "<td>" . $row["nombre_completo"] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>Correo Electrónico</th>";
                echo "<td>" . $row["correo"] . "</td>";
                echo "<tr>";
                echo "<th>Usuario</th>";
                echo "<td>" . $row["usuario"] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>NIV</th>";
                echo "<td>" . $row["NIV"] . "</td>";
                echo "</tr>";
                echo "<tr>";
            }
            echo "</table>";
        ?>
    </div>
    <button type="button" onClick="mostrar_formulario()"id="boton-formulario">Agregar datos</button>
    <div id="formulario_oculto">
        <form action="php/registro_vehiculo.php" method="POST" class="formulario_registro_vehiculo">
            <label>Usuario</label>
            <select name="nombre_completo">
                <?php
                    $queryusuario = "SELECT idusuarios, nombre_completo FROM usuarios
                    WHERE correo='$correo'";
                    $result = mysqli_query($conexion, $queryusuario);
                    while($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='" . $row["idusuarios"] . "'>" . $row["nombre_completo"] . "</option>";
                    }
                ?>
            </select>
            <br>
            <label>Placa del vehiculo</label>
            <input type="text" name="placa" placeholder="Placa">
            <br>
            <label>Marca del vehiculo</label>
            <select name="marca">
                <?php
                    $querymarca = "SELECT idmarca, marca FROM marcas";
                    $result = mysqli_query($conexion, $querymarca);
                    while($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='" . $row["idmarca"] . "'>" . $row["marca"] . "</option>";
                    }
                ?>
            </select>
            <br>
            <label>Modelo del vehiculo</label>
            <input type="text" name="modelo" placeholder="Modelo">
            <br>
            <label>Color del vehiculo</label>
            <select name="color">
                <?php
                    $querycolor = "SELECT idcolor, color FROM colores";
                    $result = mysqli_query($conexion, $querycolor);
                    while($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='" . $row["idcolor"] . "'>" . $row["color"] . "</option>";
                    }
                ?>
            </select>
            <br>
            <label>NIV</label>
            <input type="text" name="NIV" placeholder="NIV">
            <br>
            <button type="submit">Enviar</button>
            <button type="submit" onClick="mostrar_formulario()">Ocultar</button>
        </form>
    </div>

    <a href="php/cerrar_sesion.php">Cerrar sesión</a>

    <script type="text/javascript">
        function mostrar_formulario(){
            document.getElementById('formulario_oculto').style.display = 'block';
        }
        function ocultar_formulario(){
            document.getElementById('formulario_oculto').style.display = 'none';
        }
    </script>
    <?php
        // Cerrar conexión a la base de datos
        mysqli_close($conexion);
    ?>
</body>
</html>