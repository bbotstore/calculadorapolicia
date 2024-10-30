<?php

	//Requisita o arquivo de conexão.
	require 'conexao_visao.php';
	require 'funcoes.php';
	date_default_timezone_set('America/Sao_Paulo');


    if($_REQUEST['tab'] == 'calculadora'){
        if($_REQUEST['acao'] == 'lista_usuarios'){
            
			header('Content-Type: application/json');
			$sql = "SELECT nome_discord_usuario,id_discord_usuario FROM usuarios";
            $cmd = $con->prepare($sql);
            $cmd->execute();
            $dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("id_usuario" => $row["id_discord_usuario"], "nome_usuario" => $row["nome_discord_usuario"]);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);
        } else if($_REQUEST['acao'] == 'envia_registro'){
			header('Content-Type: application/json');
			$pena = $_POST['pena'];
			$multa = $_POST['multa'];
			$valor_fianca = $_POST['fianca'];
			$primeiro_oficial = $_POST['primeiro_oficial'];
			$segundo_oficial = $_POST['segundo_oficial'];
			$terceiro_oficial = $_POST['terceiro_oficial'];
			$quarto_oficial = $_POST['quarto_oficial'];
			$quinto_oficial = $_POST['quinto_oficial'];
			$sexto_oficial = $_POST['sexto_oficial'];
			$setimo_oficial = $_POST['setimo_oficial'];
			$oitavo_oficial = $_POST['oitavo_oficial'];
			$nome_detento = $_POST['nome_detento'];
			$id_detento = $_POST['id_detento'];
			$itens_apreendidos = $_POST['itens_apreendidos'];
			$artigos = $_POST['artigos'];
			$qsj = $_POST['qsj'];
			$reu_primario = $_POST['reu_primario'];
			$adv_const = $_POST['check_adv'];
			$reu_confesso = $_POST['reu_confesso'];
			$nome_bombeiro = $_POST['bombeiro'];



			if($segundo_oficial == 'Selecione'){
				$segundo_oficial = NULL;
			} 
			if($terceiro_oficial == 'Selecione'){
				$terceiro_oficial = NULL;
			} 
			if($quarto_oficial == 'Selecione'){
				$quarto_oficial = NULL;
			} 
			if($quinto_oficial == 'Selecione'){
				$quinto_oficial = NULL;
			} 
			if($sexto_oficial == 'Selecione'){
				$sexto_oficial = NULL;
			} 
			if($setimo_oficial == 'Selecione'){
				$setimo_oficial = NULL;
			} 
			if ($oitavo_oficial == 'Selecione'){
				$oitavo_oficial = NULL;
			}
			if($reu_primario == 1){
				$primario = "Sim";
			} else {
				$primario = "Não";
			}
			if($reu_confesso == 1){
				$confesso = "Sim";
			} else {
				$confesso = "Não";
			}
			if($adv_const == 1){
				$adv = "Sim";
			} else {
				$adv = "Não";
			}
			if($valor_fianca == 'R$ NaN'){
				$fianca = "N/A";
			} else {
				$fianca = $valor_fianca;
			}
			if($itens_apreendidos == NULL){
				$itens = "N/A";
			} else {
				$itens = $itens_apreendidos;
			}
			
			if($qsj == 0 || $sql == NULL){
				$qsj_ = "N/A";
			} else {
				$qsj_ = $qsj;
			}
			if($nome_bombeiro == 0 || $nome_bombeiro == NULL){
				$nome_bombeiro_ = "N/A";
			} else {
				$nome_bombeiro_ = $nome_bombeiro;
			}
			if($nome_detento == false){
				echo json_encode('nome_detento');
			} else if($id_detento == false){
				echo json_encode('id_detento');
			} else {
			$autenticacao = mb_strtoupper(date("ymd").substr(uniqid(),-6));
			$sql = "INSERT INTO prisao (primeiro_oficial, segundo_oficial, terceiro_oficial, quarto_oficial, quinto_oficial, sexto_oficial, setimo_oficial, oitavo_oficial, nome_detento, id_detento, itens_prisao, artigos_prisao, pena_prisao, multa_prisao, fianca_prisao, reu_primario, reu_confesso, adv_constituido, qsj_prisao, obs, dt_prisao, bombeiro, autenticacao) VALUES (:primeiro_oficial, :segundo_oficial, :terceiro_oficial, :quarto_oficial, :quinto_oficial, :sexto_oficial, :setimo_oficial, :oitavo_oficial, :nome_detento, :id_detento, :itens_prisao, :artigos_prisao, :pena_prisao, :multa_prisao, :fianca_prisao, :reu_primario, :reu_confesso, :adv_const, :qsj_prisao, :obs, :dt_prisao, :bombeiro, :autenticacao)";
			$cmd = $con->prepare($sql);
			$cmd->bindValue(':primeiro_oficial', $primeiro_oficial);
			$cmd->bindValue(':segundo_oficial', $segundo_oficial);
			$cmd->bindValue(':terceiro_oficial', $terceiro_oficial);
			$cmd->bindValue(':quarto_oficial', $quarto_oficial);
			$cmd->bindValue(':quinto_oficial', $quinto_oficial);
			$cmd->bindValue(':sexto_oficial', $sexto_oficial);
			$cmd->bindValue(':setimo_oficial', $setimo_oficial);
			$cmd->bindValue(':oitavo_oficial', $oitavo_oficial);
			$cmd->bindValue(':nome_detento', $nome_detento);
			$cmd->bindValue(':id_detento', $id_detento);
			$cmd->bindValue(':itens_prisao', $itens);
			$cmd->bindValue(':artigos_prisao', $artigos);
			$cmd->bindValue(':pena_prisao', $pena);
			$cmd->bindValue(':multa_prisao', $multa);
			$cmd->bindValue(':fianca_prisao', $valor_fianca);
			$cmd->bindValue(':reu_primario', $reu_primario);
			$cmd->bindValue(':reu_confesso', $reu_confesso);
			$cmd->bindValue(':adv_const', $adv_const);
			$cmd->bindValue(':qsj_prisao', $qsj);
			$cmd->bindValue(':obs', 0);
			$cmd->bindValue(':dt_prisao', date('Y-m-d H:i:s'));
			$cmd->bindValue(':bombeiro', $nome_bombeiro_);
			$cmd->bindValue(':autenticacao', $autenticacao);
			if($cmd->execute()){
				echo json_encode('ok');
				$data_registro = date('Y-m-d H:i:s');
				envia_apreensao_visao($primeiro_oficial,$segundo_oficial,$terceiro_oficial,$quarto_oficial,$quinto_oficial,$sexto_oficial,$setimo_oficial,$oitavo_oficial,$nome_detento,$id_detento,$artigos,$itens,$pena,$fianca,$multa,$primario,$confesso,$adv,$id_registro,$qsj_,$data_registro,$nome_bombeiro_,$autenticacao);
			} else {
				$matriz = array('resp'=>'erro ','dados' => $dados);
				echo json_encode($matriz);
				print_r($con->errorInfo()); 
			}
		}


		}
    }

?>