<?php
$servidor = getenv('DB_SERVER');
$usuario = getenv('DB_USER');
$senhaBd = getenv('DB_PASS');
$nomeBancoDeDados = getenv('DB_NAME');
$porta = getenv('DB_PORT');


$conn = mysqli_connect($servidor, $usuario, $senhaBd, $nomeBancoDeDados, $porta);

if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nomeCompleto = trim($_POST["nome"] ?? "");
    $emailRegistro = trim($_POST["email"] ?? "");
    $nomeDeUsuario = trim($_POST["username"] ?? "");
    $senha = trim($_POST["password"] ?? "");

    if (strlen($senha) < 8 || strlen($senha) > 16) {
        echo "A senha deve ter entre 8 e 16 caracteres.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? OR nomeUsuario = ?");
        $stmt->bind_param("ss", $emailRegistro, $nomeDeUsuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Não foi possível concluir o cadastro. Verifique os dados.";
        } else {
            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO usuarios (nomeCompleto, email, nomeUsuario, senha) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nomeCompleto, $emailRegistro, $nomeDeUsuario, $senhaCriptografada);

            if ($stmt->execute()) {
                session_start();
                $_SESSION["login"] = $emailRegistro;
                header("Location: ../pags/sucesso.php");
                exit();
            } else {
                echo "Erro ao cadastrar usuário: " . $stmt->error;
            }
        }
    }

    $stmt->close();
}

mysqli_close($conn);
?>
