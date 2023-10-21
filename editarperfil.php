<?php
session_start();

$erro = ""; // Inicializa a variável de erro

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("validacoes/config.php");

    $id = $_SESSION["id"];

    $nome = $_POST["nome"];
    $dtNascimento = $_POST["dtNascimento"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"]; // Email a ser atualizado

    // Verifique se o email inserido corresponde a um email já existente no banco de dados
    $sql_check_email = "SELECT email FROM usuarios WHERE email = ? AND id != ?";
    $stmt_check_email = $conexao->prepare($sql_check_email);
    $stmt_check_email->bind_param("si", $email, $id);
    $stmt_check_email->execute();
    $stmt_check_email->store_result();

    if ($stmt_check_email->num_rows > 0) {
        $erro = "Este email já está em uso. Escolha outro email.";
    } else {
        // Atualize os campos no banco de dados, incluindo o email
        $sql_update = "UPDATE usuarios SET nome = ?, email = ?, dtNascimento = ?, telefone = ? WHERE id = ?";
        $stmt_update = $conexao->prepare($sql_update);
        $stmt_update->bind_param("ssssi", $nome, $email, $dtNascimento, $telefone, $id);

        if ($stmt_update->execute()) {
            // Atualização bem-sucedida
            $erro = "Informações do usuário atualizadas com sucesso.";
        } else {
            // Falha na atualização
            $erro = "A atualização falhou. Por favor, tente novamente mais tarde.";
        }

        $stmt_update->close();
    }

    $conexao->close();
} else {
    // Carregue os dados existentes do usuário e preencha os campos de edição
    include("validacoes/config.php");

    $id = $_SESSION["id"];

    $sql_select_user = "SELECT nome, email, dtNascimento, telefone FROM usuarios WHERE id = ?";
    $stmt_select_user = $conexao->prepare($sql_select_user);
    $stmt_select_user->bind_param("i", $id);
    $stmt_select_user->execute();
    $stmt_select_user->bind_result($nome, $email, $dtNascimento, $telefone);
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
                      <li><a href="contato.php">Contato</a></li>
                      <li><a href="sobre.php">Sobre</a></li>


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


                       <form class="form-signin" class="form-horizontal" method="post" action="editarperfil.php">
    <label class=""> Nome </label>
    <input name="nome" type="text" class="form-control" value="<?php echo $nome; ?>" required autofocus>

    <label class=""> Data de Nascimento </label>
    <input name="dtNascimento" type="date" class="form-control" value="<?php echo $dtNascimento; ?>" required>

    <label class=""> Email </label>
    <input id="email" name="email" type="email" class="form-control" value="<?php echo $email; ?>"> <!-- Remova o atributo "readonly" para permitir a edição do email se desejado -->

    <label class=""> Telefone </label>
    <input id="telefone" name="telefone" type="tel" class="form-control" value="<?php echo $telefone; ?>" required>

    <button class="button btn btn-lg btn-block" type="submit" style="border-radius: 20px;">
        Salvar alterações
    </button>
</form>

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



  </body>

</html>
