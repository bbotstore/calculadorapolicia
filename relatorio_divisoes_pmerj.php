<?php
   require 'includes/header.php';
     //Nível de acesso a página
     $level_page_acess = 24;
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
                     <li class="breadcrumb-item"><a href="#">Bate Ponto</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Relatorio Sub Divisões</li>
                  </ol>
               </nav>
            </div>
             <div class="col-lg-6 col-5 text-right">
               <!-- <a href="#" class="btn btn-sm btn-neutral btn_salvar_relatorio">Salvar Relatorio</a> -->
               <!-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
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
<div class="card-body">
<div class="row">
<div class="col-md-3">
              <div class="form-group">
                <label class="form-control-label" for="example3cols1Input">Data Inicio</label>
                <input class="form-control datepicker" placeholder="Select date" id="busca_registro_data_inicio" type="text">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="form-control-label" for="example3cols1Input">Data Final</label>
                <input class="form-control datepicker" placeholder="Select date" id="busca_registro_data_final" type="text">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label" for="example3cols3Input">Grupo de Pesquisa</label>
                <select class="form-control" id="grupo_pesquisa">
                      <option value="4">⎾🚓⏌PMERJ</option>
                      <option value="5">⎾⚡」BPChq</option>
                      <option value="6">⎾💀」BOPE</option>
                      <option value="1">⎾🚓⏌BPM</option>
                      <option value="2">⎾🚁⏌GAM</option>
                      <option value="3">⎾🚓⏌PATAMO</option>
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
               <!-- <small class="exibe_total_horas"></small><br> -->
               <!-- <small style="color: red"><span class="badge badge-dot"><i class="bg-warning"></i><span class="status"></span></span> - Registro Excluido</small> -->

            </div>
            <div class="table-responsive py-4">
               <table class="table table-flush" id="tabela_relatorio">
                  <thead class="thead-light">
                     <tr>
                        <th class="text-center">Usuario</th>
                        <th class="text-center">Total de Horas</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <th class="text-center">Usuario</th>
                        <!-- <th class="text-center">Total de Horas<br><small class="total_horas_somada">00:00:00</small></th> -->
                        <th class="text-center">Total de Horas</th>
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
   $(".relatorio_divisoes_pmerj").addClass("active");
   $(".nav_bateponto").addClass("active");
   $(".menu_bateponto").addClass("show");
   //$('.exibe_total_horas').html('<b>Total de Horas:</b> 00:00:00');

   $(document.body).on('click', '.btn_buscar', function() {
         dt_inicio = $('#busca_registro_data_inicio').val();
         dt_final = $('#busca_registro_data_final').val();
         var options = document.getElementById('grupo_pesquisa').selectedOptions;
         var grupo_pesquisa = Array.from(options).map(({ value }) => value);



         relatorio_dia(dt_inicio, dt_final, grupo_pesquisa)
    });
   
   
    function relatorio_dia(dt_inicio, dt_final, grupo_pesquisa){
    $('#tabela_relatorio').dataTable().fnClearTable();
    $('#tabela_relatorio').dataTable().fnDestroy();
    $('#tabela_relatorio').DataTable().destroy();
    $(document).ajaxSend(function() {
        $("#overlay").fadeIn(300);　
      });
    $.ajax({
        type: "POST",
        data: {
         data_inicio: dt_inicio,
         data_final: dt_final,
         grupo: grupo_pesquisa
        },
        url: "php/banco.php?tab=bateponto&acao=relatorio_subdivisao",
        success: function (data) {
         if (data.resp == 'ok') {
            html = '';
            dados = data.dados;
            console.log(data);
            if (dados.length > 0) {
               $.each(dados, function (index, value) {
                  html += '<tr><td class="sort text-center">' + value.nome + '</td><td class="sort text-center">' + value.horas + '</td></tr>';
               });
            } else {
               console.log('vazio');
            }
            $("#tabela_relatorio > tbody").html(html);
            $('#tabela_relatorio').DataTable({
               "bDestroy": true,
               "bProcessing": true,
               //"order": [[ 2, "desc" ]],
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
        
        } else if (data.resp == 'faltando_data'){
          console.log('Faltando Data')
        } else if (data.resp == 'faltando_usuario'){
          console.log('Faltando Usuario')
        } else if(data.resp == 'usuario_nao_encontrado'){
          console.log('usuario_nao_encontrado')
        } else if(data.resp == 'registro_nao_encontrado'){
            $('.total_horas_somada').html('00:00:00');
            console.log('registro_nao_encontrado')
        }  else  {
          $('#span_alert, #span_success').collapse('hide');
          $('#span_error').collapse('show');
          $(".span_error").html('<span class="alert-text"><strong>Erro!</strong> Contate um administrador do sistema!</span>');
        }
   
   },
   error: function (xhr, status) {
   $('#span_alert, #span_success').collapse('hide');
   $('#span_error').collapse('show');
   $(".span_error").html('<span class="alert-text"><strong>Erro!</strong> Não foi possível conectar! Verifique sua conexão com a internet!</span>');
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
            $('#alerta_sucesso').collapse('hide');
            $('#alerta_erro').collapse('show');
            $(".alerta_erro").html('<span class="alert-text"><strong>Erro!</strong> Não foi possível conectar! Verifique sua conexão com a internet!</span>');
          }
      });
   
   }
   carrega_usuarios();
   
   $('#busca_registro_data_inicio').datepicker('update', new Date());
   $('#busca_registro_data_final').datepicker('update', new Date());



</script>

