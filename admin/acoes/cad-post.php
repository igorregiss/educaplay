<?php
require('../includes/validarLogin.php');
require('../includes/conexao.php');

//recebendo os dados do form
//identificando os dados do formulario do atributo name
$nome=$_SESSION['idPessoa'];
$titulo = $_POST['titulo'];
$categoria = $_POST['categoria'];
$conteudo = $_POST['conteudo'];
$dtPublicacao = date('Y-m-d H:i:s');



//montar query


$sql = "INSERT INTO posts(idPessoa, idCategoria, titulo, conteudo, dtPublicacao)
 VALUES('$nome', '$categoria', '$titulo', '$conteudo', '$dtPublicacao')";




//executar query no banco

if(mysqli_query($conexao, $sql)){
    header('Location: ../add-post.php?msg=sucesso');
}
else{
    header('Location: ../add-post.php?msg=erro');
}

?>