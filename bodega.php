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

}
   
<style>
.custom-file {
  position: relative;
  display: inline-block;
  width: 250px; }

.custom-file-input {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  cursor: pointer;
}

.custom-file-label {
  display: block;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  padding: .375rem .75rem;
  border: 1px solid #ced4da;
  border-radius: .25rem;
  background-color: #fff;
  cursor: pointer;
}

        #proveedor_prod {
         width: 200px; /* Puedes ajustar este valor según tus necesidades */
         height: 50px; /* Puedes ajustar este valor según tus necesidades */
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
                <li><a href="#blog">BODEGA</a></li>
                
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
                    BODEGA
                </a>
            </li>

        </ul>
    </nav>
</div>

<div class="page-content">
    
<section id="blog" class="content-section">
        <div class="section-heading">
            <h1>Centro<em>Bodegas</em></h1>
        </div>

        <section class="exit-button">
    <button onclick="location.href='menu.php';"><i class="fas fa-address-book"></i> CRM</button>
    <button onclick="location.href='factura.php';"><i class="fas fa-shopping-cart"></i> VENTAS</button>
    
</section>

        <br>

        <div class="section-content">
            <div class="tabs-content">
                <div class="wrapper">
                    

                    <section id="first-tab-group" class="tabgroup">

                        <div id="tab1">
                        <h1>MODULO - BODEGA</h1>
                        <br>
                            <h3><span style="color: #45489a;">Ingreso de nuevo producto</span></h3>
                            <br>
                            
                            <form action="ingreso_prod.php" method="post" enctype="multipart/form-data">
    <label for="nombre_prod">Nombre del Producto:</label>
    <input type="text" id="nombre_prod" name="nombre_prod" required><br><br>

    <label for="precio_prod">Precio del Producto:</label>
    <input type="text" id="precio_prod" name="precio_prod" required><br><br>

    <label for="ref_prod">Referencia del Producto:</label>
    <input type="text" id="ref_prod" name="ref_prod" required><br><br>

    <label for="proveedor_prod">Nombre del Proveedor:</label>
    <select id="proveedor_prod" name="proveedor_prod" required > 
        <?php
        // Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "sigep");

        // Verificar la conexión
        if (mysqli_connect_errno()) {
            echo "Fallo en la conexión a MySQL: " . mysqli_connect_error();
            exit();
        }

        // Consulta SQL para obtener los proveedores
        $consulta = "SELECT nombre_prov FROM proveedor";

        // Ejecutar la consulta
        if ($resultado = mysqli_query($conexion, $consulta)) {
            // Iterar sobre los resultados y mostrar cada proveedor como una opción en el select
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<option value='" . $fila['nombre_prov'] . "'>" . $fila['nombre_prov'] . "</option>";
            }
            // Liberar el conjunto de resultados
            mysqli_free_result($resultado);
        }

        // Cerrar la conexión
        mysqli_close($conexion);
        ?>

    </select><br><br>

    <div class="custom-file">
  <input type="file" class="custom-file-input" id="foto_prod" name="foto_prod" accept="image/*" required>
  <label class="custom-file-label" for="foto_prod">Seleccionar foto del producto</label>
</div>
<br>

    <label for="stock">Stock del Producto:</label>
    <input type="number" id="stock" name="stock" required><br><br>

    <input type="submit" value="Enviar" style="width: 150px; height: 50px;">
</form>

                         <br><br><br>
                            <?php include("funciones/mostrar_prod.php"); ?>


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
