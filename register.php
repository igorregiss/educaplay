<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include ('validacoes/config.php');

  $nome = $_POST['nome'];
  $dtNascimento = $_POST['dtNascimento'];
  $email = $_POST['email'];
  $senha = md5($_POST['senha']);  // Calcula o hash MD5 da senha
  $telefone = $_POST['telefone'];  // Adicionando a leitura do campo "telefone"

  // Verificar se o email já está em uso
  $sql_check_email = 'SELECT id FROM usuarios WHERE email = ?';
  $stmt_check_email = $conexao->prepare($sql_check_email);
  $stmt_check_email->bind_param('s', $email);
  $stmt_check_email->execute();
  $result_check_email = $stmt_check_email->get_result();

  if ($result_check_email->num_rows > 0) {
    $erro = 'O email já está em uso. Escolha outro email.';
  } else {
    // Inserir novo usuário no banco de dados com o cargo igual a 0
    $sql_insert = 'INSERT INTO usuarios (nome, dtNascimento, email, senha, telefone, cargo, totalLivros, totalJogos, totalVideos) VALUES (?, ?, ?, ?, ?, 0, 0, 0, 0)';
    $stmt_insert = $conexao->prepare($sql_insert);
    $stmt_insert->bind_param('sssss', $nome, $dtNascimento, $email, $senha, $telefone);

    if ($stmt_insert->execute()) {
      // Cadastro bem-sucedido
      $_SESSION['id'] = $stmt_insert->insert_id;
      $_SESSION['nome'] = $nome;
      header('Location: index.php');
    } else {
      // Falha no cadastro
      $erro = 'Cadastro falhou. Por favor, tente novamente mais tarde.';
    }

    $stmt_insert->close();
  }

  $stmt_check_email->close();
  $conexao->close();
}
?>


<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>EducaPlay - Aprenda online</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--

TemplateMo 579 Cyborg Gaming

https://templatemo.com/tm-579-cyborg-gaming


TemplateMo 579 Cyborg Gaming

https://templatemo.com/tm-579-cyborg-gaming

-->
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="index.php" class="logo">
                          <img src="assets/images/logo.png" alt="">
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Search End ***** -->
                      <div class="search-input">
                        <form id="search" action="#">
                          <input type="text" placeholder="Buscar" id='searchText' name="searchKeyword" onkeypress="handle" />
                          <i class="fa fa-search"></i>
                        </form>
                      </div>
                      <!-- ***** Search End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                      <li><a href="index.php">Inicio</a></li>
                      <li><a href="jogos.php">Jogos</a></li>
                      <li><a href="livros.php">Livros</a></li>
                      <li><a href="videos.php">Videos</a></li>
                      <li><a href="contato.php">Contato</a></li>

                      <?php

                        // Verificar se o usuário está logado
                        if (isset($_SESSION['nome'])) {
                          // Usuário está logado
                          echo '  <li><a href="perfil.php"><i class="bi bi-person-fill"></i> ' . $_SESSION['nome'] . '</a></li>';
                          echo '  <li><a href="logout.php">Sair</a></li>';
                        } else {
                          // Usuário não está logado
                          echo '<li class="login-link"> <a href="login.php" class="active"><i class="bi bi-person-fill"></i> Entrar</a></li>';
                        }
                      ?>
                    </ul>      
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                      <!-- ***** Menu End ***** -->
                  </nav>
              </div>
          </div>
      </div>
    </header>
    <!-- ***** Header Area End ***** -->


  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">



          <!-- ***** Details Start ***** -->
          <div class="game-details">
            <div class="row">
            
              <div class="container">
                <div class="row">
                
          <!-- ***** Featured Start ***** -->
              <div class="header-text">

          <div class="col-sm-6 col-xs-6 col-md-6 mx-auto text-center">            
                        
                       <?php if (isset($erro)) { echo "<p>$erro</p>"; } ?>
                       <form class="form-signin" class="form-horizontal" method="post" action="register.php">
    <label class=""> Nome </label>
    <input name="nome" type="text" class="form-control" placeholder="" required autofocus>

    <label class=""> Data de Nascimento </label>
    <input name="dtNascimento" type="date" class="form-control" placeholder="" required>

    <label class=""> Informe seu email </label>
    <input id="email" name="email" type="email" class="form-control" placeholder="" required autofocus>

    <label class=""> Confirme seu email </label>
    <input id="confirmEmail" type="email" class="form-control" placeholder="" required autofocus>

    <label class=""> Informe sua senha </label>
    <input id="senha" name="senha" type="password" class="form-control" placeholder="" required>

    <label class=""> Confirme sua senha </label>
    <input id="confirmSenha" type="password" class="form-control" placeholder="" required>

    <label class=""> Telefone </label>
    <input id="telefone" name="telefone" type="tel" class="form-control" placeholder="+55 (00) 0 0000-0000" required>

    <button class="button btn btn-lg btn-block" type="submit" value="Registrar" style="border-radius: 20px;">
        Cadastrar-se
    </button>
</form>

                        
                      
                        <p class="text-center"> Já tem uma conta?  <a href="./login.php"  data-toggle="modal" data-target="#myModal"> Efetuar login!</a></p>
                       
        
                    </div>
                    </div>

                    


            </div>
          </div>
          <!-- ***** Details End ***** -->


        </div>
      </div>
    </div>
  </div>
  
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2023 <a href="#">EducaPlay</a>. Todos os direitos reservados. 
          
          <br>Desenvolvido por: <a href="https://igorregis.com" target="_blank" title="Portfolio de Igor Régis">Igor Régis</a>, Junior Lima, Verocina Lima, Maria Vanessa, Catiana Araujo e Elika Silva.</p>
        </div>
      </div>
    </div>
  </footer>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>


  <script>
$(document).ready(function() {
    // Inicializa o campo de telefone com +55
    $('#telefone').val('+55 ');

    // Formatar automaticamente o campo de telefone
    $('#telefone').on('input', function() {
        var telefone = $('#telefone').val();

        // Remover todos os caracteres não numéricos
        telefone = telefone.replace(/\D/g, '');

        // Formatar como +55 (xx) x xxxx-xxxx
        if (telefone.length > 2) {
            telefone = '+55 (' + telefone.substring(2, 4) + ') ' + telefone.substring(4, 8) + '-' + telefone.substring(8, 12);
        }

        $('#telefone').val(telefone);
    });
   // Verificar senha e confirmação de senha
   $('#senha, #confirmSenha').on('keyup', function() {
        var senha = $('#senha').val();
        var confirmSenha = $('#confirmSenha').val();
        
        if (senha !== confirmSenha) {
            $('#senha, #confirmSenha').addClass('is-invalid');
        } else {
            $('#senha, #confirmSenha').removeClass('is-invalid');
        }
    });
    // Verificar e-mail e confirmação de e-mail
    $('#email, #confirmEmail').on('keyup', function() {
        var email = $('#email').val();
        var confirmEmail = $('#confirmEmail').val();
        
        if (email !== confirmEmail) {
            $('#email, #confirmEmail').addClass('is-invalid');
        } else {
            $('#email, #confirmEmail').removeClass('is-invalid');
        }
    });
});
</script>

  </body>

</html>
