<?php
session_start();

include("validacoes/config.php");

// Consulta para buscar os livros recentemente adicionados
$sql_livros_recentes = 'SELECT * FROM livros ORDER BY id DESC LIMIT 4'; // Limitando a 4 livros por exemplo, ajuste conforme necessário
$result_livros_recentes = $conexao->query($sql_livros_recentes);


// Consulta para obter os usuários com mais livros lidos
$sql_usuarios_mais_livros = "SELECT id, nome, totalLivros FROM usuarios ORDER BY totalLivros DESC";
$result_usuarios_mais_livros = $conexao->query($sql_usuarios_mais_livros);

// Consulta para obter livros da tabela "livros" e suas categorias
$sqlLivros = "SELECT livros.id, livros.titulo, livros.idCategorias, livros.descricao, livros.imgCapa, livros.autor, livros.edicao, categorias.descricao as categoria_descricao
FROM livros
INNER JOIN categorias ON livros.idCategorias = categorias.id";
$resultLivros = $conexao->query($sqlLivros);

$categorias = array(); // Array para armazenar as categorias

// Loop pelos livros para coletar as categorias
while ($livro = $resultLivros->fetch_assoc()) {
    $categoriaDescricao = $livro['categoria_descricao'];

    if (!isset($categorias[$categoriaDescricao])) {
        // Se a categoria ainda não existe no array, crie um array vazio para ela
        $categorias[$categoriaDescricao] = array();
    }

    // Adicione o livro à categoria correspondente
    $categorias[$categoriaDescricao][] = $livro;
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
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!--

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
                            <li><a href="livros.php" class="active">Livros</a></li>
                            <li><a href="videos.php">Videos</a></li>
                              <li><a href="sobre.php">Sobre</a></li>
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
                    <!-- ***** Featured Games Start ***** -->
                    <div class="row">
    <div class="col-lg-8">
        <div class="featured-games header-text">
            <div class="heading-section">
                <h4>Últimos livros <em>adicionados</em></h4>
            </div>
            <div class="owl-features owl-carousel">
                <?php
                // Loop para exibir os livros recentemente adicionados
                while ($livro = $result_livros_recentes->fetch_assoc()) {
                    // Crie o link para a página do livro com o ID do livro
                    $link_to_livro = 'livro.php?id=' . $livro['id'];
                ?>
                <div class="item">
                    <a href="<?php echo $link_to_livro; ?>">
                        <div class="thumb">
                            <img src="assets/images/livro/<?php echo $livro['imgCapa']; ?>" alt="">
                        </div>
                    </a>
                    <h4><a href="<?php echo $link_to_livro; ?>"><?php echo $livro['titulo']; ?></a><br></h4>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
    <div class="top-streamers">
        <div class="heading-section">
            <h4><em>Top</em> Leitores</h4>
        </div>
        <ul>
            <?php
            $contador = 1; // Inicialize um contador
            // Loop para exibir os usuários com mais livros lidos
            while ($usuario = $result_usuarios_mais_livros->fetch_assoc()) {
                $usuarioNome = $usuario['nome'];
                $totalLivrosLidos = $usuario['totalLivros'];
                echo '<li>';
                echo '<h6 style="color: white; font-weight: bold;">' . sprintf("%02d", $contador) . '</h6>';
                echo '<h6>  <i class="fa fa-check"></i> ' . $usuarioNome . '</h6>';
                echo '<div class="main-button">';
                echo '<h6 style="color: white; font-weight: bold;"><i class="fa fa-eye"></i>' . $totalLivrosLidos . '</h6>';
                echo '</div>';
                echo '</li>';
                $contador++; // Incrementar o contador
            }
            ?>
        </ul>
    </div>
</div>

  <!-- Loop pelas categorias e exiba os livros -->
  <?php
    foreach ($categorias as $categoriaDescricao => $livros) {
        echo '<div class="live-stream">';
        echo '<div class="col-lg-12">';
        echo '<div class="heading-section">';
        echo '<h4>Livros de <em>' . $categoriaDescricao . '</em></h4>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        foreach ($livros as $livro) {
            $livroId = $livro['id'];
            $livroTitulo = $livro['titulo'];
            $livroImgCapa = $livro['imgCapa'];
            $livroAutor = $livro['autor'];
            echo '<div class="col-lg-3 col-sm-6">';
            echo '<div class="item">';
            echo '<div class="thumb">';
            echo '<img src="assets/images/livro/' . $livroImgCapa . '" alt="">';
            echo '<div class="hover-effect">';
            echo '<div class="content">';
            echo '<div class="live">';
            echo '<a href="livro.php?id=' . $livroId . '">Ler</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div>';
            echo '<h4 style="text-align: center;">' . $livroTitulo . '</h4>';
            echo '<p style="text-align: center;">' . $livroAutor . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
    ?>
                    <!-- ***** Livros por Categoria End ***** -->
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
                            title="Portfolio de Igor Régis">Igor Régis</a>, Junior Lima, Verocina Lima, Maria Vanessa, Catiana Araujo e Elika Silva.</p>
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
