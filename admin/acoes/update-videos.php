<!--< ?php
require('../../validacoes/config.php');

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = intval($_POST['id']);
    $idCategoria = mysqli_real_escape_string($conexao, $_POST['idCategoria']);
    $titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
    $iframe = mysqli_real_escape_string($conexao, $_POST['iframe']);
    $imgCapa = mysqli_real_escape_string($conexao, $_POST['imgCapa']);
    $creditos = mysqli_real_escape_string($conexao, $_POST['creditos']);
    
    // Construa a consulta SQL
    $sql = "UPDATE videoaula SET idCategoria = '$idCategoria', titulo = '$titulo', iframe = '$iframe', imgCapa = '$imgCapa', creditos = '$creditos' WHERE id = $id";
    
    // Execute a consulta SQL e verifique se foi bem-sucedida
    if (mysqli_query($conexao, $sql)) {
        echo "
            <script>
                alert('Alterado com sucesso');
                location.href = '../videos.php';
            </script>
        ";
    } else {
        echo "Erro na atualização: " . mysqli_error($conexao);
    }
} else {
    echo "ID não foi fornecido corretamente.";
}
?>
-->

<?php
require('../../validacoes/config.php');

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = intval($_POST['id']);
    $idCategoria = mysqli_real_escape_string($conexao, $_POST['idCategoria']);
    $titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
    $iframe = mysqli_real_escape_string($conexao, $_POST['iframe']);
    $creditos = mysqli_real_escape_string($conexao, $_POST['creditos']);
    
    // Verifique se um novo arquivo de imagem foi enviado
    if (isset($_FILES['novaImgCapa']['name']) && !empty($_FILES['novaImgCapa']['name'])) {
        // Lógica para processar o upload do novo arquivo de imagem e salvar no armazenamento
        $uploadDir = '../../assets/images/videoaula/'; // Substitua pelo caminho real do armazenamento
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
    $sql = "UPDATE videoaula SET idCategoria = '$idCategoria', titulo = '$titulo', iframe = '$iframe', creditos = '$creditos'";
    if (isset($imgCapa)) {
        $sql .= ", imgCapa = '$imgCapa'";
    }
    $sql .= " WHERE id = $id";
    
    // Execute a consulta SQL e verifique se foi bem-sucedida
    if (mysqli_query($conexao, $sql)) {
        echo "
            <script>
                alert('Alterado com sucesso');
                location.href = '../videos.php';
            </script>
        ";
    } else {
        echo "Erro na atualização: " . mysqli_error($conexao);
    }
} else {
    echo "ID não foi fornecido corretamente.";
}
?>
