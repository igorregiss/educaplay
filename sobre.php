<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include ('validacoes/config.php');

  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $sql = 'SELECT id, nome FROM usuarios WHERE email = ? AND senha = ?';
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param('ss', $email, $senha);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    // Login bem-sucedido
    $row = $result->fetch_assoc();
    $_SESSION['id'] = $row['id'];
    $_SESSION['nome'] = $row['nome'];
    header('Location: index.php');
  } else {
    // Login falhou
    $erro = 'Login falhou. Verifique suas credenciais.';
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

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>EducaPlay - Aprenda online</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

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
                                <input type="text" placeholder="Buscar" id='searchText' name="searchKeyword"
                                    onkeypress="handle" />
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
                            <li><a href="sobre.php" class="active">Sobre</a></li>
                            
                            <?php

                        // Verificar se o usuário está logado
                        if (isset($_SESSION['nome'])) {
                          // Usuário está logado
                          echo '  <li><a href="perfil.php"><i class="bi bi-person-fill"></i> ' . $_SESSION['nome'] . '</a></li>';
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
                            <div class="heading-section">
                                <h4><em></em>Sobre a equipe e o projeto</h4>
                            </div>
                            <div class="sobre ">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul>
                                                    <li>O projeto foi elaborado durante a disciplina de
                                                        <span>Fundamentos e Análise de Software Educativo</span>,
                                                        ministrada pelo professor <span>Vinicius Vieira</span>. O
                                                        objetivo do projeto era o desenvolvimento de alguma ferramenta
                                                        educacional. Após considerar várias opções, decidimos
                                                        desenvolver uma plataforma de aprendizagem online que
                                                        disponibilizaria materiais didáticos gratuitos, como vídeos,
                                                        jogos e livros.
                                                        <hr>
                                                        Este projeto foi desenvolvido por alunos da <span>Universidade
                                                            Estadual do Ceará</span>, campus avançado de
                                                        <span>Mombaça</span>, e contou com a participação ativa de
                                                        <span>Igor Régis</span>, <span>Catiana Araújo</span>,
                                                        <span>Élika Silva</span>, <span>Júnior Lima</span>,
                                                        <span>Vanessa Silva</span> e <span>Veronica Lima</span>.

                                                    </li>

                                                </ul>
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

                        <br>Desenvolvido por: <a href="https://igorregis.com" target="_blank"
                            title="Portfolio de Igor Régis">Igor Régis</a>, Junior Lima, Verocina Lima, Maria Vanessa,
                        Catiana Araujo e Elika Silva.
                    </p>
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