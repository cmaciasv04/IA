<?php

// Establecer conexión con la base de datos (reemplaza 'host', 'usuario', 'contraseña' y 'nombre_base_de_datos' con tus propios valores)
$conexion = new mysqli('localhost', 'root', '', 'sigep');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Definir las variables
$nombre_prov = $_POST['nombre_prov'];
$cedula_prov = $_POST['cedula_prov'];
$telf_prov = $_POST['telf_prov'];
$email_prov = $_POST['email_prov'];

// Consulta SQL para insertar datos en la tabla sin incluir id_cliente
$sql = "INSERT INTO proveedor (nombre_prov,cedula_prov, telf_prov, email_prov) VALUES ('$nombre_prov','$cedula_prov', '$telf_prov', '$email_prov')";

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
