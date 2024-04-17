<?php
// Conexión a la base de datos (reemplaza 'host', 'usuario', 'contraseña' y 'nombre_base_de_datos' con los valores correctos)
$conexion = new mysqli('localhost', 'root', '', 'sigep');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Variables recibidas del formulario
$factura = $_POST['factura'];
$cedula_venta = $_POST['cedula_venta'];
$nombre_prod = $_POST['nombre_prod'];
$cantidad = $_POST['cantidad'];

// Consulta SQL para obtener el precio del producto
$sql_precio = "SELECT precio_prod FROM productos WHERE nombre_prod = '$nombre_prod'";
$resultado_precio = $conexion->query($sql_precio);

if ($resultado_precio->num_rows > 0) {
    // Si se encontró el producto, obtener su precio
    $fila_precio = $resultado_precio->fetch_assoc();
    $precio_producto = $fila_precio['precio_prod'];

    // Calcular el precio total
    $pvp = $cantidad * $precio_producto;

    // Consulta SQL para insertar la factura en la base de datos
    $sql = "INSERT INTO venta_detail (factura_detail, cedula_venta, producto_venta, cantidad, pvp) VALUES ('$factura', '$cedula_venta', '$nombre_prod', '$cantidad', '$pvp')";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "Factura ingresada correctamente.";
    } else {
        echo "Error al ingresar la factura: " . $conexion->error;
    }
} else {
    echo "Error: No se pudo encontrar el precio del producto.";
}

// Cerrar la conexión
$conexion->close();
?>
