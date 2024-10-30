<?php
require 'includes/header.php';
  
  //Nível de acesso a página
  $level_page_acess = 2;
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
                   <li class="breadcrumb-item active" aria-current="page">Ultimos Registro</li>
                 </ol>
               </nav>
             </div>
           </div>
         </div>
       </div>
     </div>
     <!-- Page content -->
     <div class="container-fluid mt--6">
       <!-- Table -->
       <div class="row">
         <div class="col">
           <div class="card">
             <!-- Card header -->
             <div class="card-header">
               <h3 class="mb-0">Registros</h3>
             </div>
             <div class="table-responsive py-4">
               <table class="table table-flush" id="tabala_logs_bateponto">
                 <thead class="thead-light">
                   <tr>
                      <th class="text-center">#</th>
                     <th class="text-center">Usuario</th>
                     <th class="text-center">Data Inicio</th>
                     <th class="text-center">Data Final</th>
                     <th class="text-center">Duração</th>
                     <th class="text-center">Canal</th>
                   </tr>
                 </thead>
                 <tfoot>
                   <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Usuario</th>
                     <th class="text-center">Data Inicio</th>
                     <th class="text-center">Data Final</th>
                     <th class="text-center">Duração</th>
                     <th class="text-center">Canal</th>
                   </tr>
                 </tfoot>
                 <tbody></tbody>
               </table>
             </div>
           </div>
         </div>
       </div>

<?php


?>
<?php require 'includes/footer.php'; ?>
<script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script>
  function verificarDiferencaHorario(inicialMin, finalMin) {
        var totalMin = Number(finalMin - inicialMin);
    }
   //Ativa a seleção da página no menu
   $(".nav_bateponto").addClass("active");
   $(".menu_bateponto").addClass("show");
   $(".ultimos_registro_bateponto").addClass("active");

      $(document).ajaxSend(function() {
        $("#overlay").fadeIn(300);　
      });

      $.ajax({
          type: "POST",
          url: "php/banco.php?tab=bateponto&acao=ultimos_registro",

          success: function (data) {

              if (data.resp == 'ok') {
                  html = '';
                  dados = data.dados;
                  if (dados.length > 0) {
                      $.each(dados, function (index, value) {
                        var inicio = value.dt_inicio
                        var final =  value.dt_final
                        var partesData = inicio.split("/");
                        var data = new Date(partesData[2], partesData[1] - 1, partesData[0]);
                        var ms = moment(final, "DD/MM/YYYY HH:mm:ss").diff(moment(inicio, "DD/MM/YYYY HH:mm:ss"));
                        var d = moment.duration(ms);
                        if(final == 'Em Aberto'){
                          var duracao = 'Em Aberto';
                        } else {
                          var duracao = Math.floor(d.asHours()) + moment.utc(ms).format(":mm:ss")
                        }
                          html += '<tr><td class="text-center"><b>' + value.id_registros +'</b></td><td class="text-center">' + value.nome_usuario +'</td><td class="text-center">' + value.dt_inicio +'</td><td class="text-center">' + final +'</td><td class="text-center">' + duracao +'</td><td class="text-center">' + value.nome_canal +'</td></tr>';
                      });
                $("#tabala_logs_bateponto > tbody").html(html);
            }
            //Carrega o plugin DataTables
            $('#tabala_logs_bateponto').DataTable({
               "bDestroy": true,
               "bProcessing": true,
               "order": [[ 2, "desc" ]],
               //paging: false,
               //aaSorting: [[3, 'desc']],
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
               console.log('Erro Exibição');
              }

          }, error: function (xhr, status) {
            console.log('Erro');

          }
      }).done(function() {
        setTimeout(function(){
          $("#overlay").fadeOut(300);
        },500);
      });
</script>
