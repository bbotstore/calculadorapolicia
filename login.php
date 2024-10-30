<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Painel - Polícia ComplexoRJ</title>
  <!-- Favicon -->
  <link rel="icon" href="../../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../../assets/css/argon.css?v=1.1.0" type="text/css">

</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Bem-vindo</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-5">
              <form role="form">
              <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input class="form-control usuario" placeholder="Usuario" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control senha" placeholder="Senha" type="password">
                  </div>
                </div>
                <div class="text-center">
                  <button type="button" class="btn btn-primary my-4 btn_login">Entrar</button><br>
                  <small class="status_login"></small><br>
                  <small>Versão 1.0</small>
                  <br>
                  <!-- <small style="color: red">Em Manutenção!</small> -->
                </div>

              </form>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Core -->
  <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="./assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="./assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="./assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.1.0"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="../../assets/js/demo.min.js"></script>
</body>

</html>
<script>
 
    $('input').click(function(){
      $('#alerta_sucesso, #alerta_aviso').collapse('hide');
    });
    $(document).keypress(function(e) {
      if (e.which == 13) $('.btn_login').click(); // enter (works as expected)
    });
    $(".btn_login").on("click", function() {
        var usuario = $('.usuario').val();
        var senha = $('.senha').val();
          $.ajax({type : "POST",
          beforeSend: function() {},           
          complete: function() {},
          data: {
            usuario: usuario,
            senha: senha
          },
          url : "php/banco.php?tab=usuario&acao=login",
          success : function(data) {
            var resp = data.trim();
            if(resp == 'ok'){
              document.location.href = 'index.php';
            } else if(resp == 'senha_invalida'){
              $(".status_login").html('❌ - Usuario/Senha Invalida!');
            } else if(resp == 'user_blocked'){
              $(".status_login").html('❌ - Usuario/Senha Bloqueados!');
            } else if(resp == 'blocked'){
              $(".status_login").html('❌ - Usuario/Senha Bloqueados!');
            } else {
              $(".status_login").html('❌ - Erro');
            }
          },
          error: function (xhr, status) {
            $(".status_login").html('❌ - Erro');
          }
        });

    });
    /* Fim envia dados */

  </script>
