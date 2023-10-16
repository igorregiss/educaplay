<?php
session_start();
require('../validacoes/config.php');


?>


<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>EducaPlay - Aprenda online</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />

</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
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
          <a class="nav-link" href="livros.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-books text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Livros</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="videos.php">
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
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">EducaPlay Admin</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Videos Aulas</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none"><?php echo $_SESSION['nome'];?></span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
            <a href="logout.php" class="nav-link text-white p-0">
  <i class="fa fa-sign-out fixed-plugin-button-nav cursor-pointer"></i>
</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6></h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TITULO</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CATEGORIA</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CRÉDITOS</th>
                      <th class="text-secondary opacity-7"></th>

                      <th  class="align-middle text-end text-dark text-dark text-xxg font-weight-bolder"><a href="add-videos.php">Adicionar Videos +</a></th>

                    </tr>
                  </thead>
                  <tbody>


                  <?php
$sql = 'SELECT videoaula.id, categorias.descricao AS categoria_descricao, videoaula.titulo, videoaula.creditos FROM videoaula
        INNER JOIN categorias ON videoaula.idCategoria = categorias.id
        ORDER BY videoaula.id DESC';
$result = mysqli_query($conexao, $sql);

foreach($result as $r) {
    $id = $r['id'];
    $titulo = $r['titulo'];
    $categoriaDescricao = $r['categoria_descricao'];
    $creditos = $r['creditos'];

    echo "
    <tr>
        <td>
            <div class='d-flex px-2 py-1'>
                <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm' id='id' name='id'>$id</h6>
                </div>
            </div>
        </td>
        <td>
            <div class='d-flex px-2 py-1'>
                <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm' id='categoriaDescricao' name='categoriaDescricao'>$categoriaDescricao</h6>
                </div>
            </div>
        </td>
        <td>
            <div class='d-flex px-2 py-1'>
                <div 'd-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm' id='titulo' name='titulo'>$titulo</h6>
                </div>
            </div>
        </td>
        <td>
            <div class='d-flex px-2 py-1'>
                <div 'd-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm' id='creditos' name='creditos'>$creditos</h6>
                </div>
            </div>
        </td>
        <th class='text-secondary opacity-7'></th>

        <td  class='align-middle text-end '>
            <a class='btn btn-link text-danger text-gradient px-3 mb-0' href='acoes/del-videos.php?id=$id'><i class='far fa-trash-alt me-2'></i>Excluir</a>
            <a class='btn btn-link text-dark px-3 mb-0' href='editar-videos.php?id=$id'><i class='fas fa-pencil-alt text-dark me-2' aria-hidden='true'></i>Editar</a>
        </td>
    </tr>
    ";
}
?>


  
                    <tr>
                      <td>
                        <div class='d-flex px-2 py-1'>
                          <div class='d-flex flex-column justify-content-center'>
                            
                            
                          </div>
                        </div>
                      </td>
                      
                      <td class='align-middle text-center'>
                       
                      </td>
                      <th class='text-secondary opacity-7'></th>
                      
                    </tr>


                    

                    


                  </tbody>
                </table>

                
              </div>
            </div>
          </div>
        </div>


        


       
      
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
  </main>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>