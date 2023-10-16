<?php
require('../includes/conexao.php');
require('../includes/validarLogin.php');

// Verifique se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se um ID de livro válido foi enviado no formulário
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $idCategoria = $_POST['idCategorias'];
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $autor = $_POST['autor'];
        $edicao = $_POST['edicao'];

        // Verifique se um novo arquivo de imagem de capa foi enviado
        if ($_FILES['imgCapa']['size'] > 0) {
            // Um novo arquivo de imagem de capa foi enviado
            // Lide com o upload do novo arquivo de imagem aqui
            // Por exemplo, você pode usar move_uploaded_file para mover o arquivo para o diretório desejado
            $newImagePath = '../../assets/images/livro/'; // Defina o caminho correto

            // Construa o caminho completo do arquivo de imagem com um nome único
            $newImageName = uniqid() . '_' . $_FILES['imgCapa']['name'];
            $newImagePath .= $newImageName;

            if (move_uploaded_file($_FILES['imgCapa']['tmp_name'], $newImagePath)) {
                // O arquivo foi carregado com sucesso

                // Agora, atualize o campo de imagem de capa no banco de dados com o nome do novo arquivo
                $updateImageSql = "UPDATE livros SET imgCapa = ? WHERE id = ?";
                $stmt2 = mysqli_prepare($conexao, $updateImageSql);
                mysqli_stmt_bind_param($stmt2, "si", $newImageName, $id);
                mysqli_stmt_execute($stmt2);

                // Feche a consulta preparada
                mysqli_stmt_close($stmt2);
            } else {
                echo '<script>alert("Erro no upload da imagem.");</script>';
                exit();
            }
        }

        // Consulta SQL para atualizar os campos do livro (exceto a imagem de capa)
        $sql = "UPDATE livros SET idCategorias = ?, titulo = ?, descricao = ?, autor = ?, edicao = ? WHERE id = ?";

        // Preparar a consulta
        $stmt = mysqli_prepare($conexao, $sql);

        // Vincular os parâmetros
        mysqli_stmt_bind_param($stmt, "issssi", $idCategoria, $titulo, $descricao, $autor, $edicao, $id);

        // Executar a consulta para atualizar os campos, exceto a imagem de capa
        if (mysqli_stmt_execute($stmt)) {
            // Use um alert JavaScript para notificar o usuário sobre o sucesso
            echo '<script>alert("Alterado com sucesso");</script>';
            echo '<script>location.href = "../livros.php";</script>';
        } else {
            // Use um alert JavaScript para notificar o usuário sobre o erro
            echo '<script>alert("Erro ao atualizar o livro");</script>';
        }

        // Feche a consulta preparada
        mysqli_stmt_close($stmt);
    }
} else {
    // Use um alert JavaScript para notificar o usuário sobre o erro
    echo '<script>alert("Erro: formulário não foi submetido corretamente");</script>';
}
?>
