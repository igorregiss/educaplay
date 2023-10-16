<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"])) {
    include("validacoes/config.php");

    $id = $_SESSION["id"];
    $senha_atual = md5($_POST["senha_atual"]); // Senha atual em MD5
    $nova_senha = md5($_POST["nova_senha"]); // Nova senha em MD5

    // Consulta para obter a senha atual do usuário
    $sql = "SELECT senha FROM usuarios WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $senha_no_banco = $row["senha"];

        if ($senha_atual === $senha_no_banco) {
            // A senha atual está correta, então você pode atualizar a senha
            $update_sql = "UPDATE usuarios SET senha = ? WHERE id = ?";
            $update_stmt = $conexao->prepare($update_sql);
            $update_stmt->bind_param("si", $nova_senha, $id);
            $update_stmt->execute();
            $update_stmt->close();

            // Atualização de senha bem-sucedida
            $erro = "Senha alterada com sucesso.";
        } else {
            // Senha atual incorreta
            $erro = "Senha atual incorreta. Verifique suas credenciais.";
        }
    } else {
        // Usuário não encontrado
        $erro = "Usuário não encontrado.";
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
                      <li><a href="index.php">Inicio</a></li>
                      <li><a href="jogos.php">Jogos</a></li>
                      <li><a href="livros.php">Livros</a></li>
                      <li><a href="videos.php">Videos</a></li>
                      <li><a href="contato.php">Sobre</a></li>
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
                       <form class="form-signin" class="form-horizontal" method="post" action="alterarsenha.php">
    <label class=""> Senha Atual </label>
    <input name="senha_atual" type="password" class="form-control" placeholder="" required>
    <label class=""> Nova Senha </label>
    <input name="nova_senha" type="password" class="form-control" placeholder="" required>
    <button class="button btn btn-lg btn-block" type="submit" value="Alterar Senha" style="border-radius: 20px;">
        Alterar Senha
    </button>   
</form>
                    </div>

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


  </body>

</html>
