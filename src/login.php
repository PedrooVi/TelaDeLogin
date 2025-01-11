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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = isset($_POST["email"]) ? mysqli_real_escape_string($conn, $_POST["email"]) : "";
    $senha = isset($_POST["password"]) ? $_POST["password"] : "";

    $query = "SELECT senha FROM usuarios WHERE email = '$login'";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
        $hashSenha = $row["senha"];

        if (password_verify($senha, $hashSenha)) {
            session_start();
            $_SESSION["login"] = $login;
            header('Location: ../pags/sucesso.php');
            exit();
        } else {
            echo "Senha incorreta.";
        }
    } else {

        echo "Usuário não cadastrado.";
    }

    mysqli_close($conn);
}
?>
