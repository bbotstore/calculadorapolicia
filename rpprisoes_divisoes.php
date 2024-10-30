<?php
   require 'includes/header.php';
     //Nível de acesso a página
     $level_page_acess = 15;
    require 'php/verifica_permissoes_acesso.php';
   ?>
<div class="header bg-primary pb-6">
   <div class="container-fluid">
      <div class="header-body">
         <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
               <h6 class="h2 text-white d-inline-block mb-0">Policia</h6>
               <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                     <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                     <li class="breadcrumb-item"><a href="#">Prisões</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Registros</li>
                  </ol>
               </nav>
            </div>
             <div class="col-lg-6 col-5 text-right">
               </div> 
         </div>
      </div>
   </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
<div class="card mb-4">
<div class="card-header">
      <h3 class="mb-0">Opções de Pesquisa</h3>
</div>


<!-- Modal -->
<div class="modal fade" id="moda_detalhes_prisao" tabindex="-1" role="dialog" data-backdrop="static"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="moda_detalhes_prisao">Detalhes Prisão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
                  <div class="col-md-4"><strong><h3>Data Apreensão</h3></strong> <span class="texto_data_apreensao"></span></div>
                  <div class="col-md-4"><strong><h3>Nome Detento</h3></strong> <span class="texto_nome_detento"><span></div>
                  <div class="col-md-4"><strong><h3>ID Detento</h3></strong> <span class="texto_id_detento"></span></div>
      </div>
      <hr>
      <div class="row">
                  <div class="col-md-4"><strong><h3>Pena</h3></strong> <span class="texto_pena"></span></div>
                  <div class="col-md-4"><strong><h3>Multa</h3></strong> <span class="texto_multa"><span></div>
                  <div class="col-md-4"><strong><h3>Finança</h3></strong> <span class="texto_fianca"></span></div>
      </div>
      <hr>
      <div class="row">
                  <div class="col-md-4"><strong><h3>Reu Primario?</h3></strong> <span class="texto_primario"></span></div>
                  <div class="col-md-4"><strong><h3>Reu Confesso?</h3></strong> <span class="texto_confesso"><span></div>
                  <div class="col-md-4"><strong><h3>Advogado Constituido?</h3></strong> <span class="texto_advogado"></span></div>
      </div>
      <hr>
      <div class="row">
                  <div class="col-md-4"><strong><h3>Dinheiro Sujo</h3></strong> <span class="texto_qsj"></span></div>
                  <div class="col-md-4"><strong><h3>Autenticação</h3></strong> <span class="texto_autenticacao"><span></div>
      </div>
      <hr>
      <div class="row">
         <div class="col-md-4">
         <div class="table-responsive" id="div_printer_supplie">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush" id="tabelaOficial">
                          <thead class="thead-light">
                            <tr>
                              <th scope="col" class="sort text-center">Oficial</th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
         </div>
         <div class="col-md-4">
         <div class="table-responsive" id="div_printer_supplie">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush" id="tabelaArtigos">
                          <thead class="thead-light">
                            <tr>
                              <th scope="col" class="sort text-center">Artigos</th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
         </div>
         <div class="col-md-4">
         <div class="table-responsive" id="div_printer_supplie">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush" id="tabelaItens">
                          <thead class="thead-light">
                            <tr>
                              <th scope="col" class="sort text-center">Itens</th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
         </div>
      </div>


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<div class="card-body">
<div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label" for="example3cols1Input">Data Inicio</label>
                <input class="form-control datepicker" placeholder="Select date" id="data_inicio" type="text" autocomplete="off" >
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label" for="example3cols1Input">Data Final</label>
                <input class="form-control datepicker" placeholder="Select date" id="data_final" type="text" autocomplete="off" >
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label" for="example3cols3Input">Grupo de Pesquisa</label>
                <select class="form-control" id="grupo_pesquisa">
                      <option>Teste</option>
                      <option value="1">P.M.E.R.J</option>
                      <option value="2">P.C.E.R.J</option>
                      <option value="3">P.R.F</option>
                      <option value="4">P.F</option>
                      <option value="9999">--------------------</option>
                  </select>
              </div>
            </div>

</div>
          <div class="d-flex justify-content-between">
               <button type="button" class="btn btn-outline-default btn_buscar">Buscar</button>
         </div>
</div>
</div>
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0">Registros</h3> 
               <small class="total_prisoes"></small>
               <small class="total_prisoes_mencionadas"></small>
            </div>
            <div class="table-responsive py-4">
               <table class="table table-flush" id="tabela_relatorio">
                  <thead class="thead-light">
                     <tr>
                        <th class="text-center">Nome / ID Detento </th>
                        <th class="text-center">Pena</th>
                        <th class="text-center">Multa</th>
                        <th class="text-center">Ficança</th>
                        <th class="text-center">Data</th>
                        <th class="text-center">Ação</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <th class="text-center">Nome / ID Detento </th>
                        <th class="text-center">Pena</th>
                        <th class="text-center">Multa</th>
                        <th class="text-center">Ficança</th>
                        <th class="text-center">Data</th>
                        <th class="text-center">Ação</th>
                     </tr>
                  </tfoot>
                  <tbody></tbody>
               </table>
            </div>
         </div>

