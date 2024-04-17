<?php

// Establecer conexión con la base de datos (reemplaza 'host', 'usuario', 'contraseña' y 'nombre_base_de_datos' con tus propios valores)
$conexion = new mysqli('localhost', 'root', '', 'sigep');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Definir las variables
$cedula_venta = $_POST['cedula_venta'];
$nombre_venta = $_POST['nombre_venta'];
$fecha = date('Y-m-d H:i:s');

// Consulta SQL para insertar datos en la tabla de ventas
$sql = "INSERT INTO venta (cedula_venta, nombre_venta, fecha) VALUES ('$cedula_venta', '$nombre_venta', '$fecha')";

// Ejecutar la consulta
if ($conexion->query($sql) === TRUE) {
    echo '<script>window.location.href = "../factura.php";</script>';
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    echo "Error al insertar el registro: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>
