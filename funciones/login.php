<?php
session_start(); // Inicia la sesión al principio del script

function validarLogin($usuario, $contraseña) {
    // Conexión a la base de datos (reemplaza los valores con los de tu base de datos)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sigep";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta SQL para verificar las credenciales
    $sql = "SELECT * FROM login WHERE usuario='$usuario' AND contraseña='$contraseña'";

    $result = $conn->query($sql);

    // Verificar si se encontró algún resultado
    if ($result->num_rows > 0) {
        // Credenciales válidas
        $_SESSION['username'] = $usuario; // Establece la variable de sesión del nombre de usuario
        $conn->close();
        return true;
    } else {
        // Credenciales inválidas
        $conn->close();
        return false;
    }
}

// Ejemplo de uso:
$usuario = $_POST["usuario"];
$contraseña = $_POST["contraseña"];

if (validarLogin($usuario, $contraseña)) {
    // Redirecciona a otra página después de iniciar sesión
    header("Location: ../menu.php");
    exit(); // Asegúrate de terminar el script después de redireccionar
} else {
    echo "Credenciales inválidas. Por favor, inténtalo de nuevo.";
}
?>
