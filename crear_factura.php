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
       .button-container {
           display: flex;
           justify-content: center; /* Centra horizontalmente los elementos */
       }

       .exit-button {
           margin-right: 8px; /* Espacio entre los botones */
       }

       /* Estilos para el botón de salida */
       .exit-button {
           text-align: center;
           margin-top: 15px; /* Ajusta el margen según sea necesario */
       }
       .exit-button button {
           padding: 10px 25px; /* Ajusta el tamaño del padding para aumentar el tamaño del botón */
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
           padding: 10px 25px; /* Ajusta el tamaño del padding para aumentar el tamaño del botón */
           font-size: 18px; /* Ajusta el tamaño del texto según sea necesario */
           background-color: #4CAF50;
           color: white;
           border: none;
           border-radius: 8px;
           cursor: pointer;
           transition: background-color 0.3s;
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
            <h1>Centro <em>VENTAS</em></h1>
        </div>
        <div class="section-content">
            <div class="tabs-content">
                <div class="wrapper">
                    <section id="first-tab-group" class="tabgroup">
                      

                    <h2>Ingresar Nueva Factura</h2>
                    <section class="exit-button">
                    <?php
                           // Inicializar la variable total
                           $total_pvp = 0;

                           // Conexión a la base de datos
                           $conexion = mysqli_connect("localhost", "root", "", "sigep");

                           // Verificar la conexión
                           if (mysqli_connect_errno()) {
                               echo "Fallo en la conexión a MySQL: " . mysqli_connect_error();
                               exit();
                           }

                           // Obtener la factura cargada
                           $factura = isset($_GET['factura']) ? htmlspecialchars($_GET['factura']) : '';

                           // Consulta SQL para obtener los detalles de la factura
                           $consulta = "SELECT producto_venta, cantidad, pvp FROM venta_detail WHERE factura_detail = '$factura'";

                           // Ejecutar la consulta
                           if ($resultado = mysqli_query($conexion, $consulta)) {
                               // Iterar sobre los resultados y sumar cada valor de PVP al total
                               while ($fila = mysqli_fetch_assoc($resultado)) {
                                   $total_pvp += $fila['pvp'];
                               }
                               // Liberar el conjunto de resultados
                               mysqli_free_result($resultado);
                           } else {
                               echo "Error en la consulta: " . mysqli_error($conexion);
                           }

                           // Cerrar la conexión
                           mysqli_close($conexion);

                           // Muestra el total arriba de los detalles de la factura
                           echo "<h3>Total: $" . number_format($total_pvp, 2) . "</h3>";
                       ?>


                    </section>
                    <br>
                                        
                    <form id="new_product_form" action="funciones/ingreso_facturadt.php" method="post">
                        <!-- Cambios en el primer campo -->
                        <label for="factura" style="font-size: 14px;">Factura:</label>
                        <?php
                            // Recuperar el número de factura de la URL si está presente
                            $factura = isset($_GET['factura']) ? htmlspecialchars($_GET['factura']) : '';
                            // Imprimir el valor del número de factura en el campo de entrada, haciéndolo de solo lectura
                            echo "<input type='text' id='factura' name='factura' value='$factura' readonly style='width: 100px;'>";
                        ?>

                        <!-- Cambios en el segundo campo -->
                        <label for="cedula_venta" style="font-size: 14px;">Cliente:</label>
                        <?php
                            // Recuperar la cédula de venta de la URL si está presente
                            $cedula_venta = isset($_GET['cedula_venta']) ? htmlspecialchars($_GET['cedula_venta']) : '';
                            // Imprimir el valor de la cédula de venta en el campo de entrada, haciéndolo de solo lectura
                            echo "<input type='text' id='cedula_venta' name='cedula_venta' value='$cedula_venta' readonly style='width: 100px;'><br>";
                        ?>

                        <br> <!-- Agregando un salto de línea entre los dos campos -->
                        <label for="proveedor_prod">Producto:</label>
                        <select id="proveedor_prod" name="nombre_prod" required > 
                        <?php
                            // Conexión a la base de datos
                            $conexion = mysqli_connect("localhost", "root", "", "sigep");

                            // Verificar la conexión
                            if (mysqli_connect_errno()) {
                                echo "Fallo en la conexión a MySQL: " . mysqli_connect_error();
                                exit();
                            }

                            // Consulta SQL para obtener los proveedores
                            $consulta = "SELECT nombre_prod FROM productos";

                            // Ejecutar la consulta
                            if ($resultado = mysqli_query($conexion, $consulta)) {
                                // Iterar sobre los resultados y mostrar cada proveedor como una opción en el select
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value='" . htmlspecialchars($fila['nombre_prod']) . "'>" . htmlspecialchars($fila['nombre_prod']) . "</option>";
                                }
                                // Liberar el conjunto de resultados
                                mysqli_free_result($resultado);
                            }

                            // Cerrar la conexión
                            mysqli_close($conexion);
                        ?>
                        </select>


                        <br>
                        <br>
                        <label for="cantidad" style="font-size: 14px;">Cantidad:</label><br>
                        <input type="number" id="cantidad" name="cantidad"><br>
                    <br>
                
                    
                    
                    
                    
                    <input  type="submit"  value="Enviar" style="background-color: #004368; color: white;">
                   
                        </div>

                    <div class="button-container">
                    <section class="exit-button">
                    <button onclick="location.reload();" style="background-color: #004368; color: white;">Nuevo</button>
                    </section>
                    <section class="exit-button">
                    <button onclick="location.href='menu.php';">Terminar</button>
                    </section>
                    

                    </div>

                    </form>
                    
                    </section>
                </div>
            </div>
        </div>

    </section>

    <section id="blog" class="slider">
       
       <h2>Detalles de la Factura</h2>
      
       <table class="styled-table">
           <thead>
               <tr>
                   <th>Producto</th>
                   <th>Cantidad</th>
                   <th>Precio Unitario (PVP)</th>
               </tr>
           </thead>

           <tbody id="detalle_factura">
               <?php
               // Conexión a la base de datos
               $conexion = mysqli_connect("localhost", "root", "", "sigep");

               // Verificar la conexión
               if (mysqli_connect_errno()) {
                   echo "Fallo en la conexión a MySQL: " . mysqli_connect_error();
                   exit();
               }

               // Obtener la factura cargada
               $factura = isset($_GET['factura']) ? htmlspecialchars($_GET['factura']) : '';

               // Consulta SQL para obtener los detalles de la factura
               $consulta = "SELECT producto_venta, cantidad, pvp FROM venta_detail WHERE factura_detail = '$factura'";

               // Ejecutar la consulta
               if ($resultado = mysqli_query($conexion, $consulta)) {
                   // Inicializar la variable total
                   $total_pvp = 0;
                   
                   // Iterar sobre los resultados y mostrar cada detalle de la factura en la tabla
                   while ($fila = mysqli_fetch_assoc($resultado)) {
                       echo "<tr>";
                       echo "<td>" . htmlspecialchars($fila['producto_venta']) . "</td>";
                       echo "<td>" . htmlspecialchars($fila['cantidad']) . "</td>";
                       echo "<td>$" . htmlspecialchars($fila['pvp']) . "</td>";
                       echo "</tr>";
                       
                       // Sumar el valor del PVP al total
                       $total_pvp += $fila['pvp'];
                   }
                   // Liberar el conjunto de resultados
                   mysqli_free_result($resultado);
               } else {
                   echo "Error en la consulta: " . mysqli_error($conexion);
               }

               // Cerrar la conexión
               mysqli_close($conexion);
               ?>
               
               <tr>
                   <td colspan="2"><strong>Total:</strong></td>
                   <td><strong>$<?php echo number_format($total_pvp, 2); ?></strong></td>
               </tr>
           </tbody>
       </table>
   </section>

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
    <!-- Agrega este script en la sección de scripts -->
<script>
    // Espera a que el DOM esté completamente cargado
    document.addEventListener("DOMContentLoaded", function() {
        // Selecciona el formulario por su ID
        var form = document.getElementById("new_product_form");

        // Agrega un evento de submit al formulario
        form.addEventListener("submit", function(event) {
            // Detén el comportamiento predeterminado del formulario (enviar y recargar la página)
            event.preventDefault();

            // Obtiene los datos del formulario
            var formData = new FormData(form);

            // Realiza una solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "funciones/ingreso_facturadt.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Maneja la respuesta del servidor aquí
                        // Por ejemplo, puedes actualizar la tabla de detalles de la factura
                        document.getElementById("detalle_factura").innerHTML = xhr.responseText;
                    } else {
                        // Maneja los errores aquí
                        console.error("Error en la solicitud AJAX: " + xhr.status);
                    }
                }
            };
            // Envía los datos del formulario
            xhr.send(formData);
        });
    });
</script>

</body>
</html>
