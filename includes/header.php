<!DOCTYPE html>
<html>
<?php
require 'php/verifica_login.php';
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Creative Tim">
  <title>Painel - Policia Complexo RJ</title>
  <!-- Favicon -->
  <link rel="icon" href="../../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <link rel="stylesheet" href="../../assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../../assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../../assets/css/argon.css?v=1.1.0" type="text/css">
  <link rel="stylesheet" href="../../assets/css/complexorj.css" type="text/css">
 <!-- Page plugins -->
 <link rel="stylesheet" href="../../assets/vendor/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="../../assets/vendor/quill/dist/quill.core.css">
  <!-- <link rel="stylesheet" href="../../assets/vendor/sweetalert2/dist/sweetalert2.min.css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">




</head>

<body>
<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span<br>
  </div>
</div>
<!-- <div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
    <div class="loading-text">Carregando...</div>
  </div>
</div> -->

<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
     <div class="scrollbar-inner">
       <!-- Brand -->
       <div class="sidenav-header d-flex align-items-center">
         <a class="navbar-brand" href="#">
           <img src="../../assets/img/policia.png" class="navbar-brand-img" alt="...">
         </a>
         <div class="ml-auto">
           <!-- Sidenav toggler -->
           <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
             <div class="sidenav-toggler-inner">
               <i class="sidenav-toggler-line"></i>
               <i class="sidenav-toggler-line"></i>
               <i class="sidenav-toggler-line"></i>
             </div>
           </div>
         </div>
       </div>
       <div class="navbar-inner">
         <!-- Collapse -->
         <div class="collapse navbar-collapse" id="sidenav-collapse-main">
           <!-- Nav items -->
           <ul class="navbar-nav">
           <li class="nav-item">
               <a class="nav-link nav_dashboard" href="./index.php">
                 <i class="ni ni-align-left-2 text-default"></i>
                 <span class="nav-link-text">Dashboard</span>
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link nav_bateponto" href="#navbar-bateponto" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-bateponto">
                 <i class="ni ni-align-left-2 text-default"></i>
                 <span class="nav-link-text">Bate Ponto</span>
               </a>
               <div class="collapse menu_bateponto" id="navbar-bateponto">
                 <ul class="nav nav-sm flex-column">
                   <li class="nav-item logs_bateponto" style="display: none">
                     <a href="./logs_bateponto.php" class="nav-link">Logs</a>
                   </li>
                   <li class="nav-item ultimos_registro_bateponto" style="display: none">
                     <a href="./ultimos_registro_bate_ponto.php" class="nav-link">Ultimos Registro</a>
                   </li>
                   <li class="nav-item relatorio_diario_ponto" style="display: none">
                     <a href="./rpdia.php" class="nav-link">Relatorio Diario</a>
                   </li>
                   <li class="nav-item relatorio_diario_ponto_pmerj" style="display: none">
                     <a href="./rpdia_pmerj.php" class="nav-link">Relatorio Diario - P.M.E.RJ</a>
                   </li>
                   <li class="nav-item relatorio_diario_ponto_pcerj" style="display: none">
                     <a href="./rpdia_pcerj.php" class="nav-link">Relatorio Diario - P.C.E.R.J</a>
                   </li>
                   <li class="nav-item relatorio_diario_ponto_prf" style="display: none">
                     <a href="./rpdia_prf.php" class="nav-link">Relatorio Diario - P.R.F</a>
                   </li>
                   <li class="nav-item relatorio_diario_ponto_pf" style="display: none">
                     <a href="./rpdia_pf.php" class="nav-link">Relatorio Diario - P.F</a>
                   </li>
                   <li class="nav-item relatorio_diario_ponto_coe" style="display: none">
                     <a href="./rpdia_coe.php" class="nav-link">Relatorio Diario - C.O.E</a>
                   </li>
                   <li class="nav-item relatorio_ponto_datas" style="display: none">
                     <a href="./rpdatas.php" class="nav-link">Relatorio Datas</a>
                   </li>
                   <li class="nav-item relatorio_ponto_datas_pmerj" style="display: none">
                     <a href="./rpdatas_pmerj.php" class="nav-link">Relatorio Datas - P.M.E.RJ</a>
                   </li>
                   <li class="nav-item relatorio_ponto_datas_pcerj" style="display: none">
                     <a href="./rpdatas_pcerj.php" class="nav-link">Relatorio Datas - P.C.E.R.J</a>
                   </li>
                   <li class="nav-item relatorio_ponto_datas_prf" style="display: none">
                     <a href="./rpdatas_prf.php" class="nav-link">Relatorio Datas - P.R.F</a>
                   </li>
                   <li class="nav-item relatorio_ponto_datas_pf" style="display: none">
                     <a href="./rpdatas_pf.php" class="nav-link">Relatorio Datas - P.F</a>
                   </li>
                   <li class="nav-item relatorio_ponto_datas_coe" style="display: none">
                     <a href="./rpdatas_coe.php" class="nav-link">Relatorio Datas - C.O.E</a>
                   </li>
                   <li class="nav-item relatorio_ponto_mes" style="display: none">
                     <a href="./rpmes.php" class="nav-link">Relatorio Mes</a>
                   </li>
                   <li class="nav-item relatorio_ponto_mes_pmerj" style="display: none">
                     <a href="./rpmes_pmerj.php" class="nav-link">Relatorio Mes - P.M.E.RJ</a>
                   </li>
                   <li class="nav-item relatorio_ponto_mes_pcerj" style="display: none">
                     <a href="./rpmes_pcerj.php" class="nav-link">Relatorio Mes - P.C.E.R.J</a>
                   </li>
                   <li class="nav-item relatorio_ponto_mes_prf" style="display: none">
                     <a href="./rpmes_prf.php" class="nav-link">Relatorio Mes - P.R.F</a>
                   </li>
                   <li class="nav-item relatorio_ponto_mes_pf" style="display: none">
                     <a href="./rpmes_pf.php" class="nav-link">Relatorio Mes - P.F</a>
                   </li>
                   <li class="nav-item relatorio_ponto_mes_coe" style="display: none">
                     <a href="./rpmes_coe.php" class="nav-link">Relatorio Mes - C.O.E</a>
                   </li>
                   <li class="nav-item manipular_registros" style="display: none">
                     <a href="./alteraregistro.php" class="nav-link">Alterar Registros</a>
                   </li>
                   <li class="nav-item manipular_registros_pmerj" style="display: none">
                     <a href="./alteraregistro_pmerj.php" class="nav-link">Alterar Registros -  P.M.E.R.J</a>
                   </li>
                   <li class="nav-item manipular_registros_pcerj" style="display: none">
                     <a href="./alteraregistro_pcerj.php" class="nav-link">Alterar Registros -  P.C.E.R.J</a>
                   </li>
                   <li class="nav-item manipular_registros_prf" style="display: none">
                     <a href="./alteraregistro_prf.php" class="nav-link">Alterar Registros - P.R.F</a>
                   </li>
                   <li class="nav-item manipular_registros_pf" style="display: none">
                     <a href="./alteraregistro_pf.php" class="nav-link">Alterar Registros - P.F</a>
                   </li>
                   <li class="nav-item manipular_registros_coe" style="display: none">
                     <a href="./alteraregistro_coe.php" class="nav-link">Alterar Registros - C.O.E</a>
                   </li>

                   <li class="nav-item relatorio_divisoes_pmerj" style="display: none">
                     <a href="./relatorio_divisoes_pmerj.php" class="nav-link">Relatorio Sub Divisões</a>
                   </li>

                 </ul>
               </div>
             </li>
         <li class="nav-item">
               <a class="nav-link nav_prisoes" href="#navbar-prisoes" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-prisoes">
                 <i class="ni ni-align-left-2 text-default"></i>
                 <span class="nav-link-text">Prisões</span>
               </a>
               <div class="collapse menu_prisoes" id="navbar-prisoes">
                 <ul class="nav nav-sm flex-column">
                   <li class="nav-item relatorio_prisoes_datas" style="display: none">
                     <a href="./rprisoes.php" class="nav-link">Relatorio Datas</a>
                   </li>
                 </ul>
                 <ul class="nav nav-sm flex-column">
                   <li class="nav-item relatorio_prisoes_detento" style="display: none">
                     <a href="./rprisoesdetento.php" class="nav-link">Relatorio Detento</a>
                   </li>
                 </ul>
               </div>
             </li>
             <li class="nav-item">
               <a class="nav-link nav_rank" href="#navbar-rank" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-rank">
                 <i class="ni ni-align-left-2 text-default"></i>
                 <span class="nav-link-text">Rank</span>
               </a>
               <div class="collapse menu_rank" id="navbar-rank">
                 <ul class="nav nav-sm flex-column">
                   <li class="nav-item relatorio_rank_horas" style="display: none">
                     <a href="./rank_horas.php" class="nav-link">Rank Horas</a>
                   </li>
                 </ul>
                 <ul class="nav nav-sm flex-column">
                   <li class="nav-item relatorio_rank_prisao" style="display: none">
                     <a href="./rank_prisao.php" class="nav-link">Rank Prisões</a>
                   </li>
                 </ul>
               </div>
             </li>
           </ul>
         </div>
       </div>
     </div>
   </nav>

   



   <div class="main-content" id="panel">

     <!-- Topnav -->
     <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
       <div class="container-fluid">
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav align-items-center ml-md-auto">
             <li class="nav-item d-xl-none">
               <!-- Sidenav toggler -->
               <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                 <div class="sidenav-toggler-inner">
                   <i class="sidenav-toggler-line"></i>
                   <i class="sidenav-toggler-line"></i>
                   <i class="sidenav-toggler-line"></i>
                 </div>
               </div>
             </li>
           </ul>
           <ul class="navbar-nav align-items-center ml-auto ml-md-0">
             <li class="nav-item dropdown">
               <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <div class="media align-items-center">
                   <span class="avatar avatar-sm rounded-circle">
                     <img alt="Image placeholder" src="../../assets/img/user.webp">
                   </span>
                   <div class="media-body ml-2 d-none d-lg-block">
                     <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION['dados_usuario']['nome_usuario']; ?></span>
                   </div>
                 </div>
               </a>
               <div class="dropdown-menu dropdown-menu-right">
                 <div class="dropdown-header noti-title">
                   <h6 class="text-overflow m-0">Welcome!</h6>
                 </div>
                 <div class="dropdown-divider"></div>
                 <a href="./sair.php" class="dropdown-item">
                   <i class="ni ni-user-run"></i>
                   <span>Sair</span>
                 </a>
               </div>
             </li>
           </ul>
         </div>
       </div>
     </nav>

     
