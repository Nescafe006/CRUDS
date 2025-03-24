<?php
include("conexao.php");

if (!$conn) {
    echo "<p>Falha na conexão: " . mysqli_connect_error() . "</p>";
}

if (isset($_POST["editar_id"])) {
    $editar_id = $_POST["editar_id"];
    $tipo_edicao = isset($_GET["tipo_edicao"]) ? $_GET["tipo_edicao"] : null;

   
    mysqli_begin_transaction($conn);

    try {
        if ($tipo_edicao === "aluno") {
            $aluno_nome = mysqli_real_escape_string($conn, $_POST["aluno_nome"]);
            $sql = "UPDATE aluno SET a_nome = ? WHERE id_aluno = (SELECT id_alunos FROM inscricao WHERE id_inscricao = ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $aluno_nome, $editar_id);

            if (!$stmt->execute()) {
                throw new Exception("Erro ao atualizar aluno: " . $stmt->error);
            }

            echo "Aluno atualizado com sucesso!";
        } elseif ($tipo_edicao === "curso") {
            $curso_nome = mysqli_real_escape_string($conn, $_POST["curso_nome"]);
            $sql = "UPDATE curso SET c_nome = ? WHERE id_curso = (SELECT id_cursos FROM inscricao WHERE id_inscricao = ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $curso_nome, $editar_id);

            if (!$stmt->execute()) {
                throw new Exception("Erro ao atualizar curso: " . $stmt->error);
            }

            echo "Curso atualizado com sucesso!";
        } elseif ($tipo_edicao === "inscricao") {
            $aluno_nome = mysqli_real_escape_string($conn, $_POST["aluno_nome"]);
            $curso_nome = mysqli_real_escape_string($conn, $_POST["curso_nome"]);
            $data_inscricao = $_POST["data_inscricao"];

           
            $sql_aluno = "SELECT id_aluno FROM aluno WHERE a_nome = ?";
            $stmt = $conn->prepare($sql_aluno);
            $stmt->bind_param("s", $aluno_nome);
            $stmt->execute();
            $resultado_aluno = $stmt->get_result();

            if ($resultado_aluno->num_rows > 0) {
                $linha_aluno = $resultado_aluno->fetch_assoc();
                $id_aluno = $linha_aluno["id_aluno"];
            } else {
                throw new Exception("Erro: Aluno '$aluno_nome' não encontrado.");
            }

          
            $sql_curso = "SELECT id_curso FROM curso WHERE c_nome = ?";
            $stmt = $conn->prepare($sql_curso);
            $stmt->bind_param("s", $curso_nome);
            $stmt->execute();
            $resultado_curso = $stmt->get_result();

            if ($resultado_curso->num_rows > 0) {
                $linha_curso = $resultado_curso->fetch_assoc();
                $id_curso = $linha_curso["id_curso"];
            } else {
                throw new Exception("Erro: Curso '$curso_nome' não encontrado.");
            }

           o
            $sql = "UPDATE inscricao SET id_alunos = ?, id_cursos = ?, data_inscricao = ? WHERE id_inscricao = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iisi", $id_aluno, $id_curso, $data_inscricao, $editar_id);

            if (!$stmt->execute()) {
                throw new Exception("Erro ao atualizar inscrição: " . $stmt->error);
            }

            echo "Inscrição atualizada com sucesso!";
        }

       
        mysqli_commit($conn);
    } catch (Exception $e) {
     
        mysqli_rollBack($conn);
        echo "Erro: " . $e->getMessage();
    }
}
?>
