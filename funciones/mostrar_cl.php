<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de Clientes</title>
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

// Consulta SQL para seleccionar información de todos los clientes o de un cliente específico si $search está definido
$sql = "SELECT * FROM cliente";
$sql .= " ORDER BY id_cliente DESC";
if ($search !== null) {
    $sql .= " WHERE nombre_cl LIKE '%$search%' OR cedula_cl LIKE '%$search%'";
}

// Ejecutar la consulta
$resultado = $conexion->query($sql);

// Verificar si se encontraron resultados
// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Mostrar los datos de los clientes
    echo "<h2>Información de Clientes</h2>";
    
    echo "<table class='styled-table'>";
    echo "<thead><tr><th>Nombre</th><th>Cedula</th><th>Teléfono</th><th>Email</th><th>Detalle</th><th>VENDER</th></tr></thead>";
    echo "<tbody>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
       
        echo "<td>" . $fila['nombre_cl'] . "</td>";
        echo "<td>" . $fila['cedula_cl'] . "</td>";
        echo "<td>" . $fila['telf_cl'] . "</td>";
        echo "<td>" . $fila['email_cl'] . "</td>";
        echo "<td><a href='detalle_cliente.php?id=" . $fila['cedula_cl'] . "'><button>Revisar</button></a></td>"; 
        echo "<td><a href='./crear_factura_cl.php?factura=" . $fila['factura'] . "&cedula_cl=" . $fila['cedula_cl'] . "&nombre_cl=" . urlencode($fila['nombre_cl']) . "'><button>FACTURAR</button></a></td>";
        echo "</tr>";

    }
    echo "</tbody></table>";
} else {
    echo "No se encontraron clientes.";
}


// Cerrar la conexión
$conexion->close();

?>

</body>
</html>
