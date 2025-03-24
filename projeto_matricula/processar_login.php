<?php
session_start();
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario_email = mysqli_real_escape_string($conn, $_POST["usuario_email"]);
    $senha = mysqli_real_escape_string($conn, $_POST["usuario_senha"]);

   
    $sql = "SELECT * FROM usuarios WHERE usuario_email = '$usuario_email' LIMIT 1";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

       
        if (md5($senha) === $usuario['usuario_senha']) {
            
          
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['usuario_nome'] = $usuario['usuario_nome'];
            $_SESSION['usuario_email'] = $usuario['usuario_email'];
            $_SESSION['usuario_tipo'] = $usuario['usuario_tipo'];

         
            if ($_SESSION['usuario_tipo'] === 'admin') {
                header("Location: index.php"); 
            } else {
                header("Location: form.php"); 
            }
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário com esse e-mail não encontrado!";
    }
}

mysqli_close($conn);
?>
