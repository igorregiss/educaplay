<?php
require('../../validacoes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $idCategoria = $_POST['idCategoria'];
    $titulo = $_POST['titulo'];
    $iframe = $_POST['iframe'];
    $autoria = $_POST['autoria'];

    // Upload da imagem de capa
    $imgCapa = $_FILES['imgCapa']['name'];
    $imgCapaTemp = $_FILES['imgCapa']['tmp_name'];
    $imgCapaPath = '../../assets/images/jogos/' . $imgCapa;

    if (move_uploaded_file($imgCapaTemp, $imgCapaPath)) {
        // Query SQL para inserir os dados na tabela videoaula
        $sql = "INSERT INTO jogos (idCategoria, titulo, iframe, imgCapa, autoria) 
                VALUES ('$idCategoria', '$titulo', '$iframe', '$imgCapa', '$autoria')";

        if (mysqli_query($conexao, $sql)) {
            header('Location: ../add-jogos.php?msg=sucesso');
        } else {
            header('Location: ../add-jogos.php?msg=erro');
        }
    } else {
        header('Location: ../add-jogos.php?msg=erro_upload');
    }
}
?>
