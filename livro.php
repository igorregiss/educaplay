<?php
session_start();
require('validacoes/config.php');
// Verifique se foi fornecido um ID de livro para edição
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  
  // Consulta SQL para buscar os dados do livro a ser editado usando prepared statement
  $sql = "SELECT * FROM livros WHERE id = ?";
  
  // Preparar a consulta
  $stmt = mysqli_prepare($conexao, $sql);
  
  // Vincular o parâmetro
  mysqli_stmt_bind_param($stmt, "i", $id);
  
  // Executar a consulta
  mysqli_stmt_execute($stmt);
  
  // Obter o resultado da consulta
  $result = mysqli_stmt_get_result($stmt);
  
  // Verifique se a consulta foi bem-sucedida
  if ($result && mysqli_num_rows($result) > 0) {
      $jogos = mysqli_fetch_assoc($result);
  } else {
      // Redirecione para uma página de erro ou faça algo apropriado caso o livro não seja encontrado
      header('Location: pagina_de_erro.php');
      exit();
  }
  
  // Fechar a consulta preparada
  mysqli_stmt_close($stmt);
} else {
  // Redirecione para uma página de erro ou faça algo apropriado se o ID de livro não for fornecido
  header('Location: pagina_de_erro.php');
  exit();
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
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=6UhcdqNn"></script>
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
                      <li><a class="active" href="livros.php">Livros</a></li>
                      <li><a href="videos.php">Videos</a></li>
                      <li><a href="contato.php">Contato</a></li>

                      <?php
      // Verificar se o usuário está logado
      if (isset($_SESSION['nome'])) {
        // Usuário está logado
        echo '  <li><a href="perfil.php"><i class="bi bi-person-fill"></i> ' . $_SESSION['nome'] . '</a></li>';
        echo '  <li><a href="logout.php">Sair</a></li';

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



          <!-- ***** Details Start ***** -->
          <div class="game-details">
            <div class="row">
            
              <div class="container">
                <div class="row">
                
          <!-- ***** Featured Start ***** -->

              <div class="header-text">


                     
              <div class="col-sm-6 col-xs-6 col-md-6 mx-auto text-center">
      
              <h1 class="d-sm-inline d-none"><?php echo $jogos['titulo']; ?></h1>
      <br>
      <br>
      <img src="assets/images/livro/<?php echo $jogos['imgCapa']; ?>" style="border-radius: 50px">
      <br>
      <p class="d-sm-inline d-none">Autor: <?php echo $jogos['autor']; ?></p>
      <br>
<hr>
    
      <li><div class="main-border-button"><a class="texto-button-ler" id="lerDescricao">Ler texto</a>
      <a class="texto-button-ler" id="pararLeitura" style="display: none">Parar texto</a></div></li>
<hr>
      <br>

      <p class="d-sm-inline d-none" id="descricao"><?php echo strip_tags($jogos['descricao']); ?></p>
      <br>
      
    </div>

          </div>




          </div>
          <!-- ***** Featured End ***** -->


                   
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
      var descricao = document.getElementById("descricao").textContent;
      var speaking = false;
      var utterance;
      function lerDescricao() {
        if (!speaking) {
          speaking = true;
          responsiveVoice.speak(descricao, "Brazilian Portuguese Female", {
            onend: function () {
              speaking = false;
              document.getElementById("pararLeitura").style.display = "none";
              document.getElementById("lerDescricao").innerText = "Ler texto";
            }
          });
          document.getElementById("lerDescricao").innerText = "Lendo...";
          document.getElementById("pararLeitura").style.display = "inline-block";
        }
      }
      function pararLeitura() {
        if (speaking) {
          responsiveVoice.cancel();
          speaking = false;
          document.getElementById("pararLeitura").style.display = "none";
          document.getElementById("lerDescricao").innerText = "Ler texto";
        }
      }
      document.getElementById("lerDescricao").addEventListener("click", function () {
        lerDescricao();
      });
      document.getElementById("pararLeitura").addEventListener("click", function () {
        pararLeitura();
      });
    </script>
  </body>

</html>