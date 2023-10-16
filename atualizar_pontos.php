<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Certifique-se de que o usuário esteja autenticado e o ID do usuário esteja definido na sessão
    if (isset($_SESSION['usuario_id'])) {
        $usuario_id = $_SESSION['usuario_id'];

        // Atualize o valor na coluna "totalVideos" na tabela "usuarios"
        require('validacoes/config.php');
        $sql = "UPDATE usuarios SET totalVideos = totalVideos + 1 WHERE id = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "i", $usuario_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "Pontos atualizados com sucesso!";
        } else {
            echo "Erro ao atualizar pontos.";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Usuário não autenticado.";
    }
} else {
    echo "Requisição inválida.";
}
?>
