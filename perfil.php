<?php
session_start();

$erro = ""; // Inicializa a variável de erro

// Inclua o arquivo de configuração do banco de dados
include("validacoes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION["id"]; // Obtém o ID do usuário da sessão

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $dtNascimento = $_POST["dtNascimento"];
    $telefone = $_POST["telefone"];


    // Atualize os campos no banco de dados
    $sql_update = "UPDATE usuarios SET nome = ?, dtNascimento = ?, telefone = ? WHERE id = ?";
    $stmt_update = $conexao->prepare($sql_update);
    $stmt_update->bind_param("sssi", $nome, $dtNascimento, $telefone, $id);

    if ($stmt_update->execute()) {
        // Atualização bem-sucedida
        $erro = "Informações do usuário atualizadas com sucesso.";
    } else {
        // Falha na atualização
        $erro = "A atualização falhou. Por favor, tente novamente mais tarde.";
    }

    $stmt_update->close();
    $conexao->close();
  } else {
// Consulta para obter os dados do usuário
$id = $_SESSION["id"];
$sql_select_user = "SELECT nome, email, dtNascimento, telefone, totalLivros, totalJogos, totalVideos FROM usuarios WHERE id = ?";
$stmt_select_user = $conexao->prepare($sql_select_user);
$stmt_select_user->bind_param("i", $id);
$stmt_select_user->execute();
$stmt_select_user->bind_result($nome, $email, $dtNascimento, $telefone, $totalLivros, $totalJogos, $totalVideos);
$stmt_select_user->fetch();
$stmt_select_user->close();
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
                      <form id="search" action="buscar.php" method="post">
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
                      <li><a href="sobre.php">Sobre</a></li>
                      <li><a href="contato.php">Contato</a></li>

                      <?php

// Verificar se o usuário está logado
if (isset($_SESSION['nome'])) {
    // Usuário está logado
    echo '  <li><a class="active" href="perfil.php"><i class="bi bi-person-fill"></i> ' . $_SESSION['nome'] . '</a></li>';
    echo '  <li><a href="logout.php">Sair</a></li>'; 
} else {
    // Usuário não está logado
    echo '<li class="login-link"> <a href="login.php"><i class="bi bi-person-fill"></i> Entrar</a></li>';
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

          <!-- ***** Banner Start ***** -->
          <div class="row">
            <div class="col-lg-12">
              <div class="main-profile ">
                <div class="row">
                  <!--<div class="col-lg-4 align-self-center">
                  <div class="main-info header-text">
                      <h4>Igor Régis</h4>
                      <div class="main-border-button">
                        <a href="#">Editar perfil</a>
                      </div>
                    </div>
                  </div> -->
                  <div class="col-lg-12 align-self-center">
                    <ul>
                    <li>Nome: <span><?php echo $nome; ?></span></li>
                      <li>Data de Nascimento: <span><?php echo $dtNascimento; ?></span></li>
                      <li>Email: <span><?php echo $email; ?></span></li>
                      <li>Telefone: <span><?php echo $telefone; ?></span></li>
                      <li><a class="modify-pass" href="alterarsenha.php">Alterar senha</a>
                      <span><a class="modify-pass" href="editarperfil.php">Editar perfil</a></span></li>


                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="clips">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="heading-section">
                            <h4><em>Suas</em> estatisticas</h4>
                          </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                          <div class="item">
                            <div class="thumb">
                              <img src="assets/images/clip-01.jpg" alt="" style="border-radius: 23px;">
                            </div>
                            <div class="down-content">
                              <h4>Livros lidos</h4>
                              <span><i class="fa fa-eye"></i> <?php echo $totalLivros; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                          <div class="item">
                            <div class="thumb">
                              <img src="assets/images/clip-02.jpg" alt="" style="border-radius: 23px;">
                            </div>
                            <div class="down-content">
                              <h4>Jogos acessados</h4>
                              <span><i class="fa fa-eye"></i> <?php echo $totalJogos; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                          <div class="item">
                            <div class="thumb">
                              <img src="assets/images/clip-03.jpg" alt="" style="border-radius: 23px;">
                            </div>
                            <div class="down-content">
                              <h4>Videos assistidos</h4>
                              <span><i class="fa fa-eye"></i> <?php echo $totalVideos; ?></span>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Banner End ***** -->

 
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


  </body>

</html>
