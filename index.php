<?php
require 'includes/header.php';

//Nível de acesso a página
  $level_page_acess = 0;
  require 'php/verifica_permissoes_acesso.php'

?>
<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Painel</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                </ol>
              </nav>
            </div>

          </div>
        </div>
      </div>
    </div>
<div class="container-fluid mt--6">
      <div class="row">
      <!-- <div class="card">
            <div class="card-body">
              <h5 class="h2 card-title mb-0 titulo_pcerj">BATE PONTO - PMERJ</h5>
              <small class="text-muted total_membros_pmerj"></small>
              <p class="card-text mt-2 pmerj"></p>
            </div>
          </div> -->
          <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
              <h5 class="h2 card-title mb-0">BATE PONTO - PMERJ</h5>
              <small class="text-muted total_membros_pmerj"></small>
              <p class="card-text mt-2 pmerj"></p>
            </div>
          </div>
        </div>
        <!-- <div class="col-lg-3">
          <div class="card">
            <div class="card-body">
              <h5 class="h2 card-title mb-0">BATE PONTO - PMERJ</h5>
              <small class="text-muted total_membros_pmerj"></small>
              <h4>👮‍♂️・Comando PMERJ - <small class="contador_pmerj_comando"></h4></small><p class="card-text mt-2 pmerj_comando"></p>
              <h4>👮‍♂️・CMD/SUB BPCHq - <small class="contador_pmerj_cmd_sub_bpchq"></h4></small><p class="card-text mt-2 pmerj_cmd_sub_bpchq"></p>
              <h4>👮‍♂️・CMD/SUB BOPE - <small class="contador_pmerj_cmd_sub_bope"></h4></small><p class="card-text mt-2 pmerj_cmd_sub_bope"></p>
              <h4>👑・Comando Companhia - <small class="contador_pmerj_cmd_cia"></h4></small><p class="card-text mt-2 pmerj_cmd_cia"></p>
              <h4>☠️⚡️・Força Especial - <small class="contador_pmerj_forca_especial"></h4></small><p class="card-text mt-2 pmerj_forca_especial"></p>
              <h4>👮‍♂️・Instrutor Equipe - <small class="contador_pmerj_instrutor_equipe"></h4></small><p class="card-text mt-2 pmerj_instrutor_equipe"></p>
              <h4>👮‍♂️・Equipe Alpha - <small class="contador_pmerj_equipe_alpha"></h4></small><p class="card-text mt-2 pmerj_equipe_alpha"></p>
              <h4>👮‍♂️・Equipe Bravo - <small class="contador_pmerj_equipe_bravo"></h4></small><p class="card-text mt-2 pmerj_equipe_bravo"></p>
              <h4>👮‍♂️・Equipe Charlie - <small class="contador_pmerj_equipe_charlie"></h4></small><p class="card-text mt-2 pmerj_equipe_charlie"></p>
              <h4>👮‍♂️・Equipe Delta - <small class="contador_pmerj_equipe_delta"></h4></small><p class="card-text mt-2 pmerj_equipe_delta"></p>
              <h4>👮‍♂️・Equipe Echo - <small class="contador_pmerj_equipe_echo"></h4></small><p class="card-text mt-2 pmerj_equipe_echo"></p>
              <h4>👮‍♂️・Equipe Foxtrot - <small class="contador_pmerj_equipe_foxtrot"></h4></small><p class="card-text mt-2 pmerj_equipe_foxtrot"></p>
              <h4>👮‍♂️・Equipe Golf - <small class="contador_pmerj_equipe_golf"></h4></small><p class="card-text mt-2 pmerj_equipe_golf"></p>
              <h4>👮‍♂️・Equipe Hotel - <small class="contador_pmerj_equipe_hotel"></h4></small><p class="card-text mt-2 pmerj_equipe_hotel"></p>
            </div>
          </div>
        </div> -->
        <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
              <h5 class="h2 card-title mb-0 titulo_pcerj">BATE PONTO - PCERJ</h5>
              <small class="text-muted total_membros_pcerj"></small>
              <p class="card-text mt-2 pcerj"></p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="h2 card-title mb-0 titulo_pcerj">BATE PONTO - PRF</h5>
              <small class="text-muted total_membros_prf"></small>
              <p class="card-text mt-2 prf"></p>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="h2 card-title mb-0">BATE PONTO - PF</h5>
              <small class="text-muted total_membros_pf"></small>
              <p class="card-text mt-2 pf"></p>
            </div>
          </div>
        </div>
        
