<?php
require('../../validacoes/config.php');

$email = $_POST['email'];
$senha = md5($_POST['senha']);

$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha' AND cargo = 1";

$resultado = mysqli_query($conexao, $sql);

if ($resultado) {
    $numLinhas = mysqli_num_rows($resultado);

    if ($numLinhas > 0) {
        session_start();
        $_SESSION['logado'] = true;

        // Obtenha os dados do usuário
        $dados = mysqli_fetch_assoc($resultado);
        $_SESSION['nome'] = $dados['nome'];
        $_SESSION['idUsuario'] = $dados['id'];

        echo "
        <script>
            location.href='../principal.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Ops! Dados incorretos ou você não tem permissão para acessar.');
            location.href ='../index.php';
        </script>
        ";
    }
} else {
    echo "
    <script>
        alert('Ops! Ocorreu um erro no servidor.');
        location.href ='../index.php';
    </script>
    ";
}

?>
