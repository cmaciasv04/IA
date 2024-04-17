<?php

// Establecer conexión con la base de datos (reemplaza 'host', 'usuario', 'contraseña' y 'nombre_base_de_datos' con tus propios valores)
$conexion = new mysqli('localhost', 'root', '', 'sigep');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Definir las variables
$nombre_cl = $_POST['nombre_cl'];
$cedula_cl = $_POST['cedula_cl'];
$telf_cl = $_POST['telf_cl'];
$email_cl = $_POST['email_cl'];

// Consulta SQL para insertar datos en la tabla sin incluir id_cliente
$sql = "INSERT INTO cliente (nombre_cl, cedula_cl, telf_cl, email_cl) VALUES ('$nombre_cl','$cedula_cl', '$telf_cl', '$email_cl')";

// Ejecutar la consulta
if ($conexion->query($sql) === TRUE) {
    echo '<script>window.location.href = "../menu.php";</script>';
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    echo "Error al insertar el registro: " . $conexion->error;
}


// Cerrar la conexión
$conexion->close();

?>
