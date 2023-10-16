<?php 
require('../includes/conexao.php');
session_start();
$id = $_POST['idPost'];
$idCategoria = $_POST['idCategoria'];
$titulo = $_POST['titulo'];
$conteudo = $_POST['conteudo'];
$dtPublicacao= $_POST['dtPublicacao'];
$idPessoa = $_SESSION['nome'];
$sql = "
    UPDATE posts SET idPessoa = '$idPessoa', idCategoria = '$idCategoria', titulo = '$titulo', conteudo = '$conteudo', dtPublicacao = '$dtPublicacao' WHERE id = $id
";

if(mysqli_query($conexao, $sql)){
    echo "
        <script>
            alert('Alterado com sucesso');
            location.href = '../posts.php';
        </script>
    ";
}

?>