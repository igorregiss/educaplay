<?php
require('../../validacoes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $idCategoria = $_POST['idCategoria'];
    $titulo = $_POST['titulo'];
    $iframe = $_POST['iframe'];
    $creditos = $_POST['creditos'];

    // Upload da imagem de capa
    $imgCapa = $_FILES['imgCapa']['name'];
    $imgCapaTemp = $_FILES['imgCapa']['tmp_name'];
    $imgCapaPath = '../../assets/images/videoaula/' . $imgCapa;

    if (move_uploaded_file($imgCapaTemp, $imgCapaPath)) {
        // Query SQL para inserir os dados na tabela videoaula
        $sql = "INSERT INTO videoaula (idCategoria, titulo, iframe, imgCapa, creditos) 
                VALUES ('$idCategoria', '$titulo', '$iframe', '$imgCapa', '$creditos')";

        if (mysqli_query($conexao, $sql)) {
            header('Location: ../add-videos.php?msg=sucesso');
        } else {
            header('Location: ../add-videos.php?msg=erro');
        }
    } else {
        header('Location: ../add-videos.php?msg=erro_upload');
    }
}
?>
