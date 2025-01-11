<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Faça Login</h1>
        <?php
        require_once('src/login.php')
        ?>
        <form id="form-login" action="src/login.php" method="post">
            <div class="inputs">
                <label for="email">Email</label>
                <input name="email" type="text" required />
              </div>
              <div class="inputs">
                <label for="password">Senha</label>
                <input id="senha" name="password" type="password" required/>
              </div>
      
              <div class="checkbox">
                <input type="checkbox" id="check" />
                <label id="label-check" for="check">Mostar senha</label>
              </div>
      
              <button type="submit" class="btn">Fazer login</button>
              <p class="text">
                Não possui conta? <a id="btn-registrar" href="pags/registrar.php">Registre-se</a>
              </p>
        </form>
    </div>
    <script src="src/script.js""></script>
</body>
</html>