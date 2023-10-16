<?php
session_start();

// Verifique se o usuário está logado
if (isset($_SESSION['id'])) {
    $idDoUsuario = $_SESSION['id'];

    // Conexão com o banco de dados (substitua as informações de conexão)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "educaplay";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão com o banco de dados
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Verificar se o usuário já visitou a página
    if (isset($_SESSION['ultima_visita'])) {
        $tempoDecorrido = time() - $_SESSION['ultima_visita'];
    } else {
        $tempoDecorrido = 0;
    }

    // Definir o tempo mínimo entre as atualizações (em segundos)
    $tempoMinimo = 0; // 10 segundos (ou o valor desejado)

    // Verificar se o tempo decorrido é maior ou igual ao tempo mínimo
    if ($tempoDecorrido >= $tempoMinimo) {
        // Atualizar a hora da última visita
        $_SESSION['ultima_visita'] = time();

        // Incrementar a coluna totalJogos na tabela usuarios
        $sql = "UPDATE usuarios SET totalJogos = totalJogos + 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("i", $idDoUsuario);

        if ($stmt->execute()) {
            echo "Total de jogos incrementado para o usuário com ID " . $idDoUsuario;
        } else {
            echo "Erro na atualização do total de jogos: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Tempo mínimo entre as atualizações não foi atingido.";
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
} else {
    echo "Usuário não está logado."; // Ou redirecione para a página de login
}
?>
