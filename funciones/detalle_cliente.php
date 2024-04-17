<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sigep - Centro Bodegas</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/fontAwesome.css">
    <link rel="stylesheet" href="css/light-box.css">
    <link rel="stylesheet" href="css/owl-carousel.css">
    <link rel="stylesheet" href="css/templatemo-style.css">

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <!-- Estilos adicionales -->
    <style>
         /* Estilos para el botón de salida */
         .exit-button {
            text-align: center;
            margin-top: 20px; /* Ajusta el margen según sea necesario */
        }
        .exit-button button {
            padding: 15px 30px; /* Ajusta el tamaño del padding para aumentar el tamaño del botón */
            font-size: 18px; /* Ajusta el tamaño del texto según sea necesario */
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .exit-button button:hover {
            background-color: #45a049;
        }
        /* Tabla */
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

    <!-- Contenido -->
    <section id="blog" class="content-section">
        <div class="section-heading">
            <h1>Centro <em>Bodegas</em></h1>
        </div>
        <div class="section-content">
            <div class="tabs-content">
                <div class="wrapper">
                    <section id="first-tab-group" class="tabgroup">
                        <!-- Contenido PHP -->
                        <?php
                        // Establecer conexión con la base de datos (reemplaza 'host', 'usuario', 'contraseña' y 'nombre_base_de_datos' con tus propios valores)
                        $conexion = new mysqli('localhost', 'root', '', 'sigep');
                        // Verificar la conexión
                        if ($conexion->connect_error) {
                            die("Error en la conexión: " . $conexion->connect_error);
                        }
                        // Obtener el nombre del proveedor de la URL
                        $cedula_cl = $_GET['id'];
                        // Consulta SQL para obtener los productos asociados al proveedor
                        $sql = "SELECT factura, fecha FROM venta WHERE cedula_venta = '$cedula_cl'";
                        // Ejecutar la consulta
                        $resultado = $conexion->query($sql);
                        // Verificar si se encontraron resultados
                        if ($resultado->num_rows > 0) {
                            // Mostrar los datos de los productos asociados al proveedor
                            echo "<h2>Facturas del cliente con cedula : $cedula_cl</h2>";
                            echo "<table class='styled-table'>";
                            echo "<thead><tr><th>Nombre Producto</th><th>Precio</th></tr></thead>";
                            echo "<tbody>";
                            while ($fila = $resultado->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $fila['factura'] . "</td>";
                                echo "<td>" . $fila['fecha'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "No se encontraron productos para el proveedor $nombre_prov.";
                        }
                        // Cerrar la conexión
                        $conexion->close();
                        ?>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <section class="exit-button">
        <button onclick="location.href='menu.php';">Salir</button>
    </section>
    <br>
    <!-- Pie de página -->
    <section class="footer">
        <p>SIGEP</p>
    </section>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script>
        // JavaScript adicional si es necesario
    </script>
</body>
</html>
