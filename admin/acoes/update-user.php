<?php 
require('../includes/conexao.php');
session_start();

// Verifica se os campos foram enviados via POST
if(isset($_POST['id'], $_POST['nome'], $_POST['email'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Use prepared statements para evitar injeção de SQL
    $sql = "UPDATE pessoas SET nome = ?, email = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $nome, $email, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "
                <script>
                    alert('Alterado com sucesso');
                    location.href = '../posts.php';
                </script>
            ";
        } else {
            echo "Erro ao executar a consulta: " . mysqli_error($conexao);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Erro na preparação da consulta: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
} else {
    echo "Campos não foram enviados corretamente.";
}
?>
