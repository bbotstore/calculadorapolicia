<?php
   require 'includes/header.php';
     //Nível de acesso a página
     $level_page_acess = 32;
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
                     <li class="breadcrumb-item active" aria-current="page">Relatorio Mensal - Policia Rodoviária Federal</li>
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
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label" for="example3cols1Input">Selecione o Mês</label>
                <input class="form-control" placeholder="Select date" id="busca_registro_mes" type="month">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label" for="example3cols2Input">QRA</label>
                <form><select class="form-control" data-toggle="select" id="passaporte"></select></form><br><small class="erro_consulta_usuarios"></small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label" for="example3cols3Input">Grupo de Pesquisa</label>
                <select class="form-control" id="guarnicoes">
                     <option value="0">Todos</option>
                      <option value="37">「👮」P.R.F</option>
                      <option value="38">「🚔」SPEED</option>
                      <option value="39">「🚁」D.O.A</option>
                      <option value="40">「🏍」B.T.M</option>
                      <option value="41">「⚔ 」G.R.R</option>
                      <option value="42">「🕵」N.O.E</option>
                      <option value="43">「🕵」N.O.E INVESTIGAÇÃO</option>
                      <option value="44">「👮‍♂️」Blitz</option>
                      <option value="8">「🎓」CURSOS</option>
                      <option value="9">「🔊」REUNIAO</option>
                      <option value="10">「✍」INSTRUTORES</option>
                      <option value="11">「👑」COMANDO</option>
                      <option value="12">「⏰」Aguardando PTR - PMERJ</option>
                      <option value="14">「👑」Incursão | R.O</option>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                        <input class="custom-control-input" id="busca_registro_deletado" type="checkbox" >
                        <label class="custom-control-label" for="busca_registro_deletado">Buscar Registro Deletados</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-3">
                        <input class="custom-control-input" id="calcula_registro_deletado" type="checkbox" >
                        <label class="custom-control-label" for="calcula_registro_deletado">Calcular Registro Deletados</label>
                      </div>
              </div>
          </div>
          <div class="d-flex justify-content-between">
               <button type="button" class="btn btn-outline-default btn_buscar" id="btn_pesquisar">Buscar</button>
         </div>
</div>

</div>
         <div class="card">
            <div class="card-header">
               <h3 class="mb-0">Registros</h3>
               <small class="exibe_total_horas"></small><br>
               <small style="color: red"><span class="badge badge-dot"><i class="bg-warning"></i><span class="status"></span></span> - Registro Excluido</small>
            </div>
            <div class="table-responsive py-4">
               <table class="table table-flush" id="tabela_relatorio">
                  <thead class="thead-light">
                     <tr>
                        <th class="text-center">Usuario</th>
                        <th class="text-center">Data Inicio</th>
                        <th class="text-center">Data Final</th>
                        <th class="text-center">Duração</th>
                        <th class="text-center">Canal</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <th class="text-center">Usuario</th>
                        <th class="text-center">Data Inicio</th>
                        <th class="text-center">Data Final</th>
                        <th class="text-center">Total Duração<br><small class="total_horas_somada">00:00:00</small></th>
                        <th class="text-center">Canal</th>
                     </tr>
                  </tfoot>
                  <tbody></tbody>
               </table>
            </div>
         </div>
      <!-- </div> -->
   <!-- </div> -->
<!-- Retirado 2 ultimas div, para arrumar o footer </div>
</div> -->
<?php
   ?>
