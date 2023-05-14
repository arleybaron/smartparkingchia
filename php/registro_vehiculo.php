<?php

    include 'conexion_be.php';

    $idusuarios= $_POST['idusuarios'];
    $placa= $_POST['placa'];
    $idmarca= $_POST['idmarca'];
    $modelo= $_POST['modelo'];
    $color= $_POST['color'];
    $NIV= $_POST['NIV'];

    $query_registrovehiculo="INSERT INTO vehiculos (idusuarios, placa, idmarca, modelo, color, NIV)
            VALUES('$idusuarios','$placa','$idmarca','$modelo','$color','$NIV')";

    //VERIFICACION DE DATOS DUPLICADOS

    $verificar_vehiculo = mysqli_query($conexion, "SELECT * FROM vehiculos WHERE NIV='$NIV'");
    
    if(mysqli_num_rows($verificar_vehiculo)>0){
        echo '
            <script>
                alert("Este vehiculo ya esta registrado");
                window.location = "../bienvenida.php";
            </script>
            ';
            exit();
            mysqli_close($conexion);
    }

    $verificar_placa = mysqli_query($conexion, "SELECT * FROM vehiculos WHERE placa='$placa'");
    
    if(mysqli_num_rows($verificar_placa)>0){
        echo '
            <script>
                alert("Esta placa esta registrada");
                window.location = "../bienvenida.php";
            </script>
            ';
            exit();
            mysqli_close($conexion);
    }

    $ejecutar_busqueda_vehiculo = mysqli_query($conexion, $query_registrovehiculo);

    if($ejecutar_busqueda_vehiculo){
        echo '
            <script>
                alert("Vehiculo almacenado exitosamente");
                window.location = "../bienvenida.php";
            </script>
            ';
    }else{
        echo '
            <script>
                alert("Intentalo de nuevo");
                window.location = "../bienvenida.php";
            </script>
            ';
    }

    mysqli_close($conexion);
?>