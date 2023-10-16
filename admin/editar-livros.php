<?php
require('includes/conexao.php');
require('includes/validarLogin.php');
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
      $livro = mysqli_fetch_assoc($result);
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
<html>

<head>
    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel='apple-touch-icon' sizes='76x76' href='./assets/img/apple-icon.png'>
    <link rel='icon' type='image/png' href='./assets/img/favicon.png'>
    <title>EducaPlay - Aprenda online</title>
    <!--     Fonts and icons     -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' />
    <!-- Nucleo Icons -->
    <link href='./assets/css/nucleo-icons.css' rel='stylesheet' />
    <link href='./assets/css/nucleo-svg.css' rel='stylesheet' />
    <!-- Font Awesome Icons -->
    <script src='https://kit.fontawesome.com/42d5adcbca.js' crossorigin='anonymous'></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>


    <link href='./assets/css/nucleo-svg.css' rel='stylesheet' />
    <!-- CSS Files -->
    <link id='pagestyle' href='./assets/css/argon-dashboard.css?v=2.0.4' rel='stylesheet' />
</head>

<body class='g-sidenav-show   bg-gray-100'>
    <div class='min-height-300 bg-primary position-absolute w-100'></div>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
            <img src="../assets/images/logo.png" class="navbar-brand-img h-100" alt="main_logo">
        <!-- <span class="ms-1 font-weight-bold">EducaPlay</span> -->
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="principal.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="usuarios.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Usuarios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="categorias.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tag text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Categorias</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="livros.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-books text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Livros</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="videos.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Video-aula</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="jogos.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-chat-round text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Jogos</span>
                    </a>
                </li>

            </ul>
        </div>

    </aside>
    <main class='main-content position-relative border-radius-lg '>
        <!-- Navbar -->
        <nav class='navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl ' id='navbarBlur' data-scroll='false'>
            <div class='container-fluid py-1 px-3'>
                <nav aria-label='breadcrumb'>
                    <ol class='breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5'>
                        <li class='breadcrumb-item text-sm'><a class='opacity-5 text-white' href='javascript:;'>EducaPlayAdmin</a></li>
                        <li class='breadcrumb-item text-sm text-white active' aria-current='page'>Categorias</li>
                    </ol>
                </nav>
                <div class='collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4' id='navbar'>
                    <div class='ms-md-auto pe-md-3 d-flex align-items-center'>

                    </div>
                    <ul class='navbar-nav  justify-content-end'>
                        <li class='nav-item d-flex align-items-center'>
                            <a href='javascript:;' class='nav-link text-white font-weight-bold px-0'>
                                <i class='fa fa-user me-sm-1'></i>
                                <span class="d-sm-inline d-none"><?php echo $_SESSION['nome'];?></span>
                            </a>
                        </li>
                        <li class='nav-item d-xl-none ps-3 d-flex align-items-center'>
                            <a href='javascript:;' class='nav-link text-white p-0' id='iconNavbarSidenav'>
                                <div class='sidenav-toggler-inner'>
                                    <i class='sidenav-toggler-line bg-white'></i>
                                    <i class='sidenav-toggler-line bg-white'></i>
                                    <i class='sidenav-toggler-line bg-white'></i>
                                </div>
                            </a>
                        </li>
                        <li class='nav-item px-3 d-flex align-items-center'>
                            <a href="logout.php" class="nav-link text-white p-0">
                                <i class="fa fa-sign-out fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <form id='form-edicao' action='acoes/update-livros.php' method='POST' enctype='multipart/form-data'>
        <input type='hidden' name='id' value='<?php echo $livro['id']; ?>'>

            <div class='container-fluid py-4'>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='card'>
                            <div class='card-header pb-0'>
                            </div>
                            <div class='card-body'>
                                <p class='text-uppercase text-sm'>Editar Livro</p>
                                <?php
                                if(isset($_GET['msg'])){
                                    $msg = $_GET['msg'];
                                    if($msg == "sucesso"){
                                        echo "
                                        <div class='col-md-12 btn btn-strong' style='background-color: #0777EE; color: white;'>
                                            Livro atualizado com sucesso!
                                        </div>
                                        ";
                                    }else{
                                        echo "
                                        <div class='alert alert-danger'>
                                            Ops! Erro ao atualizar o Livro!
                                        </div>
                                        ";
                                    }
                                }
                                ?>
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <div class='form-group'>
                                            <label for='idCategoria' class='form-control-label'>Categoria</label>
                                            <select class='form-control' name='idCategorias' id='idCategorias'>
                                                <option value=''>Selecione uma categoria</option>
                                                <?php
                                                // Conecte-se ao banco de dados
                                                
                                                // Verifique se a conexão foi bem-sucedida
                                                if (!$conexao) {
                                                    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
                                                }
                                                
                                                // Consulta SQL para buscar categorias
                                                $sql = "SELECT id, descricao FROM categorias";
                                                
                                                // Execute a consulta SQL
                                                $result = mysqli_query($conexao, $sql);
                                                
                                                // Verifique se a consulta foi bem-sucedida
                                                if ($result) {
                                                    // Loop para exibir as opções do seletor
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $idCategoria = $row['id'];
                                                        $descricao = $row['descricao'];
                                                        // Verifique se esta é a categoria selecionada para o livro
                                                        $selected = ($idCategoria == $livro['idCategorias']) ? 'selected' : '';
                                                        echo "<option value='$idCategoria' $selected>$descricao</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>Erro ao buscar categorias</option>";
                                                }
                                                
                                                // Feche a conexão com o banco de dados
                                                mysqli_close($conexao);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class='form-group'>
                                            <label for='titulo' class='form-control-label'>Título</label>
                                            <input class='form-control' type='text' name='titulo' id='titulo' value="<?php echo $livro['titulo']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class='form-group'>
                                            <label for='descricao' class='form-control-label'>Descrição</label>
                                            <textarea class='ckeditor form-control' name='descricao' id='descricao' rows='4'><?php echo $livro['descricao']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class='form-group'>
                                            <label for='imgCapa' class='form-control-label'>Imagem de Capa</label>
                                            <input type="hidden" name="imagemCapaAtual" value="<?php echo $livro['imgCapa']; ?>">
                                            <input class='form-control' type='file' name='imgCapa' id='imgCapa'>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <div class='form-group'>
                                            <label for='autor' class='form-control-label'>Autor</label>
                                            <input class='form-control' type='text' name='autor' id='autor' value="<?php echo $livro['autor']; ?>">
                                        </div>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class='form-group'>
                                            <label for='edicao' class='form-control-label'>Edição</label>
                                            <input class='form-control' type='text' name='edicao' id='edicao' value="<?php echo $livro['edicao']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr class='horizontal dark'>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class='text-center'>
                                            <button class='btn btn-lg btn-primary btn-lg' type='submit'>Salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </main>
    <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        Powered by
                        <a href="#" class="font-weight-bold" target="_blank"> EducaPlay</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>
    </div>

    <!--   Core JS Files   -->
    <script src='../assets/js/core/popper.min.js'></script>
    <script src='../assets/js/core/bootstrap.min.js'></script>
    <script src='../assets/js/plugins/perfect-scrollbar.min.js'></script>
    <script src='../assets/js/plugins/smooth-scrollbar.min.js'></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- END CKEDITOR -->
    <script src="caminho/para/ckeditor.js"></script>
    <script>
        // Associe CKEditor a todos os elementos com a classe "ckeditor"
        CKEDITOR.replaceAll('ckeditor');
    </script>

    <script>
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: '/upload.php' // URL do script que lida com o upload de imagens
        });
    </script>
    <!-- END CKEDITOR -->
</body>
<!-- Github buttons -->
<script async defer src='https://buttons.github.io/buttons.js'></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src='../assets/js/argon-dashboard.min.js?v=2.0.4'></script>

</html>
