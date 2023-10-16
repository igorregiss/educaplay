<?php
require('../../validacoes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $idCategorias = $_POST['idCategorias'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $autor = $_POST['autor'];
    $edicao = $_POST['edicao'];

    // Upload da imagem de capa
    $imgCapa = $_FILES['imgCapa']['name'];
    $imgCapaTemp = $_FILES['imgCapa']['tmp_name'];
    $imgCapaPath = '../../assets/images/livro/' . $imgCapa;

    if (move_uploaded_file($imgCapaTemp, $imgCapaPath)) {
        // Query SQL para inserir os dados na tabela livros
        $sql = "INSERT INTO livros (idCategorias, titulo, descricao, imgCapa, autor, edicao) 
                VALUES ('$idCategorias', '$titulo', '$descricao', '$imgCapa', '$autor', '$edicao')";

        if (mysqli_query($conexao, $sql)) {
            header('Location: ../add-livros.php?msg=sucesso');
        } else {
            header('Location: ../add-livros.php?msg=erro');
        }
    } else {
        header('Location: ../add-livros.php?msg=erro_upload');
    }
}
?>
