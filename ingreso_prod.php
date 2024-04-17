<?php
// Verificar si se ha enviado un archivo
if ($_FILES["foto_prod"]) {
    $target_dir = "img/"; // Directorio donde se guardarán las imágenes
    $target_file = $target_dir . basename($_FILES["foto_prod"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ... (Código de verificación de imagen)

    // Verificar si $uploadOk es igual a 0, lo que indica que hubo un error
    if ($uploadOk == 0) {
        echo "Lo siento, tu archivo no fue subido.";
    } else {
        // Si todo está bien, intentar subir el archivo
        if (move_uploaded_file($_FILES["foto_prod"]["tmp_name"], $target_file)) {
            // Guardar información en la base de datos
            include 'funciones/conexion.php';
    
            // No necesitas proporcionar un valor para 'id' ya que es autoincremental
            $nombre_prod = $_POST['nombre_prod'];
            $precio_prod = $_POST['precio_prod'];
            $ref_prod = $_POST['ref_prod'];
            $proveedor_prod = $_POST['proveedor_prod'];
            $stock = $_POST['stock'];
            
            $sql = "INSERT INTO productos (nombre_prod, foto_prod, precio_prod, ref_prod, proveedor_prod, stock)
             VALUES ('$nombre_prod', '$target_file', '$precio_prod', '$ref_prod', '$proveedor_prod', '$stock')";

    
            if ($conn->query($sql) === TRUE) {
                echo "El archivo " . htmlspecialchars(basename($_FILES["foto_prod"]["name"])) . " ha sido subido y la información se ha guardado en la base de datos.";
                header("Location: bodega.php");
                exit();
            } else {
                echo "Lo siento, hubo un error al subir tu archivo y guardar la información en la base de datos: " . $conn->error;
            }
    
            // Cerrar conexión
            $conn->close();
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }
}
?>