<?php
require './includes/footer.php';
?>
<script>
   $(".nav_dashboard").addClass("active");

   function ponto_pmerj(){
          $(document).ajaxSend(function() {
        $("#overlay").fadeIn(300);　
      });
    $.ajax({
          type: "POST",
          url: "php/banco.php?tab=bateponto&acao=ponto_aberto_pmerj",

          success: function (data) {

              if (data.resp == 'ok') {
                  html = '';
                  dados = data.dados;
                  if (dados.length > 0) {
                      $.each(dados, function (index, value) {
                        html += '<b>'+ value.nome_usuario+' - '+value.nome_canal+'</b><br>';
                        //html += '1 '+value.nome_usuario+'<br>';
                      });
                $(".total_membros_pmerj").html('Total de Ponto Abertos - ' + dados.length +'')
                $(".pmerj").html(html)
            }
              } else {
               console.log('Erro');
              }
          }, error: function (xhr, status) {
            console.log('Erro Interno');
          }
      })

   }
 
   function ponto_pcerj(){
    $.ajax({
          type: "POST",
          url: "php/banco.php?tab=bateponto&acao=ponto_aberto_pcerj",

          success: function (data) {

              if (data.resp == 'ok') {
                  html = '';
                  dados = data.dados;
                  if (dados.length > 0) {
                      $.each(dados, function (index, value) {
                        html += '<b>'+ value.nome_usuario+' - '+value.nome_canal+'</b><br>';
                      });
                $(".total_membros_pcerj").html('Total de Ponto Abertos - ' + dados.length +'')
                $(".pcerj").html(html)
            }
              } else {
               console.log('Erro');
              }

          }, error: function (xhr, status) {
            console.log('Erro Interno');
          }
      });

   }
   function ponto_prf(){
    $.ajax({
          type: "POST",
          url: "php/banco.php?tab=bateponto&acao=ponto_aberto_prf",

          success: function (data) {

              if (data.resp == 'ok') {
                  html = '';
                  dados = data.dados;
                  if (dados.length > 0) {
                      $.each(dados, function (index, value) {
                        html += '<b>'+ value.nome_usuario+' - '+value.nome_canal+'</b><br>';
                        //console.log('Dados -> ' + value.logs_id);
                      });
                      $(".total_membros_prf").html('Total de Ponto Abertos - ' + dados.length +'')
                      $(".prf").html(html)
            }
              } else {
               console.log('Erro');
              }
          }, error: function (xhr, status) {
            console.log('Erro Interno');
          }
      });

   }
   function ponto_pf(){
    $.ajax({
          type: "POST",
          url: "php/banco.php?tab=bateponto&acao=ponto_aberto_pf",

          success: function (data) {

              if (data.resp == 'ok') {
                  html = '';
                  dados = data.dados;
                  if (dados.length > 0) {
                      $.each(dados, function (index, value) {
                        html += '<b>'+ value.nome_usuario+' - '+value.nome_canal+'</b><br>';
                        //console.log('Dados -> ' + value.logs_id);
                      });
                      $(".total_membros_pf").html('Total de Ponto Abertos - ' + dados.length +'')
                      $(".pf").html(html)
            }
              } else {
               console.log('Erro');
              }
          }, error: function (xhr, status) {
            console.log('Erro Interno');
          }
      }).done(function() {
        setTimeout(function(){
          $("#overlay").fadeOut(300);
        },500);
      });

}
ponto_pmerj()
ponto_pcerj()
ponto_prf()
ponto_pf()
//ponto_pf()
</script>
