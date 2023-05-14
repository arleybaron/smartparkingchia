<?php

    include 'conexion_be.php';

    $nombre_completo= $_POST['nombre_completo'];
    $correo= $_POST['correo'];
    $usuario= $_POST['usuario'];
    $contrasena= $_POST['contrasena'];
    $contrasena= hash('sha512', $contrasena);

    $query="INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena)
            VALUES('$nombre_completo','$correo','$usuario','$contrasena')";

    //VERIFICACION DE DATOS DUPLICADOS

    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");
    
    if(mysqli_num_rows($verificar_correo)>0){
        echo '
            <script>
                alert("Este correo ya esta registrado");
                window.location = "../index.html";
            </script>
            ';
            exit();
            mysqli_close($conexion);
    }

    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario'");
    
    if(mysqli_num_rows($verificar_usuario)>0){
        echo '
            <script>
                alert("Este usario ya existe");
                window.location = "../index.html";
            </script>
            ';
            exit();
            mysqli_close($conexion);
    }

    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo '
            <script>
                alert("usuario almacenado exitosamente");
                window.location = "../index.html";
            </script>
            ';
    }else{
        echo '
            <script>
                alert("Intentalo de nuevo");
                window.location = "../index.html";
            </script>
            ';
    }

    mysqli_close($conexion);
?>