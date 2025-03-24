
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Inscrições</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="caixa-preta">
            <h1>Gerenciamento de cursos</h1>
            <br>

            <div class="caixa">
              
                <a href="Form.php"><button>Fazer Inscrição</button></a>    
                <a href="login.php"><button>logout</button></a>  
    
            </div>
        </div>
    </header>

    <div class="caixa">
        <div class="shadowbox">
            <form action="ins_in.php" method="post" class="caixa form">
                <label for="data_inscricao">Data da Inscrição:</label>
                <input type="date" id="data_inscricao" name="data_inscricao" required><br><br>

                <label for="id_aluno">Aluno:</label>
                <select name="id_aluno" id="id_aluno" required>
                    <?php
                    include("conexao.php");
                    $sqlAlunos = "SELECT id_aluno, a_nome FROM aluno";
                    $resultadoAlunos = $conn->query($sqlAlunos);
                    if ($resultadoAlunos->num_rows > 0) {
                        while ($linhaAluno = $resultadoAlunos->fetch_assoc()) {
                            echo "<option value='" . $linhaAluno["id_aluno"] . "'>" . $linhaAluno["a_nome"] . "</option>";
                        }
                    }
                    ?>
                </select><br><br>

                <label for="id_curso">Curso:</label>
                <select name="id_curso" id="id_curso" required>
                    <?php
                    $sqlCursos = "SELECT id_curso, c_nome FROM curso";
                    $resultadoCursos = $conn->query($sqlCursos);
                    if ($resultadoCursos->num_rows > 0) {
                        while ($linhaCurso = $resultadoCursos->fetch_assoc()) {
                            echo "<option value='" . $linhaCurso["id_curso"] . "'>" . $linhaCurso["c_nome"] . "</option>";
                        }
                    }

                    
                    ?>
                </select><br><br>

                <input type="submit" value="Inscrever">
            </form>

            <form action="exclui.php" method="post">
    <label for="nome_excluir">caso queira cancelar, digite o código de sua inscrição fornecido:</label>
    <br>
    <input type="number" id="exclui_inscricao.php" name="exclui_id" required style="width: 300px;"><br>
    <input type="submit" value="cancelar inscrição">
</form>
        </div>
    </div>

</body>
</html>
