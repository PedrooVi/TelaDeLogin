<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar-se</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Crie sua conta</h1>
        <?php
        require_once('../src/registro.php');
        ?>
        <form method="post" action="../src/registro.php">
            <div class="inputs">
                <label for="nome">Nome completo</label>
                <input name="nome" type="text" required onsubmit="verificarDados()" />
            </div>
            <div class="inputs">
                <label for="email">Email</label>
                <input id="register-email" name="email" type="text" required />
            </div>
            <div class="inputs">
                <label for="confirm-email">Confirmar email</label>
                <input id="confirm-email" name="confirm-email" type="text" required />
            </div>
            <div class="inputs">
                <label for="username">Nome de usuário</label>
                <input name="username" type="text" required />
            </div>
            <div class="inputs">
                <label for="password">Senha</label>
                <input id="password-register" name="password" type="password" required />
            </div>
            <div class="inputs">
                <label for="confirm-password">Confirmar senha</label>
                <input id="password-confirm" name="confirm-password" type="password" required />
            </div>
            <button id="btn-cadastrar" type="submit" class="btn">Criar conta</button>
        </form>
    </div>
    </body>
</body>
</html>