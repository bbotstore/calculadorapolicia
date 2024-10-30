<?php

  $level_page_acess_ok = 0;

  for($i=0; $i < @count($_SESSION['dados_usuario']['permissoes_acesso']); $i++){
    //echo "<script src='../assets/vendor/jquery/dist/jquery.min.js'></script>";
    echo "<script> $(document).ready(function(){ $('.".$_SESSION['dados_usuario']['permissoes_acesso'][$i]['nome_permissoes_acesso']."').show(); }); </script>";
    //echo $_SESSION['user']['permission'][$i]['permission'];
    //echo $_SESSION['user']['permission'];
    if($_SESSION['dados_usuario']['permissoes_acesso'][$i]['id_permissoes_acesso'] == $level_page_acess){
      $level_page_acess_ok = 1;
    }
  }
  
  if (($level_page_acess_ok != 1) && ($level_page_acess != 0)) { 

?>
    
<script>

  document.location.href = '../index.php';

</script>
    
<?php
  
    exit();

  } 

?>