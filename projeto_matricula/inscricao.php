





<!DOCTYPE html>
<html lang="pt-br">
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
              
                <a href="inscricoes.php"><button>inscricoes</button></a>

                <a href="login.php"><button>logout</button></a>   
            </div>

        </div>
    </header>

    <body>
    <div class="container">

        <h2>Gerenciamento de cursos</h2>

        <h2>Consultar inscrições</h2>
    <form action="inscricao.php" method="post">
    <label for="id_inscricao">ID da inscrição:</label>
    <input type="number" id="id_inscricao" name="id_inscricao"><br><br>

    <label for="nome_aluno">Nome do aluno:</label>
    <input type="text" id="nome_aluno" name="nome_aluno"><br><br>

    <label for="nome_curso">Nome do curso:</label>
    <input type="text" id="nome_curso" name="nome_curso"><br><br>

    <input type="submit" value="Consultar">
</form>
                <div id="resultadoConsulta">
    <?php
    include("conexao.php");

    if (!$conn) {
        echo "<p>Falha na conexão: " . mysqli_connect_error() . "</p>";
    }

   
    if (isset($_POST["editar_id"])) {
        include("alt_inscricao.php"); 
    }
    
    if (isset($_GET["excluir_id"])) {
        include("exclui_inscricao.php"); 
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["nova_inscricao"])) {
          
            $aluno_nome = mysqli_real_escape_string($conn, $_POST["aluno_nome"]);
            $curso_nome = mysqli_real_escape_string($conn, $_POST["curso_nome"]);
            $data_inscricao = $_POST["data_inscricao"];

       
            $sql_aluno = "SELECT id_aluno FROM aluno WHERE a_nome = '$aluno_nome'";
            $resultado_aluno = mysqli_query($conn, $sql_aluno);

            if (mysqli_num_rows($resultado_aluno) > 0) {
                $linha_aluno = mysqli_fetch_assoc($resultado_aluno);
                $id_aluno = $linha_aluno["id_aluno"];

            
                $sql_curso = "SELECT id_curso FROM curso WHERE c_nome = '$curso_nome'";
                $resultado_curso = mysqli_query($conn, $sql_curso);

                if (mysqli_num_rows($resultado_curso) > 0) {
                    $linha_curso = mysqli_fetch_assoc($resultado_curso);
                    $id_curso = $linha_curso["id_curso"];

                   
                    $sql_inserir = "INSERT INTO inscricao (id_alunos, id_cursos, data_inscricao) 
                                    VALUES ($id_aluno, $id_curso, '$data_inscricao')";

                    if (mysqli_query($conn, $sql_inserir)) {
                        echo "Inscrição realizada com sucesso!";
                    } else {
                        echo "Erro ao realizar inscrição: " . mysqli_error($conn);
                    }
                } else {
                    echo "Erro: Curso '$curso_nome' não encontrado.";
                }
            } else {
                echo "Erro: Aluno '$aluno_nome' não encontrado.";
            }
        } else {
         
            $id_inscricao = isset($_POST["id_inscricao"]) && $_POST["id_inscricao"] !== '' ? $_POST["id_inscricao"] : null;
            $nome_aluno = isset($_POST["nome_aluno"]) && $_POST["nome_aluno"] !== '' ? $_POST["nome_aluno"] : null;
            $nome_curso = isset($_POST["nome_curso"]) && $_POST["nome_curso"] !== '' ? $_POST["nome_curso"] : null;

            $sql = "SELECT i.id_inscricao, a.a_nome, c.c_nome, i.data_inscricao
                    FROM inscricao i
                    INNER JOIN aluno a ON i.id_alunos = a.id_aluno
                    INNER JOIN curso c ON i.id_cursos = c.id_curso
                    WHERE 1=1";

            if (!empty($id_inscricao)) {
                $sql .= " AND i.id_inscricao = " . intval($id_inscricao);
            }

            if (!empty($nome_aluno)) {
                $sql .= " AND a.a_nome LIKE '%" . mysqli_real_escape_string($conn, $nome_aluno) . "%'";
            }

            if (!empty($nome_curso)) {
                $sql .= " AND c.c_nome LIKE '%" . mysqli_real_escape_string($conn, $nome_curso) . "%'";
            }

            $resultado = mysqli_query($conn, $sql);

            if ($resultado && mysqli_num_rows($resultado) > 0) {
                echo "<h2>Resultado da Consulta:</h2>";
                echo "<table>";
                echo "<tr><th>ID Inscrição</th><th>Aluno</th><th>Curso</th><th>Data da Inscrição</th><th>Ações</th></tr>";

                while ($linha = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $linha["id_inscricao"] . "</td>";
                    echo "<td>" . $linha["a_nome"] . "</td>";
                    echo "<td>" . $linha["c_nome"] . "</td>";
                    echo "<td>" . $linha["data_inscricao"] . "</td>";
                    echo "<td>
                            <a href='inscricoes.php?excluir_id=" . $linha["id_inscricao"] . "'>Excluir</a>
                            <a href='inscricoes.php?editar_id=" . $linha["id_inscricao"] . "'>Editar</a>
                          </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Nenhuma inscrição encontrada.</p>";
            }
        }
    }

    
    if (isset($_GET["editar_id"])) {
        $editar_id = $_GET["editar_id"];
        $stmt = $conn->prepare("SELECT i.id_inscricao, a.a_nome, c.c_nome, i.data_inscricao 
                                FROM inscricao i 
                                INNER JOIN aluno a ON i.id_alunos = a.id_aluno
                                INNER JOIN curso c ON i.id_cursos = c.id_curso 
                                WHERE i.id_inscricao = ?");
        $stmt->bind_param("i", $editar_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $linha = $resultado->fetch_assoc();

        echo "<div class='shadowbox'>";
        echo "<h2>Editar Inscrição</h2>";
        echo "<form method='post' action='inscricoes.php'>";
        echo "<input type='hidden' name='editar_id' value='" . $linha["id_inscricao"] . "'>";
        echo "<label>Aluno:</label><input type='text' name='aluno_nome' value='" . $linha["a_nome"] . "'><br>";
        echo "<label>Curso:</label><input type='text' name='curso_nome' value='" . $linha["c_nome"] . "'><br>";
        echo "<label>Data da Inscrição:</label><input type='date' name='data_inscricao' value='" . $linha["data_inscricao"] . "'><br>";
        echo "<input type='submit' value='Salvar'>";
        echo "</form>";
        echo "</div>";
    }

   
    if (isset($conn) && $conn) {
        mysqli_close($conn);
    }
    ?>
</div>




    </div>
</body>
</html>