<?php

  $level_page_acess_ok = 0;

  for($i=0; $i < @count($_SESSION['dados_usuario']['permissoes_bateponto']); $i++){
    //echo "<script> $(document).ready(function(){ $('.".$_SESSION['dados_usuario']['permissoes_bateponto'][$i]['nome_permissoes_bateponto']."').show(); }); </script>";
    //if($_SESSION['dados_usuario']['permissoes_bateponto'][$i]['id_permissoes_bateponto'] == $level_page_acess){
      //$level_page_acess_ok = 1;
      //echo $
      echo $_SESSION['dados_usuario']['permissoes_bateponto'][$i]['nome_permissoes_bateponto'];
  //  }
  }
