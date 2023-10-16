<?php
require('../../validacoes/config.php');

//recebendo os dados do form
//identificando os dados do formulario do atributo name


$categoria = $_POST['categoria'];


//montar query

$sql = "INSERT INTO categorias (descricao) VALUES('$categoria')";



//executar query no banco

if(mysqli_query($conexao, $sql)){
    header('Location: ../add-categorias.php?msg=sucesso');
}
else{
    header('Location: ../add-user.php?msg=erro');
}

?>