<?php
$servername = "localhost";
$username = "visaog61_cezar";
$password = "hr7RYaR*Ff^.";
$dbname = "visaog61_ZenZoneMart";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
