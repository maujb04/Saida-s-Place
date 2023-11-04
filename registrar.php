<?php
// Conexión a la base de datos (reemplaza con tus propios datos de conexión)
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "nombre_de_tu_base_de_datos";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recuperar los datos del formulario
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash de la contraseña
$email = $_POST['email'];

// Insertar los datos en la base de datos (usando una consulta preparada para mayor seguridad)
$stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $email);

if ($stmt->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error al registrar: " . $stmt->error;
}

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();
?>
