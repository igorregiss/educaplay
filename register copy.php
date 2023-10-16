<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("validacoes/config.php");

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT id, nome FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Login bem-sucedido
        $row = $result->fetch_assoc();
        $_SESSION["id"] = $row["id"];
        $_SESSION["nome"] = $row["nome"];
        header("Location: index.php");
    } else {
        // Login falhou
        $erro = "Login falhou. Verifique suas credenciais.";
    }

    $stmt->close();
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
                      <li><a href="index.php" class="active">Inicio</a></li>
                      <li><a href="jogos.php">Jogos</a></li>
                      <li><a href="livros.php">Livros</a></li>
                      <li><a href="videos.php">Videos</a></li>
                      <li><a href="contato.php">Sobre</a></li>
                      <li><a href="contato.php">Contato</a></li>
                      <?php

// Verificar se o usuário está logado
if (isset($_SESSION['nome'])) {
    // Usuário está logado
    echo '
    <li><a href="perfil.php">Olá, ' . $_SESSION['nome'] . '</a></li>';
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
          <div class="row">
            <div class="col-lg-12">
              <div class="feature-banner header-text">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="thumb">
                      <img src="assets/images/feature-right.jpg" alt="" style="border-radius: 23px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Featured End ***** -->


                    <div class="col-sm-6 col-xs-6 col-md-6">            
                       <div class="space-top">
                         
                        
                        
                      <form class="form-signin" class="form-horizontal">
                        
                        <label class=""> Nome </label>
                        <input name="nome" type="text" class="form-control" placeholder="" required autofocus>

                            <label class=""> Data de Nascimento </label>
                            <input name="dtNasc" type="date" class="form-control" placeholder="" required>

                            <label class=""> Informe seu email </label>
                            <input name="email" type="text" class="form-control" placeholder="" required autofocus>

                            <label class=""> Informe sua senha </label>
                            <input name="senha" type="password" class="form-control" placeholder="" required>

                           <button class="button btn btn-lg btn-block" type="submit" style="border-radius: 20px;">
                                Cadastrarse
                        </button>   
                        
                      
                            </form>
                        </div>

                        
                      
                        <p class="text-center"> Ainda não tenho conta!  <a href="#"  data-toggle="modal" data-target="#myModal"> Criar agora mesmo!</a></p>
                       
        
                    </div>

                    
                    <div class="col-sm-6 col-xs-6 col-md-6">            
                      <div class="space-top">
                        <img src="assets/images/desenho.png" alt="" style="width: 70%;">
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
          <p>Copyright © 2036 <a href="#">Cyborg Gaming</a> Company. All rights reserved. 
          
          <br>Design: <a href="https://templatemo.com" target="_blank" title="free CSS templates">TemplateMo</a>  Distributed By <a href="https://themewagon.com" target="_blank" >ThemeWagon</a></p>
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
