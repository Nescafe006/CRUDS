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

<body>
    <div class="caixa">
    <form action ="c_in.php" method="post">

    <label for ="nome">nome:</label>
    <input type="text" id="nome" name="nome">

    <label for ="descricao">descricao:</label>
    <input type="text" id="descricao" name="descricao">

    <label for ="carga">Carga horária:</label>
    <input type="number" id="carga" name="carga">

    
    <label for ="instrutor">Instrutor:</label>
    <input type="text" id="instrutor" name="instrutor">



  <input type="submit" value="cadastrar">
    </form>



    <form action="excluic.php" method="post">
        <label for="id_excluir">id do aluno:</label>
        <br>
        <input type="number" id="id_excluir" name="id_excluir" required style="width: 300px;"><br>
        <input type="submit" value="Excluir curso">
    </form>


</div>


    
</body>
</html>