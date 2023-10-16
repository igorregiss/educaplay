<?php 
require('../../validacoes/config.php');
$id = $_POST['id'];
$descricao = $_POST['descricao'];

$sql = "UPDATE categorias SET descricao = '$descricao' WHERE id = $id";

if(mysqli_query($conexao, $sql)){
    echo "
        <script>
            alert('Alterado com sucesso');
            location.href = '../categorias.php';
        </script>
    ";
}

?>