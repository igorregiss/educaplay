<?php
require('../../validacoes/config.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    if(isset($_POST['btnExcluir'])){
        $sql = "DELETE FROM livros WHERE id = $id";

        if(mysqli_query($conexao, $sql)){
            echo "
                <script>
                    alert('Livro queimado!');
                    location.href = '../livros.php';
                </script>
            ";
        }
    }
}
?>

<!-- Adicione o modal no final da página -->
<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalExcluirLabel">Confirmação de Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Deseja realmente excluir este livro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form method="post">
                    <button type="submit" class="btn btn-danger" name="btnExcluir">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<!-- Adicione o código JavaScript abaixo para abrir o modal automaticamente -->
<script>
    $(document).ready(function(){
        $('#modalExcluir').modal('show');
    });

    // Redirecionar para usuarios.php ao clicar em Cancelar
    $('#modalExcluir').on('hidden.bs.modal', function(){
        location.href = '../livros.php';
    });
</script>
