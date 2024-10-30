<?php
   require 'includes/header.php';
     //Nível de acesso a página
     $level_page_acess = 39;
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
                     <li class="breadcrumb-item active" aria-current="page">Alterar Registros - Polícia Civil</li>
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
                <label class="form-control-label" for="example3cols1Input">Data</label>
                <input class="form-control datepicker" placeholder="Select date" id="busca_registro_dia" type="text">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label" for="example3cols2Input">QRA</label>
                <form><select class="form-control" data-toggle="select" id="passaporte"></select></form>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label" for="example3cols3Input">Grupo de Pesquisa</label>
                <select class="form-control" id="guarnicoes">
                      <option value="0">Todos</option>
                      <option value="15">⎾🚓⏌PCERJ</option>
                      <option value="16">⎾🚁⏌SAER</option>
                      <option value="17">「🏍」GETEM</option>
                      <option value="18">「💣」CORE</option>
                      <option value="8">「🎓」CURSOS</option>
                      <option value="19">「🕵」INVESTIGANDO</option>
                      <option value="9">「🔊」REUNIAO</option>
                      <option value="10">「✍」INSTRUTORES</option>
                      <option value="11">「👑」COMANDO</option>
                      <option value="20">「⏰」Aguardando PTR - PCERJ</option>
                      <option value="14">「👑」Incursão | R.O</option>
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
                        <th class="text-center">Ação</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <th class="text-center">Usuario</th>
                        <th class="text-center">Data Inicio</th>
                        <th class="text-center">Data Final</th>
                        <th class="text-center">Total Duração<br><small class="total_horas_somada">00:00:00</small></th>
                        <th class="text-center">Canal</th>
                        <th class="text-center">Ação</th>

                     </tr>
                  </tfoot>
                  <tbody></tbody>
               </table>
            </div>
         </div>
<?php
   ?>
<?php require 'includes/footer.php'; ?>

<script>
   //Ativa a seleção da página no menu
   $(".manipular_registros_pcerj").addClass("active");
   $(".nav_bateponto").addClass("active");
   $(".menu_bateponto").addClass("show");
   //$(".nav_ultimos_registro_bateponto").addClass("active");
   
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
         dia_pesquisa = $('#busca_registro_dia').val();
         //usuario = $('#passaporte_usuario').val();
         usuario = $('#passaporte :selected').val()
         var options = document.getElementById('guarnicoes').selectedOptions;
         var guarnicoes = Array.from(options).map(({ value }) => value);
         relatorio_dia(dia_pesquisa, usuario, guarnicoes)
    });
   
   
   
   function relatorio_dia(dt,passaporte, guarnicoes){
      $(document).ajaxSend(function() {
        $("#overlay").fadeIn(300);　
      });
    $('#tabela_relatorio').dataTable().fnClearTable();
    $('#tabela_relatorio').dataTable().fnDestroy();
    $('#tabela_relatorio').DataTable().destroy();
    $.ajax({
        type: "POST",
        data: {
         data: dt,
         usuario: passaporte,
         guarnicao: guarnicoes
        },
        url: "php/banco.php?tab=bateponto&acao=relatorio_dia",
        success: function (data) {
         console.log(data);
         if (data.resp == 'ok') {
            html = '';
            dados = data.dados;
            
            var total_horas = '00:00:00';
            if (dados.length > 0) {
               $.each(dados, function (index, value) {
                        var ms = moment(value.dt_final, "DD/MM/YYYY HH:mm:ss").diff(moment(value.dt_inicio, "DD/MM/YYYY HH:mm:ss"));
                        var d = moment.duration(ms);
                        if(value.dt_final == 'Em Aberto'){
                          var duracao = 'Em Aberto';
                        } else {
                          var duracao = Math.floor(d.asHours()) + moment.utc(ms).format(":mm:ss")
                          total_horas = somartempos(total_horas,duracao)
                          //total_horas += duracao;
                        }
                  //btn = '<button data-id="' + value.id + '" title="Desconectar Usuario" class="btn btn-sm btn-danger btn-disconect"><i class="fas fa-ban"></i></button>';
                  html += '<tr><td class="sort text-center">' + value.nome_usuario + '</td><td class="sort text-center">' + value.dt_inicio + '</td><td class="sort text-center">' + value.dt_final + '</td><td class="sort text-center">' + duracao + '</td><td class="sort text-center">' + value.nome_canal + '</td><td class="sort text-center"><button data-id="'+value.id_registro+'" class="btn btn-icon btn-danger btn-sm btn-excluir-registro" type="button"><span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span><span class="btn-inner--text">Excluir</span></button></td></tr>';
                  $('.total_horas_somada').html(total_horas);
               });
            $("#tabela_relatorio > tbody").html(html);
            $('#tabela_relatorio').DataTable({
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
        }
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
      })
   
   }
   
   function carrega_usuarios(){
      $(document).ajaxSend(function() {
        $("#overlay").fadeIn(300);　
      });
   $.ajax({
          type: "POST",
          url: "php/banco.php?tab=bateponto&acao=lista_usuarios_civil",
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
               console.log('Erro Exibição');
                $('#alerta_sucesso').collapse('hide');
                $('#alerta_erro').collapse('show');
                $(".alerta_erro").html('<span class="alert-text"><strong>Erro!</strong> Contate um administrador do sistema!</span>');
              }
   
          }, error: function (xhr, status) {
            $('#alerta_sucesso').collapse('hide');
            $('#alerta_erro').collapse('show');
            $(".alerta_erro").html('<span class="alert-text"><strong>Erro!</strong> Não foi possível conectar! Verifique sua conexão com a internet!</span>');
          }
      }).done(function() {
        setTimeout(function(){
          $("#overlay").fadeOut(300);
        },500);
      });
   
   }
   carrega_usuarios();
   $('#busca_registro_dia').datepicker('update', new Date());

   $(document.body).on('click', '.btn-excluir-registro', function () {
               var id_registro = "";
               var id_registro = $(this).attr('data-id');
      const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Tem certeza que deseja Excluir?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Sim, Deletar',
  cancelButtonText: 'Não, Cancelar!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
   $.ajax({
        type: "POST",
        data: {
         id_registro: id_registro
        },
        url: "php/banco.php?tab=bateponto&acao=del_registro_ponto",
        success: function (data) {
         if (data.resp == 'ok') {
            console.log('OK');
            swalWithBootstrapButtons.fire(
               'Deletado!',
               'Registro Deletado.',
               'success'
            )
            $('#tabela_relatorio').dataTable().fnClearTable();
            $('#tabela_relatorio').dataTable().fnDestroy();
            $('#tabela_relatorio').DataTable().destroy();
            $('.total_horas_somada').html('00:00:00');

        } else if (data.resp == 'faltando_data'){
          console.log('Faltando Data');
        } else if (data.resp == 'faltando_usuario'){
          console.log('Faltando Usuario')
        } else if(data.resp == 'usuario_nao_encontrado'){
          console.log('usuario_nao_encontrado')
        } else if(data.resp == 'registro_nao_encontrado'){
            $('.total_horas_somada').html('00:00:00');
            console.log('registro_nao_encontrado')
        }  else  {
         console.log('Erro');

        }
   
      },
error: function (xhr, status) {
      console.log('Erro 2');

   }
    }).done(function() {
        setTimeout(function(){
          $("#overlay").fadeOut(300);
        },500);
      })

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelado',
      ':)',
      'error'
    )
  }
}).done(function() {
        setTimeout(function(){
          $("#overlay").fadeOut(300);
        },500);
      })



            });
</script>