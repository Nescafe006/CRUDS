<?php
include("conexao.php");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["data_inscricao"]) && isset($_POST["id_aluno"]) && isset($_POST["id_curso"])) {
     
        $id_aluno = $_POST["id_aluno"];
        $id_curso = $_POST["id_curso"];
        $data_inscricao = $_POST["data_inscricao"];

       
        $data_formatada = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $data_inscricao)));

        
        $stmt = $conn->prepare("INSERT INTO inscricao (id_alunos, id_cursos, data_inscricao) VALUES (?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("iis", $id_aluno, $id_curso, $data_formatada);
            if ($stmt->execute()) {
             
                echo "<script>alert('Inscrição realizada com sucesso!'); window.location.href='form.php';</script>";
            } else {
             
                echo "Erro ao realizar a inscrição: " . $stmt->error;
            }

        
            $stmt->close();
        } else {
            echo "Erro ao preparar a declaração: " . $conn->error;
        }
    } else {
     
        echo "Erro: Dados do formulário incompletos.";
    }
}


mysqli_close($conn);
?>
