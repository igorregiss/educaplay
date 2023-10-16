<?php
session_start();
require('../validacoes/config.php');


?>

<div class="row">
    <div class="offset-md-1 col-md-10">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>

  <tbody>

  <?php
    $sql = "SELECT * FROM pessoas order by nome ASC";
    $result = mysqli_query($conexao, $sql);

    foreach($result as $r){
      $id = $r['id'];
      $nome = strtoupper($r['nome']);
      $email = strtoupper($r['email']);

      echo "
          <tr>
          <th scope='row'>$id</th>
          <td>$nome</td>
          <td>$email</td>
          <td>
            <a href='atualizar-pessoa.php?id=$id'>
              <button class='btn btn-info btn-sm'>Editar</button>
            </a>

            <a href='acoes/deletar-pessoa.php?id=$id'>
              <button class='btn btn-danger btn-sm'>Excluir</button>
            </a>
          </td>
        </tr>
      ";

    }



  ?>
    
  </tbody>
</table>
    </div>
</div>