<?php require 'includes/footer.php'; ?>
<script>
   $(".relatorio_ponto_mes_prf").addClass("active");
   $(".nav_bateponto").addClass("active");
   $(".menu_bateponto").addClass("show");
   $('.exibe_total_horas').html('<b>Total de Horas:</b> 00:00:00');

   document.getElementById("calcula_registro_deletado").disabled = true;
   $('#busca_registro_deletado').click(function(){
   if($(this).attr('checked') == false){
   $('#calcula_registro_deletado').attr("disabled","disabled");   
   } else {
   $('#calcula_registro_deletado').removeAttr('disabled');
   }

});
function somartempos(tempo1, tempo2) {
      var array1 = tempo1.split(':');
      var tempo_seg1 = (parseInt(array1[0]) * 3600) + (parseInt(array1[1]) * 60) + parseInt(array1[2]);
      var array2 = tempo2.split(':');
      var tempo_seg2 = (parseInt(array2[0]) * 3600) + (parseInt(array2[1]) * 60) + parseInt(array2[2]);
      var tempofinal = parseInt(tempo_seg1) + parseInt(tempo_seg2);
      var hours = Math.floor(tempofinal / (60 * 60));
      var divisorMinutos = tempofinal % (60 * 60);
      var minutes = Math.floor(divisorMinutos / 60);
      var divisorSeconds = divisorMinutos % 60;
      var seconds = Math.ceil(divisorSeconds);
      var contador = "";
      if (hours < 10) { contador = "0" + hours + ":"; } else { contador = hours + ":"; }
      if (minutes < 10) { contador += "0" + minutes + ":"; } else { contador += minutes + ":"; }
      if (seconds < 10) { contador += "0" + seconds; } else { contador += seconds; }

   return contador;
}
   $(document.body).on('click', '.btn_buscar', function() {
         mes = $('#busca_registro_mes').val();
         usuario = $('#passaporte :selected').val()
         var options = document.getElementById('guarnicoes').selectedOptions;
         var guarnicoes = Array.from(options).map(({ value }) => value);
         var registro_deletado = document.getElementById('busca_registro_deletado');
         var c_deletado = document.getElementById('calcula_registro_deletado');

         var busca_deletado = registro_deletado.checked
         var calcula_deletado = c_deletado.checked
         if(busca_deletado === false){
            var deletado = 0
         } else {
            var deletado = 1
         }
         relatorio_mes(mes, usuario, guarnicoes, busca_deletado, calcula_deletado)
    });
   
   function relatorio_mes(mes,passaporte, guarnicoes, deletado, calcula_deletado){
      $(document).ajaxSend(function() {
        $("#overlay").fadeIn(300);　
      });
    $('#tabela_relatorio').dataTable().fnClearTable();
    $('#tabela_relatorio').dataTable().fnDestroy();
    $('#tabela_relatorio').DataTable().destroy();
    if(deletado === false){
      var deletado = 0
   } else {
      var deletado = 1
   }
    $.ajax({
        type: "POST",
        data: {
         mes: mes,
         usuario: usuario,
         guarnicao: guarnicoes,
         registro_deletado: deletado
        },
        url: "php/banco.php?tab=bateponto&acao=relatorio_ponto_mes",
        success: function (data) {
         if (data.resp == 'ok') {
            html = '';
            dados = data.dados;
            var total_horas = '00:00:00';
            var total_horas_deletado = '00:00:00';
            if (dados.length > 0) {
               $.each(dados, function (index, value) {
                  var obs = "";
                  if(value.del == 1){
                     if(calcula_deletado == false){
                        var ms_deletado = moment(value.dt_final, "DD/MM/YYYY HH:mm:ss").diff(moment(value.dt_inicio, "DD/MM/YYYY HH:mm:ss"));
                        var d_deletado = moment.duration(ms_deletado);
                        var duracao_deletado = Math.floor(d_deletado.asHours()) + moment.utc(ms_deletado).format(":mm:ss");
                        total_horas_deletado = somartempos(total_horas_deletado,duracao_deletado);
                        var obs = '<span class="badge badge-dot"><i class="bg-warning"></i><span class="status"></span></span>';
                        html += '<tr><td class="sort text-center">' + value.nome_usuario + '</td><td class="sort text-center">' + value.dt_inicio + '</td><td class="sort text-center">' + value.dt_final + '</td><td class="sort text-center">'+obs+'' + duracao_deletado + '</td><td class="sort text-center">' + value.nome_canal + '</td></tr>';
                     } else {
                        var ms = moment(value.dt_final, "DD/MM/YYYY HH:mm:ss").diff(moment(value.dt_inicio, "DD/MM/YYYY HH:mm:ss"));
                        var d = moment.duration(ms);
                        var duracao = Math.floor(d.asHours()) + moment.utc(ms).format(":mm:ss");
                        total_horas = somartempos(total_horas,duracao);
                        var obs = '<span class="badge badge-dot"><i class="bg-warning"></i><span class="status"></span></span>';
                        html += '<tr><td class="sort text-center">' + value.nome_usuario + '</td><td class="sort text-center">' + value.dt_inicio + '</td><td class="sort text-center">' + value.dt_final + '</td><td class="sort text-center">'+obs+'' + duracao + '</td><td class="sort text-center">' + value.nome_canal + '</td></tr>';
                     }
                  } else {
                        var obs = "";
                        var ms = moment(value.dt_final, "DD/MM/YYYY HH:mm:ss").diff(moment(value.dt_inicio, "DD/MM/YYYY HH:mm:ss"));
                        var d = moment.duration(ms);
                        if(value.dt_final == 'Em Aberto'){
                          var duracao = 'Em Aberto';
                        } else {
                          var duracao = Math.floor(d.asHours()) + moment.utc(ms).format(":mm:ss");
                          total_horas = somartempos(total_horas,duracao);
                        }
                     html += '<tr><td class="sort text-center">' + value.nome_usuario + '</td><td class="sort text-center">' + value.dt_inicio + '</td><td class="sort text-center">' + value.dt_final + '</td><td class="sort text-center">' + duracao + '</td><td class="sort text-center">' + value.nome_canal + '</td></tr>';
                  }
                  $('.total_horas_somada').html(total_horas);
                  $('.exibe_total_horas').html('<b>Total de Horas:</b> '+total_horas);
               });
            } else {
               $('.total_horas_somada').html('00:00:00');
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
    
        } else if (data.resp == 'data_inicio'){
          console.log('Faltando Data')
        } else if (data.resp == 'faltando_usuario'){
          console.log('Faltando Usuario')
        } else if(data.resp == 'usuario_nao_encontrado'){
          console.log('usuario_nao_encontrado')
        } else if(data.resp == 'registro_nao_encontrado'){
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
      $(document).ajaxSend(function() {
        $("#overlay").fadeIn(300);　
      });
   $.ajax({
          type: "POST",
          url: "php/banco.php?tab=bateponto&acao=lista_usuarios_prf",
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
               console.log('Erro Interno');
          }
      }).done(function() {
        setTimeout(function(){
          $("#overlay").fadeOut(300);
        },500);
      });
   }
   carrega_usuarios();
</script>