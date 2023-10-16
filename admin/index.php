<?php

require('../validacoes/config.php');


?>

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Login</title>
  </head>
  <body>

  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="images/5396346-removebg-preview.png" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Logar como <strong>administrador</strong></h3>
              <p class="mb-4">Realize o login como administrador para poder gerenciar o EducaPlay.</p>
            </div>
                <form onsubmit="return false" method="POST" action="acoes/logar.php" id="form-login">
                   

                <style>
    ::placeholder {
        color: #999999; /* Cor do placeholder */
        font-size: 13px; /* Tamanho da fonte do placeholder */
        /* Outros estilos desejados para o placeholder */
    }
</style>


 
            <div class="form-group first">
                
                <small class="erro" id="erro-email">    </small>
                <input class="form-control" type="email" id="email" name="email" placeholder="E-mail" required >
            </div>

            <div class="form-group first">
           
                <small class="erro" id="erro-senha"> </small>
                <input class="form-control" type="password" id="senha" name="senha" placeholder="Senha" required autocomplete="no-autocomplete"/>
            </div>

                 

                    <div class="col-md-12">
                        <br>
                        <button class="col-md-12 btn btn-strong-blue" onclick="validarLogin()">Logar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="assets/js/validacoes.js"></script>
</body>

</html>