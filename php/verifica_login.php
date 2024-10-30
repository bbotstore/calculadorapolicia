<?php

  session_start(); 

  if (@$_SESSION['dados_usuario']['auth'] != 1) { 

?>

<script>

  document.location.href = 'login.php';

</script>

<?php
  
  exit();

} 

?>