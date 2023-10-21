<?php
session_start();

// Verifique se a pesquisa foi submetida
if (isset($_POST['searchKeyword'])) {
    $searchKeyword = $_POST['searchKeyword'];

    // Execute a pesquisa no banco de dados
    include ('validacoes/config.php');

    // Realize a pesquisa nos livros
    $sqlLivros = "SELECT * FROM livros WHERE titulo LIKE '%$searchKeyword%' OR descricao LIKE '%$searchKeyword%'";
    $resultLivros = $conexao->query($sqlLivros);

    // Realize a pesquisa nos jogos
    $sqlJogos = "SELECT * FROM jogos WHERE titulo LIKE '%$searchKeyword%'";
    $resultJogos = $conexao->query($sqlJogos);

    // Realize a pesquisa nos vídeos
    $sqlVideos = "SELECT * FROM videoaula WHERE titulo LIKE '%$searchKeyword%'";
    $resultVideos = $conexao->query($sqlVideos);

    // Feche a conexão com o banco de dados
    $conexao->close();
} else {
    // A pesquisa não foi submetida
    $searchKeyword = '';
    $resultLivros = array();
    $resultJogos = array();
    $resultVideos = array();
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
                                <input type="text" placeholder="Buscar" id="searchText" name="searchKeyword" onkeypress="handle" />
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
                                    echo '<li><a href="perfil.php"><i class="bi bi-person-fill"></i> ' . $_SESSION['nome'] . '</a></li>';
                                    echo '<li><a href="logout.php">Sair</a></li>';
                                } else {
                                    // Usuário não está logado
                                    echo '<li class="login-link"> <a href="login.php"><i class="bi bi-person-fill"></i> Entrar</a></li>';
                                }
                            ?>
                        </ul>
                        <a class="menu-trigger">
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
                    <!-- Formulário de Pesquisa -->


                    <!-- Exibir Resultados da Pesquisa -->
                    <?php if (!empty($searchKeyword)): ?>
                        <h4>Resultados da pesquisa para "<?php echo $searchKeyword; ?>"</h4>

 
    <!-- Resultados de Livros -->

    <?php if (!empty($resultLivros)): ?>
        <div class="live-stream">
            <div class="col-lg-12">
                <div class="heading-section">
                    <h4>Livros de <em><?php echo $searchKeyword; ?></em></h4>
                </div>
            </div>
            <div class="row">
                <?php foreach ($resultLivros as $livro): ?>
                    <?php if (isset($livro['titulo']) OR isset($livro['descricao']) OR isset($livro['categoria'])): ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="item">
                                <div class="thumb">
                                    <a href="livro.php?id=<?php echo $livro['id']; ?>">
                                        <img src="assets/images/livro/<?php echo $livro['imgCapa']; ?>" alt="">
                                        <div class="hover-effect">
                                            <div class="content">
                                                <div class="live">
                                                    <a href="livro.php?id=<?php echo $livro['id']; ?>">Ler</a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <h4 style="text-align: center;"><?php echo $livro['titulo']; ?></h4>
                                    <p style="text-align: center;"><?php echo $livro['autor']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <p>Nenhum livro encontrado.</p>
    <?php endif; ?>


                        <!-- Resultados de Jogos -->


  <?php if (!empty($resultJogos)): ?>
        <div class="live-stream">
            <div class="col-lg-12">
                <div class="heading-section">
                    <h4>Jogos de <em><?php echo $searchKeyword; ?></em></h4>
                </div>
            </div>
            <div class="row">
                <?php foreach ($resultJogos as $jogo): ?>
                    <?php if (isset($jogo['titulo']) OR isset($jogo['categoria'])): ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="item">
                                <div class="thumb">
                                    <a href="livro.php?id=<?php echo $jogo['id']; ?>">
                                        <img src="assets/images/jogos/<?php echo $jogo['imgCapa']; ?>" alt="">
                                        <div class="hover-effect">
                                            <div class="content">
                                                <div class="live">
                                                    <a href="livro.php?id=<?php echo $jogo['id']; ?>">Jogar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <h4 style="text-align: center;"><?php echo $jogo['titulo']; ?></h4>
                                    <p style="text-align: center;"><?php echo $jogo['autoria']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <p>Nenhum jogo encontrado.</p>
    <?php endif; ?>




                        <!-- Resultados de Jogos -->


                        <?php if (!empty($resultVideos)): ?>
        <div class="live-stream">
            <div class="col-lg-12">
                <div class="heading-section">
                    <h4>Videos de <em><?php echo $searchKeyword; ?></em></h4>
                </div>
            </div>
            <div class="row">
                <?php foreach ($resultVideos as $videos): ?>
                    <?php if (isset($videos['titulo']) OR isset($videos['categoria'])): ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="item">
                                <div class="thumb">
                                    <a href="livro.php?id=<?php echo $videos['id']; ?>">
                                        <img src="assets/images/videoaula/<?php echo $videos['imgCapa']; ?>" alt="">
                                        <div class="hover-effect">
                                            <div class="content">
                                                <div class="live">
                                                    <a href="livro.php?id=<?php echo $videos['id']; ?>">Assistir</a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <h4 style="text-align: center;"><?php echo $videos['titulo']; ?></h4>
                                    <p style="text-align: center;"><?php echo $videos['creditos']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <p>Nenhum video encontrado.</p>
    <?php endif; ?>



                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2023 <a href="#">EducaPlay</a>. Todos os direitos reservados.
                        <br>Desenvolvido por: <a href="https://igorregis.com" target="_blank" title="Portfolio de Igor Régis">Igor Régis</a>, Junior Lima, Verocina Lima, Maria Vanessa, Catiana Araujo e Elika Silva.
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
