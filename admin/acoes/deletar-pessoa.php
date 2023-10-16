<?php
    require('../includes/validarLogin.php');
    require('../includes/conexao.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];


        $sql = "DELETE FROM pessoas WHERE id = $id";

        if(mysqli_query($conexao, $sql)){
            echo "
                <script>
                    alert('Deletado com sucesso');
                    location.href='../listar-pessoas.php';
                </script>
            ";
        }
    }

?>