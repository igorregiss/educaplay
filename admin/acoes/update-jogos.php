<?php
require('../../validacoes/config.php');

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = intval($_POST['id']);
    $idCategoria = mysqli_real_escape_string($conexao, $_POST['idCategoria']);
    $titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
    $iframe = mysqli_real_escape_string($conexao, $_POST['iframe']);
    $autoria = mysqli_real_escape_string($conexao, $_POST['autoria']);
    
    // Verifique se um novo arquivo de imagem foi enviado
    if (isset($_FILES['novaImgCapa']['name']) && !empty($_FILES['novaImgCapa']['name'])) {
        // Lógica para processar o upload do novo arquivo de imagem e salvar no armazenamento
        $uploadDir = '../../assets/images/jogos/'; // Substitua pelo caminho real do armazenamento
        $uploadFile = $uploadDir . basename($_FILES['novaImgCapa']['name']);

        if (move_uploaded_file($_FILES['novaImgCapa']['tmp_name'], $uploadFile)) {
            // O arquivo foi carregado com sucesso

            // Atualize o campo de imagem de capa no banco de dados
            $imgCapa =  $_FILES['novaImgCapa']['name'];
        } else {
            echo "Erro no upload da imagem.";
            exit();
        }
    }
    
    // Construa a consulta SQL com os dados atualizados
    $sql = "UPDATE jogos SET idCategoria = '$idCategoria', titulo = '$titulo', iframe = '$iframe', autoria = '$autoria'";
    if (isset($imgCapa)) {
        $sql .= ", imgCapa = '$imgCapa'";
    }
    $sql .= " WHERE id = $id";
    
    // Execute a consulta SQL e verifique se foi bem-sucedida
    if (mysqli_query($conexao, $sql)) {
        echo "
            <script>
                alert('Alterado com sucesso');
                location.href = '../jogos.php';
            </script>
        ";
    } else {
        echo "Erro na atualização: " . mysqli_error($conexao);
    }
} else {
    echo "ID não foi fornecido corretamente.";
}
?>
