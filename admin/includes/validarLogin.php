<?php
session_start();

if(!isset($_SESSION['logado'])){
    echo "<script> 
        alert('Ops! Faça login para continuar nessa página!');
        location.href='index.php';
    </script>
    ";
}
?>