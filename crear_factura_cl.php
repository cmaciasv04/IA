<?php
// Verificar si se proporcionó la variable de factura
if(isset($_GET['factura'])) {
    // Recuperar valores de la URL
   
    $cedula_cl = $_GET['cedula_cl'];
    $nombre_cl = $_GET['nombre_cl'];
    
    // Obtener la fecha actual
    $fecha = date("Y-m-d"); // Formato: Año-Mes-Día

    // Establecer conexión con la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'sigep');

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    // Preparar la consulta SQL para insertar en la tabla de ventas
    $sql = "INSERT INTO venta ( cedula_venta, nombre_venta, fecha) VALUES ('$cedula_cl', '$nombre_cl', '$fecha')";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        // Redireccionar al usuario a la página anterior o a una página de confirmación
        header("Location: factura.php");
        exit();
    } else {
        echo "Error al generar la factura: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
