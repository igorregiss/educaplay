<?php
require('../includes/validarLogin.php');
require('../../validacoes/config.php');

//recebendo os dados do form
//identificando os dados do formulario do atributo name

$nome = mb_strtoupper($_POST['nome']); //para tratar string->deixar caixa alta e aceitar
//caractere especial

$email = $_POST['email'];
$senha = md5($_POST['senha']);
$dtNasc= $_POST['dtNasc'];

//montar query

$sql = "INSERT INTO pessoas(nome, email, senha,dtNasc) VALUES('$nome', '$email', '$senha', '$dtNasc')";


//executar query no banco

if(mysqli_query($conexao, $sql)){
    header('Location: ../add-user.php?msg=sucesso');
}
else{
    header('Location: ../add-user.php?msg=erro');
}

?>