<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.html");
    exit();
}

$servidor = getenv('DB_SERVER');
$usuario = getenv('DB_USER');
$senhaBd = getenv('DB_PASS');
$nomeBancoDeDados = getenv('DB_NAME');
$porta = getenv('DB_PORT');

$conn = mysqli_connect($servidor, $usuario, $senhaBd, $nomeBancoDeDados, $porta);

if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

$email = $_SESSION["login"];
$query = "DELETE FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    session_destroy(); 
    header("Location: ../index.php"); 
    exit();
} else {
    echo "Erro ao deletar a conta: " . $stmt->error;
}

$stmt->close();
mysqli_close($conn);
?>
