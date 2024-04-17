<?php
// Verificar si se recibió un número de factura
if(isset($_POST['factura'])) {
    // Obtener el número de factura enviado desde el formulario
    $factura = $_POST['factura'];
    
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "sigep");

    // Verificar la conexión
    if (mysqli_connect_errno()) {
        echo json_encode(array('error' => 'Fallo en la conexión a MySQL: ' . mysqli_connect_error()));
        exit();
    }

    // Consulta SQL para obtener los detalles de la factura
    $consulta = "SELECT producto_venta, cantidad, pvp FROM venta_detail WHERE factura_detail = '$factura'";

    // Ejecutar la consulta
    $resultado = mysqli_query($conexion, $consulta);

    // Verificar si se encontraron detalles de la factura
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Arreglo para almacenar los detalles de la factura
        $detalles_factura = array();

        // Iterar sobre los resultados y agregarlos al arreglo
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $detalles_factura[] = $fila;
        }

        // Devolver los detalles de la factura en formato JSON
        echo json_encode($detalles_factura);
    } else {
        // Si no se encuentran detalles, devolver un mensaje de error en formato JSON
        echo json_encode(array('error' => 'No se encontraron detalles para la factura ' . $factura));
    }

    // Liberar el conjunto de resultados y cerrar la conexión
    mysqli_free_result($resultado);
    mysqli_close($conexion);
} else {
    // Si no se recibió un número de factura, devolver un mensaje de error en formato JSON
    echo json_encode(array('error' => 'No se recibió el número de factura'));
}
?>
