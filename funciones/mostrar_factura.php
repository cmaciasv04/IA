<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de Ventas</title>
    <style>
        .styled-table {
            border-collapse: collapse;
            width: 100%;
        }

        .styled-table thead th {
            background-color: #2980B9;
            color: white;
            text-align: left;
            padding: 10px;
        }

        .styled-table tbody td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .styled-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .styled-table tbody tr:hover {
            background-color: #ddd;
        }

        .current-date {
            background-color: #F7FFCB; /* Cambia este color según tu preferencia */
        }

        .current-date + .styled-table tbody tr:nth-child(odd) {
            background-color: #fff; /* Cambia este color según tu preferencia */
        }

        /* Estilos para el botón de búsqueda */
        input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 5px;
            width: 200px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="search">Buscar por Nombre o Cédula:</label>
    <input type="text" id="search" name="search">
    <button type="submit">Buscar</button>
</form>

<?php

// Establecer conexión con la base de datos (reemplaza 'host', 'usuario', 'contraseña' y 'nombre_base_de_datos' con tus propios valores)
$conexion = new mysqli('localhost', 'root', '', 'sigep');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Inicializar la variable $search
$search = null;

// Verificar si se proporcionó un valor para $search
if (isset($_GET['search'])) {
    // Sanitizar y asignar el valor de $search
    $search = $conexion->real_escape_string($_GET['search']);
}

// Consulta SQL para seleccionar información de todas las ventas o de una venta específica si $search está definido
$sql = "SELECT * FROM venta";
if ($search !== null) {
    $sql .= " WHERE nombre_venta LIKE '%$search%' OR cedula_venta LIKE '%$search%'";
}
$sql .= " ORDER BY fecha DESC"; // Ordenar por fecha en orden descendente

// Ejecutar la consulta
$resultado = $conexion->query($sql);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Mostrar los datos de las ventas
    echo "<h2>Información de Ventas</h2>";
    
    echo "<table class='styled-table'>";
    echo "<thead><tr><th>Factura</th><th>Nombre</th><th>Cédula</th><th>Fecha</th><th>Detalle</th></tr></thead>";
    echo "<tbody>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr";
        // Comprobar si la fecha es la fecha actual
        $fecha_actual = date("Y-m-d");
        if ($fila['fecha'] === $fecha_actual) {
            echo " class='current-date'";
        }
        echo ">";
        echo "<td>" . $fila['factura'] . "</td>";
        echo "<td>" . $fila['nombre_venta'] . "</td>";
        echo "<td>" . $fila['cedula_venta'] . "</td>";
        echo "<td>" . $fila['fecha'] . "</td>";
        echo "<td><a href='./crear_factura.php?factura=" . $fila['factura'] . "&cedula_venta=" . $fila['cedula_venta'] . "'><button>FACTURAR</button></a></td>";
        // Enlaza a una página de detalle de venta
        echo "</tr>";
        // Saltar una fila
        echo "<tr><td colspan='4' style='height: 5px;'></td></tr>";
    }
    echo "</tbody></table>";
    
} else {
    echo "No se encontraron ventas.";
}

// Cerrar la conexión
$conexion->close();

?>

</body>
</html>
