<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php"); 
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
$query = "SELECT nomeUsuario FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $nomeUsuario = htmlspecialchars($user["nomeUsuario"]);
} else {
    echo "Erro ao carregar as informações do usuário.";
    exit();
}

$stmt->close();
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, <?php echo $nomeUsuario; ?>!</h1>
        <p>Você está logado no sistema.</p>
        <div class="buttons">
            <form method="post" action="../src/logout.php">
                <button type="submit" class="btn">Logout</button>
            </form>
            
            <form method="post" action="../src/delete_account.php">
                <button type="submit" class="btn">Deletar Conta</button>
            </form>
        </div>
    </div>
</body>
</html>
