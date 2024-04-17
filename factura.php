<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Sigep</title>

    <!-- Sentra Template -->
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/fontAwesome.css">
    <link rel="stylesheet" href="css/light-box.css">
    <link rel="stylesheet" href="css/owl-carousel.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

    <style>
        #proveedor_prod {
         width: 200px; /* Puedes ajustar este valor según tus necesidades */
         height: 80px; /* Puedes ajustar este valor según tus necesidades */
           }
         /* Estilos para el botón de salida */
         .exit-button {
            text-align: left;
            margin-top: 20px; /* Ajusta el margen según sea necesario */
        }
        .exit-button button {
            padding: 15px 50px; /* Ajusta el tamaño del padding para aumentar el tamaño del botón */
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

<header class="nav-down responsive-nav hidden-lg hidden-md">
    <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <!--/.navbar-header-->
    <div id="main-nav" class="collapse navbar-collapse">
        <nav>
            <ul class="nav navbar-nav">
                <li><a href="#top">Home</a></li>
                <li><a href="#blog">VENTAS</a></li>
                
            </ul>
        </nav>
    </div>
</header>


<div class="sidebar-navigation hidde-sm hidden-xs">
    <div class="logo">
        <a href="#">Si<em>gep</em></a>
    </div>

    <nav>
        <ul>
            <li>
                <a href="#top">
                    <span class="rect"></span>
                    <span class="circle"></span>
                    Inicio
                </a>
            </li>
            <li>
                <a href="#blog">
                    <span class="rect"></span>
                    <span class="circle"></span>
                    VENTAS
                </a>
            </li>

        </ul>
    </nav>
</div>

<div class="page-content">
    
<section id="blog" class="content-section">
        <div class="section-heading">
            <h1>Centro<em>VENTAS</em></h1>
        </div>

        <section class="exit-button">
    <button onclick="location.href='menu.php';"><i class="fas fa-address-book"></i> CRM</button>
    <button onclick="location.href='bodega.php';"><i class="fas fa-store"></i> BODEGA</button>
     </section>

        <br>

        <div class="section-content">
            <div class="tabs-content">
                <div class="wrapper">
                    

                    <section id="first-tab-group" class="tabgroup">

                        <div id="tab1">
                        <h1>MODULO - VENTA</h1>
                        <br>
                            <h2><span style="color: #45489a;">Generar nueva factura</span></h2>
                            <br>
                            

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <label for="busqueda">Buscar por nombre o cédula del cliente:</label><br>
    <input type="text" id="busqueda" name="busqueda" required><br><br>
    <button type="submit">Buscar</button>
</form>

<?php
// Verificar si se ha enviado un formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos (debes incluir tu código de conexión aquí)
    $conexion = mysqli_connect("localhost", "root", "", "sigep");

    // Verificar la conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Obtener el valor de búsqueda del formulario
    $busqueda = $_POST['busqueda'];

    // Consulta SQL para buscar coincidencias por nombre o cédula del cliente
    $sql = "SELECT * FROM cliente WHERE cedula_cl LIKE '%$busqueda%' OR nombre_cl LIKE '%$busqueda%'";

    // Ejecutar la consulta
    $resultado = mysqli_query($conexion, $sql);

    // Mostrar los resultados
    if (mysqli_num_rows($resultado) > 0) {
        echo '<div style="margin-top: 20px;">';
        echo '<h3>Resultados de la búsqueda:</h3>';
        echo '<ul style="list-style-type: none; padding-left: 0;">';
        while ($fila = mysqli_fetch_assoc($resultado)) {
            // Mostrar los datos de cada cliente encontrado
            echo '<li style="margin-bottom: 20px; border: 1px solid #ccc; padding: 20px; border-radius: 5px;">';
            echo '<p><strong>Cédula:</strong> ' . $fila['cedula_cl'] . '</p>';
            echo '<p><strong>Nombre:</strong> ' . $fila['nombre_cl'] . '</p>';
            echo '<form action="funciones/ingreso_venta.php" method="POST">';
            echo '<input type="hidden" name="cedula_venta" value="' . $fila['cedula_cl'] . '">';
            echo '<input type="hidden" name="nombre_venta" value="' . $fila['nombre_cl'] . '">';
            echo '<input type="hidden" name="fecha" value="' . date('Y-m-d H:i:s') . '">';
            echo '<input type="submit" value="Elegir" style="background-color: #4CAF50; color: white; padding: 10px 50px; border: none; border-radius: 5px; cursor: pointer;">';
            echo '</form>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    } else {
        echo "<p>No se encontraron resultados.</p>";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>


                            
                         <br><br><br>

                            <?php include("funciones/mostrar_factura.php"); ?>


                        </div>

                    </section>
                </div>
            </div>
        </div>
    </section>
    

    <section class="footer">
        <p>SIGEP</p>
    </section>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="js/vendor/bootstrap.min.js"></script>

<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

<script>
    // Hide Header on on scroll down
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('header').outerHeight();

    $(window).scroll(function(event){
        didScroll = true;
    });

    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);

    function hasScrolled() {
        var st = $(this).scrollTop();

        // Make sure they scroll more than delta
        if(Math.abs(lastScrollTop - st) <= delta)
            return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight){
            // Scroll Down
            $('header').removeClass('nav-down').addClass('nav-up');
        } else {
            // Scroll Up
            if(st + $(window).height() < $(document).height()) {
                $('header').removeClass('nav-up').addClass('nav-down');
            }
        }

        lastScrollTop = st;
    }
</script>

</body>
</html>
