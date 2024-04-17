<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de Productos</title>
 
 
 <style>
    /* Estilos del modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background-color: white; /* Color de fondo blanco */
        border-radius: 15px; /* Bordes redondeados */
        padding: 5vw; /* Espacio interior relativo al ancho de la pantalla */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra */
        max-width: 90%; /* Ancho máximo del modal */
        max-height: 30%; /* Altura máxima del modal */
        overflow: auto; /* Habilitar desplazamiento */
        border-radius: 20px;
    }

    .modal img {
        max-width: 100%; /* Ajustar la imagen al ancho del contenedor */
        height: auto; /* Mantener la proporción de aspecto */
    }

    .close {
        color: #000; /* Color del icono de cierre */
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 3vw; /* Tamaño de fuente relativo al ancho de la pantalla */
        font-weight: bold;
        transition: 0.3s;
        cursor: pointer;
    }

    @media screen and (max-width: 600px) {
        /* Estilos adicionales para pantallas más pequeñas */
        .modal {
            padding: 10vw; /* Aumentar el espacio interior relativo al ancho de la pantalla */
        }

        .close {
            font-size: 5vw; /* Aumentar el tamaño de fuente relativo al ancho de la pantalla */
        }
    }
</style>


</head>
<body>


<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="search">Buscar por Nombre de Producto:</label>
    <input type="text" id="search" name="search">
    <button type="submit">Buscar</button>
</form>

<?php

// Establecer conexión con la base de datos (reemplaza 'localhost', 'root', '', 'sigep' con tus propios valores)
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

// Consulta SQL para seleccionar información de todos los productos o de un producto específico si $search está definido
$sql = "SELECT * FROM productos";
if ($search !== null) {
    $sql .= " WHERE nombre_prod LIKE '%$search%'";
}

// Ejecutar la consulta
$resultado = $conexion->query($sql);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Mostrar los datos de los productos
    echo "<h2>Información de Productos</h2><br>"; 
    echo "<table class='styled-table'>";
    echo "<thead><tr><th>Nombre del Producto</th><th>Precio del Producto</th><th>Foto del Producto</th><th>Stock</th></tr></thead>";
    echo "<tbody>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['nombre_prod'] . "</td>";
        echo "<td>$" . $fila['precio_prod'] . "</td>";
        echo "<td><img src='" . $fila['foto_prod'] . "' alt='Foto del Producto' style='width:100px;height:auto;' onclick=\"openModal('" . $fila['foto_prod'] . "', '" . $fila['nombre_prod'] . "', '" . $fila['precio_prod'] . "', '" . $fila['ref_prod'] . "', '" . $fila['proveedor_prod'] . "', '" . $fila['stock'] . "');\"></td>";
        echo "<td>" . $fila['stock'] . "</td>"; 
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No se encontraron productos.";
}

// Cerrar la conexión
$conexion->close();

?>
<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>

        <img id="modalImg" src="" alt="Imagen del Producto">
        <div id="productDetails"></div>
   
</div>
<script>
// Función para abrir el modal y mostrar la imagen y detalles del producto
function openModal(imgSrc, nombre_prod, precio_prod, ref_prod, proveedor_prod, stock) {
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("modalImg");
    var productDetails = document.getElementById("productDetails");

    modal.style.display = "block";
    modalImg.src = imgSrc;

    // Estilos CSS para dar formato a las informaciones del producto
    productDetails.innerHTML = "<div style='display: table; width: 100%;'>" +
                                    "<div style='display: table-row;'>" +
                                        "<div style='display: table-cell; padding: 5px; border-bottom: 1px solid #ddd; text-align: left;'><strong>Nombre del Producto:</strong></div>" +
                                        "<div style='display: table-cell; padding: 5px; border-bottom: 1px solid #ddd; text-align: left;'>" + nombre_prod + "</div>" +
                                    "</div>" +
                                    "<div style='display: table-row;'>" +
                                        "<div style='display: table-cell; padding: 5px; border-bottom: 1px solid #ddd; text-align: left;'><strong>Precio:</strong></div>" +
                                        "<div style='display: table-cell; padding: 5px; border-bottom: 1px solid #ddd; text-align: left;'>" + precio_prod + "$</div>" +
                                    "</div>" +
                                    "<div style='display: table-row;'>" +
                                        "<div style='display: table-cell; padding: 5px; border-bottom: 1px solid #ddd; text-align: left;'><strong>Referencia:</strong></div>" +
                                        "<div style='display: table-cell; padding: 5px; border-bottom: 1px solid #ddd; text-align: left;'>" + ref_prod + "</div>" +
                                    "</div>" +
                                    "<div style='display: table-row;'>" +
                                        "<div style='display: table-cell; padding: 5px; border-bottom: 1px solid #ddd; text-align: left;'><strong>Proveedor:</strong></div>" +
                                        "<div style='display: table-cell; padding: 5px; border-bottom: 1px solid #ddd; text-align: left;'>" + proveedor_prod + "</div>" +
                                    "</div>" +
                                    "<div style='display: table-row;'>" +
                                        "<div style='display: table-cell; padding: 5px; border-bottom: 1px solid #ddd; text-align: left;'><strong>Stock:</strong></div>" +
                                        "<div style='display: table-cell; padding: 5px; border-bottom: 1px solid #ddd; text-align: left;'>" + stock + "</div>" +
                                    "</div>" +
                                "</div>";
}

// Función para cerrar el modal
function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

// Código para cerrar el modal si el usuario hace clic fuera de él
window.onclick = function(event) {
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>





</body>
</html>
