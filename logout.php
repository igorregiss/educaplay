<?php
session_start();

// Destruir a sessão para efetuar o logout
session_destroy();

// Redirecionar o usuário para a página de login (ou qualquer outra página)
header("Location: index.php"); // Substitua "login.php" pelo URL correto da página de login
exit;
?>