<?php
require 'includes/footer.php';
?>

<script>
   //Ativa a seleção da página no menu
   $(".nav_prisoes").addClass("active");
   $(".relatorio_prisoes_datas").addClass("active");
   $(".menu_prisoes").addClass("show");
   //$(".nav_ultimos_registro_bateponto").addClass("active");
   $('.total_prisoes').html('Total de Prisões: 0');

   $(document.body).on('click', '.btn_buscar', function() {
      data_inicio = $('#data_inicio').val();
      data_final = $('#data_final').val();
      grupo_pesquisa = $('#grupo_pesquisa :selected').val()
        relatorio_prisoes(grupo_pesquisa, data_inicio, data_final)
    });
   
   
    function relatorio_prisoes(grupo_pesquisa, data_inicio, data_final){
      $(document).ajaxSend(function() {
        $("#overlay").fadeIn(300);　
      });
      $('.total_prisoes').html('Total de Prisões: 0');
    $('#tabela_relatorio').dataTable().fnClearTable();
    $('#tabela_relatorio').dataTable().fnDestroy();
    $('#tabela_relatorio').DataTable().destroy();
    $.ajax({
        type: "POST",
        data: {
            grupo_pesquisa: grupo_pesquisa,
            data_inicio: data_inicio,
            data_final: data_final
        },
        url: "php/banco.php?tab=prisoes&acao=relatorio_prisoes_divisao",
        success: function (data) {
         if (data.resp == 'ok') {
            $('#span_success_online, #span_error_online, #span_alert_online').collapse('hide');
            html = '';
            dados = data.dados;
            console.log(data);
            var total_prisoes = '';
            if (dados.length > 0) {

               $.each(dados, function (index, value) {
                  if(value.fianca == 'R$ NaN'){
                     fianca = 'N/A';
                  } else {
                     fianca = value.fianca;
                  }
                     html += '<tr><td class="sort text-center">' + value.nome_detento + ' / ' + value.passaporte_detento + '</td><td class="sort text-center">' + value.pena + ' Meses</td><td class="sort text-center">' + value.multa + '</td><td class="sort text-center">' + fianca + '</td><td class="sort text-center">' + value.dt + '</td><td><button data-id="'+value.id_registro+'" class="btn btn-icon btn-info btn-sm btn-exibe-registro" type="button"><span class="btn-inner--icon"><i class="ni ni-archive-2"></i></span><span class="btn-inner--text">Exibir Detalhes</span></button></td></tr>';
                     total_prisoes++;
               });
               $('.total_prisoes').html('Total de Prisões: '+total_prisoes);
            } else {
               console.log('Aqui');
            }
            $("#tabela_relatorio > tbody").html(html);
            $('#tabela_relatorio').DataTable({
               "bDestroy": true,
               "bProcessing": true,
               "order": [[ 2, "desc" ]],
               "language": {
                  "emptyTable": "Nenhum registro encontrado",
                  "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                  "infoEmpty": "Mostrando 0 até 0 de 0 registros",
                  "infoFiltered": "(Filtrados de _MAX_ registros)",
                  "infoThousands": ".",
                  "loadingRecords": "Carregando...",
                  "processing": 'Processando...',
                  "zeroRecords": "Nenhum registro encontrado",
                  "search": "<i class='fas fa-search'></i>",
                  "paginate": {
                     "next": "<i class='fas fa-angle-right'></i>",
                     "previous": "<i class='fas fa-angle-left'></i>",
                     "first": "<i class='fas fa-angle-double-left'></i>",
                     "last": "<i class='fas fa-angle-double-right'></i>"
                  },
                  "aria": {
                     "sortAscending": ": Ordenar colunas de forma ascendente",
                     "sortDescending": ": Ordenar colunas de forma descendente"
                  },
                  "select": {
                     "rows": {
                        "_": "Selecionado %d linhas",
                        "1": "Selecionado 1 linha"
                     },
                     "cells": {
                        "1": "1 célula selecionada",
                        "_": "%d células selecionadas"
                     },
                     "columns": {
                        "1": "1 coluna selecionada",
                        "_": "%d colunas selecionadas"
                     }
                  },
                  "lengthMenu": "Exibir _MENU_ resultados por página"
               }
            });
        
        } else {
         console.log('Erro');
        }
   
   },
   error: function (xhr, status) {
      console.log('Erro Interno')
   }
    }).done(function() {
        setTimeout(function(){
          $("#overlay").fadeOut(300);
        },500);
      });
   
   }
   function carrega_usuarios(){
   $.ajax({
          type: "POST",
          url: "php/banco.php?tab=bateponto&acao=lista_usuarios",
          success: function (data) {
              if (data.resp == 'ok') {
                  html = '';
                  html += '<option>Selecione</option>';
                  dados = data.dados;
                  if (dados.length > 0) {
                      $.each(dados, function (index, value) {
                        html += '<option value="'+value.id_usuario+'">'+value.nome_usuario+'</option>';
                      });
                $("#passaporte").html(html);
            }
              } else {
               $(".erro_consulta_usuarios").html('❌ - Erro Query MySQL');

              }
   
          }, error: function (xhr, status) {
            console.log('Erro Interno')
          }
      });
   
   }
   carrega_usuarios();
   $('#data_inicio').datepicker('update', new Date(),);
   $('#data_final').datepicker('update', new Date(),);

               /* Botão para Libera Acesso Rede Wireless*/
            $(document.body).on('click', '.btn-exibe-registro', function () {
               var id_registro = "";
               var id_registro = $(this).attr('data-id');
               $.ajax({
                  type: "POST",
                  // data: {
                  //    id_prisao: id_registro
                  // },
                  url: "php/banco.php?tab=prisoes&acao=exibe_detalhes&id_prisao="+id_registro,
                  success: function (data) {
                     dados = data.dados;
                     if (dados.length > 0) {
                        var segundo = '';
                        var terceiro = '';
                        var quarto = '';
                        var quinto = '';
                        var sexto = '';
                        var setimo = '';
                        var oitavo = '';
                        var fianca = '';
                        var reu_confesso = '';
                        var reu_primario = '';
                        var adv_const = '';
                        var artigos = '';
                        var itens = '';
                        artigos = dados[0].artigos
                        itens = dados[0].itens
                        itens_ = itens.replace(new RegExp('\r?\n','g'), '</br>');
                        artigos_ = artigos.replace(new RegExp('\r?\n','g'), '</br>');

                         if(dados[0].segundo === null ){
                              segundo = '  N/A  ';
                           } else {
                              segundo = dados[0].segundo
                           }
                           if(dados[0].terceiro === null ){
                              terceiro = '  N/A  ';
                           } else {
                              terceiro = dados[0].terceiro
                           }
                           if(dados[0].quarto === null ){
                              quarto = '  N/A  ';
                           } else {
                              quarto = dados[0].quarto
                           }
                           if(dados[0].quinto === null ){
                              quinto = '  N/A  ';
                           } else {
                              quinto = dados[0].quinto
                           }
                           if(dados[0].sexto === null ){
                              sexto = '  N/A  ';
                           } else {
                              sexto = dados[0].sexto
                           }
                           if(dados[0].setimo === null ){
                              setimo = '  N/A  ';
                           } else {
                              setimo = dados[0].setimo
                           }
                           if(dados[0].oitavo === null ){
                              oitavo = '  N/A  ';
                           } else {
                              oitavo = dados[0].oitavo
                           }
                           if(dados[0].fianca == 'R$ NaN'){
                              fianca = 'R$ N/A'
                           } else {
                              fianca = dados[0].fianca
                           }
                           if(dados[0].reu_confesso == 0 ){
                              reu_confesso = 'Não'
                           } else {
                              reu_confesso = 'Sim'
                           }
                           if(dados[0].reu_primario == 0 ){
                              reu_primario = 'Não'
                           } else {
                              reu_primario = 'Sim'
                           }
                           if(dados[0].adv_constituido == 0 ){
                              adv_const = 'Não'
                           } else {
                              adv_const = 'Sim'
                           }

                        const oficiais = '1º - ' + dados[0].primeiro +'</br>2º - ' + segundo + '</br>3º - ' + terceiro + '</br>4º - ' + quinto + '</br>5º - ' + sexto + '</br>7º - ' +setimo + '</br>8º  - ' + oitavo;

                      $(".texto_data_apreensao").html(dados[0].dt);
                      $(".texto_nome_detento").html(dados[0].nome_detento);
                      $(".texto_id_detento").html(dados[0].passaporte_detento);
                      $(".texto_pena").html(dados[0].pena + ' Meses');
                      $(".texto_multa").html(dados[0].multa);
                      $(".texto_fianca").html(fianca);
                      $(".texto_confesso").html(reu_confesso);
                      $(".texto_primario").html(reu_primario);
                      $(".texto_advogado").html(adv_const);
                      $(".texto_qsj").html(dados[0].qsj);
                      $(".texto_autenticacao").html(dados[0].autenticacao);
                      $("#tabelaOficial > tbody").html(oficiais);
                      $("#tabelaArtigos > tbody").html(artigos_);
                      $("#tabelaItens > tbody").html(itens_);
                      
                      
                     }
                     $('#moda_detalhes_prisao').modal('show');
                  },
                  error: function (xhr, status) {
                     console.log('Erro Interno')
                  }

               });

            });
</script>

