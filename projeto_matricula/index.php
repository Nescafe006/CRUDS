<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de cursos</title>
    <link rel="stylesheet" href="styles.css">
</head>


    <header>
        <div class="caixa-preta">
            <h1>GERENCIAMENTO DE CURSOS</h1>
            <br>

            <div class="caixa">
                <a href="index.php"><button>Cadastrar Aluno</button></a>
                <a href="curso.php"><button>Cadastrar Curso</button></a>
          
                <a href="inscricao.php"><button>inscricoes</button></a>
                
                <a href="login.php"><button>logout</button></a>   
            </div>


        </div>
        
    </header>

</html>


<body>

    <div class="caixa">
        
   <form action ="a_in.php" method="post">

    <label for ="nome">nome:</label>
    <input type="text" id="nome" name="nome">

    <label for ="email">email:</label>
    <input type="text" id="email" name="email">

    <label for ="telefone">telefone:</label>
    <input type="text" id="telefone" name="telefone">


<input type="submit" value="cadastrar">

</form>

<form action="exclui.php" method="post">
    <label for="nome_excluir">id do aluno:</label>
    <br>
    <input type="number" id="nome_excluir" name="nome_excluir" required style="width: 300px;"><br>
    <input type="submit" value="Excluir Usuário">
</form>

</div>
    
</body>
</html>