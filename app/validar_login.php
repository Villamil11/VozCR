<?php

session_start();

require_once __DIR__ . "/../config/database.php";

$database = new Database();
$db = $database->connect();

$correo = $_POST['correo'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM usuarios WHERE correo = :correo LIMIT 1";

$stmt = $db->prepare($sql);
$stmt->bindParam(':correo', $correo);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify($password, $usuario['password'])) {

    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['correo'] = $usuario['correo'];
    $_SESSION['rol'] = $usuario['rol'];

header("Location: /vozcr/Admin.php");
    exit;

} else {

    echo "Correo o contraseña incorrectos.";
}