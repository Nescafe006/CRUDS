



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="caixa">
        <h1>Login</h1>
        <form action="processar_login.php" method="POST">
            <label for="usuario_email">E-mail:</label>
            <input type="email" id="usuario_email" name="usuario_email" required>

            <label for="usuario_senha">Senha:</label>
            <input type="password" id="usuario_senha" name="usuario_senha" required>

            <input type="submit" value="Entrar">
        </form>
    </div>
</body>
</html>
