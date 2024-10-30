<?php

	//Requisita o arquivo de conexão.
	require 'conexao.php';
	require 'funcoes.php';

	
	//Definindo a data em pt-br
	date_default_timezone_set('America/Sao_Paulo');

    /* ========================================= */
            /* LOGS DO SISTEMA */
	/* ========================================= */

	if($_REQUEST['tab'] == 'usuario'){
		if ($_REQUEST['acao'] == 'login'){
			header('Content-Type: application/json');
			//session_start();
			//$sql = "SELECT * FROM usuario_painel WHERE senha_usuario = :senha AND status = 0";
			$sql = "SELECT * FROM usuarios WHERE usuario_painel = :usuario AND senha_painel = :senha AND acesso_painel = 1";
			$cmd = $con->prepare($sql);
			$cmd->bindValue(':usuario',$_REQUEST['usuario']);
			$cmd->bindValue(':senha',md5($_REQUEST['senha']));
			$cmd->execute();

			if($cmd->rowCount() > 0){
				$dados_usuario = $cmd->fetch();
				session_start();
				$_SESSION['dados_usuario']['auth'] = 1;
				$_SESSION['dados_usuario']['id_usuario'] = $dados_usuario["id_usuario"];
				$_SESSION['dados_usuario']['nome_usuario'] = $dados_usuario["nome_discord_usuario"];
				$_SESSION['dados_usuario']['id_discord'] = $dados_usuario["id_discord_usuario"];
				//$_SESSION['dados_usuario']['tag_usuario'] = $dados_usuario["tag_usuario"];
				$_SESSION['dados_usuario']['permissoes_acesso'] = array();
				// Busca Informações sobre as permissoes de acesso
				//$sql_permissao_acesso = "SELECT pp.permissoes_painel_id,nome_permissoes_painel FROM permissoes_painel pp JOIN acesso_painel ac ON pp.permissoes_painel_id = ac.permissoes_painel_id JOIN usuario_painel up ON up.usuario_painel_id = ac.usuario_painel_id WHERE up.usuario_painel_id = '".$_SESSION['dados_usuario']['id_usuario']."'";
				$sql_permissao_acesso = "SELECT pp.permissoes_painel_id,nome_permissoes_painel FROM permissoes_painel pp JOIN acesso_painel ac ON pp.permissoes_painel_id = ac.id_permissoes JOIN usuarios u ON u.id_usuario = ac.id_usuarios WHERE u.id_usuario = '".$_SESSION['dados_usuario']['id_usuario']."'";
				//$sql_permissao_acesso = "SELECT lpa.id_permissoes,nome_permissoes FROM permissoes_usuario pu JOIN lista_permissoes_acesso lpa ON lpa.id_permissoes = pu.id_permissoes JOIN usuarios u ON u.id_usuario = pu.id_usuarios WHERE u.id_usuario = '".$_SESSION['dados_usuario']['id_usuario']."'";
				$cmd_permissao_acesso = $con->prepare($sql_permissao_acesso);
				if($cmd_permissao_acesso->execute()){
					if($cmd_permissao_acesso->rowCount() > 0){
						while($linha = $cmd_permissao_acesso->fetch(PDO::FETCH_BOTH)){
							$_SESSION['dados_usuario']['permissoes_acesso'][] = array("id_permissoes_acesso" => $linha["permissoes_painel_id"], "nome_permissoes_acesso" => $linha["nome_permissoes_painel"]);
						}
					}
				} 
				// $token = bin2hex(random_bytes(32));
				// $sql_pesquisa_token = "SELECT * FROM tokens WHERE id_usuario = '".$_SESSION['dados_usuario']['id_usuario']."' AND status = 1";
				// $cmd_pesquisa_token = $con->prepare($sql_pesquisa_token);
				// $cmd_pesquisa_token->execute();
				// if(!$cmd_pesquisa_token->rowCount() > 0){
				// 	$sql = "INSERT INTO tokens (id_usuario, token, status) VALUES (:id_usuario, :token, :status)";
				// 	$cmd = $con->prepare($sql);
				// 	$cmd->bindValue(':id_usuario',$_SESSION['dados_usuario']['id_usuario']);
				// 	$cmd->bindValue(':token', $token);
				// 	$cmd->bindValue(':status', 1);
				// 	$cmd->execute();
				// 	// Gravando o token na sessão 
				// 	$_SESSION['dados_usuario']['token_acesso_painel'] = $token;
				// }
				//$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				//insert_log('Fez Login '.$ip);
				echo json_encode('ok');
				//$registro_log = "Fez Login -'".$ip."";
			} else {
				echo json_encode('senha_invalida');
			}
		}
	}
	 session_start();
	// $usuario = $_SESSION['dados_usuario']['id_usuario'];
	// //echo $usuario;
	// //echo "TESTE";
	// header('Content-Type: application/json');
	// $sql_token = "SELECT * FROM tokens WHERE id_usuario = '".$usuario."' AND status = 1'";
	// $cmd_token = $con->prepare($sql_token);
	// $cmd_token->execute();
	// $row = $cmd_token->fetch();
	// $token_db = $row["token"];

	// if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $token_db) {

		// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// 	if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
		// 		// Token CSRF válido, continue com o processamento da requisição.

		//Trava
		if (isset($_SESSION['dados_usuario']['auth'])) {

		if($_REQUEST['tab'] == 'bateponto'){
        if($_REQUEST['acao'] == 'ultimos_registro'){
            header('Content-Type: application/json');
			//echo $_REQUEST['guarnicao'];
            $sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal ORDER BY id_registros DESC LIMIT 3000"; // Utilizar Inner Join
            $cmd = $con->prepare($sql);
            $cmd->execute();
            $dados = array();
            while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("id_registros" => $row["id_registros"], "dt_inicio" => data_br($row["dt_inicio"]), "dt_final" => data_br($row["dt_final"]), "dt_inicio_c" => $row["dt_inicio"], "dt_final_c" => $row["dt_final"], "nome_canal" => $row["nome_canal_discord"], "nome_usuario" => $row["nome_discord_usuario"], "obs" => $row["obs"]);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);
        } else if($_REQUEST['acao'] == 'relatorio_subdivisao'){
			header('Content-Type: application/json');

			$dt1 = data_en($_POST['data_inicio']);
			$dt2 = data_en($_POST['data_final']);
			$grupo = $_POST['grupo'];
			
			if($grupo[0] == 1){
			$sql_usuario = "SELECT * FROM usuarios WHERE guarnicao LIKE '%P.M.E.R.J%' AND op10 = 1";
			$cmd_usuario = $con->prepare($sql_usuario);
			$cmd_usuario->execute();
			$dados = array();
			$totalHorasPorUsuario = array(); // Array para armazenar o total de horas de cada usuário
			
			while($row = $cmd_usuario->fetch(PDO::FETCH_BOTH)){
				$id_usuario = $row['id_discord_usuario'];
				$nome_usuario = $row['nome_discord_usuario'];
				$sql_registro = "SELECT * FROM usuarios u LEFT JOIN registros r ON r.id_usuario = u.id_usuario LEFT JOIN canais c ON c.id_canal = r.id_canal WHERE u.id_discord_usuario = '".$id_usuario."' AND dt_inicio >= '".$dt1." 00:00:01' AND dt_inicio <= '".$dt2." 23:59:59' AND c.nome_canal_discord REGEXP 'CMD G.T.M|G.T.M|CMD B.P.M|B.P.M'";
				$cmd_registro = $con->prepare($sql_registro);
				$cmd_registro->execute();
				
			
				//$totalSegundosPorUsuario = 0; // Variável para armazenar o total de segundos do usuário atual
				$totalSegundosPorUsuario = array();
				while($row_registro = $cmd_registro->fetch(PDO::FETCH_BOTH)){
					$dataInicio = new DateTime($row_registro['dt_inicio']);
					$dataFinal = new DateTime($row_registro['dt_final']);


					if (!isset($totalSegundosPorUsuario[$nome_usuario])) {
						//echo "".$nome_usuario." Não tem Registro";
						$totalSegundosPorUsuario[$nome_usuario] = '00:00:00';
					}
					
					$diferenca = $dataFinal->diff($dataInicio);
					$segundos = $diferenca->s + $diferenca->i * 60 + $diferenca->h * 3600;
					$totalSegundosPorUsuario[$nome_usuario] += $segundos; // soma os segundos deste registro ao total do usuário

					// echo "-----------------------";
					// print_r($totalSegundosPorUsuario);
					// echo "------------------------";
				}

				 foreach ($totalSegundosPorUsuario as $nome_usuario => $segundos) {
					$horas = floor($segundos / 3600);
					$minutos = floor(($segundos % 3600) / 60);
					$segundos = $segundos % 60;
					$horas_ = str_pad($horas, 2, '0', STR_PAD_LEFT);
					$minutos_ = str_pad($minutos, 2, '0', STR_PAD_LEFT);
					$segundos_ = str_pad($segundos, 2, '0', STR_PAD_LEFT);
					$total_horas = "$horas_:$minutos_:$segundos_";
					$dados_final[] = array("nome" => $nome_usuario,"horas" => $total_horas); #, "sql" => $sql_registro);    
				}

			}
			//echo count($dados_final);
			$matriz = array('resp'=>'ok','dados' => $dados_final);
			echo json_encode($matriz);

			} else if($grupo[0] == 2){
				$sql_usuario = "SELECT * FROM usuarios WHERE guarnicao LIKE '%P.M.E.R.J%' AND op12 = 1";
				$cmd_usuario = $con->prepare($sql_usuario);
				$cmd_usuario->execute();
				$dados = array();
				$totalHorasPorUsuario = array(); // Array para armazenar o total de horas de cada usuário
				
				while($row = $cmd_usuario->fetch(PDO::FETCH_BOTH)){
					
					$id_usuario = $row['id_discord_usuario'];
					$nome_usuario = $row['nome_discord_usuario'];
					$sql_registro = "SELECT * FROM usuarios u LEFT JOIN registros r ON r.id_usuario = u.id_usuario LEFT JOIN canais c ON c.id_canal = r.id_canal WHERE u.id_discord_usuario = '".$id_usuario."' AND dt_inicio >= '".$dt1." 00:00:01' AND dt_inicio <= '".$dt2." 23:59:59' AND c.nome_canal_discord REGEXP 'CMD G.A.M|G.A.M'";
					$cmd_registro = $con->prepare($sql_registro);
					$cmd_registro->execute();
					
				
					//$totalSegundosPorUsuario = 0; // Variável para armazenar o total de segundos do usuário atual
					$totalSegundosPorUsuario = array();
					while($row_registro = $cmd_registro->fetch(PDO::FETCH_BOTH)){
						$dataInicio = new DateTime($row_registro['dt_inicio']);
						$dataFinal = new DateTime($row_registro['dt_final']);
	
	
						if (!isset($totalSegundosPorUsuario[$nome_usuario])) {
							//echo "".$nome_usuario." Não tem Registro";
							$totalSegundosPorUsuario[$nome_usuario] = '00:00:00';
						}
						
						$diferenca = $dataFinal->diff($dataInicio);
						$segundos = $diferenca->s + $diferenca->i * 60 + $diferenca->h * 3600;
						$totalSegundosPorUsuario[$nome_usuario] += $segundos; // soma os segundos deste registro ao total do usuário
	
						// echo "-----------------------";
						// print_r($totalSegundosPorUsuario);
						// echo "------------------------";
					}
	
					 foreach ($totalSegundosPorUsuario as $nome_usuario => $segundos) {
						$horas = floor($segundos / 3600);
						$minutos = floor(($segundos % 3600) / 60);
						$segundos = $segundos % 60;
						$horas_ = str_pad($horas, 2, '0', STR_PAD_LEFT);
						$minutos_ = str_pad($minutos, 2, '0', STR_PAD_LEFT);
						$segundos_ = str_pad($segundos, 2, '0', STR_PAD_LEFT);
						$total_horas = "$horas_:$minutos_:$segundos_";
						$dados_final[] = array("nome" => $nome_usuario,"horas" => $total_horas, "sql" => $sql_registro);      
					}
	
				}
				//echo count($dados_final);
				$matriz = array('resp'=>'ok','dados' => $dados_final);
				echo json_encode($matriz);
			} else if($grupo[0] == 3){
				$sql_usuario = "SELECT * FROM usuarios WHERE guarnicao LIKE '%P.M.E.R.J%' AND op13 = 1";
				$cmd_usuario = $con->prepare($sql_usuario);
				$cmd_usuario->execute();
				$dados = array();
				$totalHorasPorUsuario = array(); // Array para armazenar o total de horas de cada usuário
				
				while($row = $cmd_usuario->fetch(PDO::FETCH_BOTH)){
					
					$id_usuario = $row['id_discord_usuario'];
					$nome_usuario = $row['nome_discord_usuario'];
					$sql_registro = "SELECT * FROM usuarios u LEFT JOIN registros r ON r.id_usuario = u.id_usuario LEFT JOIN canais c ON c.id_canal = r.id_canal WHERE u.id_discord_usuario = '".$id_usuario."' AND dt_inicio >= '".$dt1." 00:00:01' AND dt_inicio <= '".$dt2." 23:59:59' AND c.nome_canal_discord REGEXP 'PATAMO'";
					$cmd_registro = $con->prepare($sql_registro);
					$cmd_registro->execute();
					
				
					//$totalSegundosPorUsuario = 0; // Variável para armazenar o total de segundos do usuário atual
					$totalSegundosPorUsuario = array();
					while($row_registro = $cmd_registro->fetch(PDO::FETCH_BOTH)){
						$dataInicio = new DateTime($row_registro['dt_inicio']);
						$dataFinal = new DateTime($row_registro['dt_final']);
	
	
						if (!isset($totalSegundosPorUsuario[$nome_usuario])) {
							//echo "".$nome_usuario." Não tem Registro";
							$totalSegundosPorUsuario[$nome_usuario] = '00:00:00';
						}
						
						$diferenca = $dataFinal->diff($dataInicio);
						$segundos = $diferenca->s + $diferenca->i * 60 + $diferenca->h * 3600;
						$totalSegundosPorUsuario[$nome_usuario] += $segundos; // soma os segundos deste registro ao total do usuário
	
						// echo "-----------------------";
						// print_r($totalSegundosPorUsuario);
						// echo "------------------------";
					}
	
					 foreach ($totalSegundosPorUsuario as $nome_usuario => $segundos) {
						$horas = floor($segundos / 3600);
						$minutos = floor(($segundos % 3600) / 60);
						$segundos = $segundos % 60;
						$horas_ = str_pad($horas, 2, '0', STR_PAD_LEFT);
						$minutos_ = str_pad($minutos, 2, '0', STR_PAD_LEFT);
						$segundos_ = str_pad($segundos, 2, '0', STR_PAD_LEFT);
						$total_horas = "$horas_:$minutos_:$segundos_";
						$dados_final[] = array("nome" => $nome_usuario,"horas" => $total_horas, "sql1" => $sql_usuario, "sql" => $sql_registro);      
					}
	
				}
				//echo count($dados_final);
				$matriz = array('resp'=>'ok','dados' => $dados_final,"sql1" => $sql_usuario, "sql" => $sql_registro);
				echo json_encode($matriz);
			} else if($grupo[0] == 5){
				$sql_usuario = "SELECT * FROM usuarios WHERE guarnicao LIKE '%P.M.E.R.J%' AND op14 = 1";
				$cmd_usuario = $con->prepare($sql_usuario);
				$cmd_usuario->execute();
				$dados = array();
				$totalHorasPorUsuario = array(); // Array para armazenar o total de horas de cada usuário
				
				while($row = $cmd_usuario->fetch(PDO::FETCH_BOTH)){
					
					$id_usuario = $row['id_discord_usuario'];
					$nome_usuario = $row['nome_discord_usuario'];
					$sql_registro = "SELECT * FROM usuarios u LEFT JOIN registros r ON r.id_usuario = u.id_usuario LEFT JOIN canais c ON c.id_canal = r.id_canal WHERE u.id_discord_usuario = '".$id_usuario."' AND dt_inicio >= '".$dt1." 00:00:01' AND dt_inicio <= '".$dt2." 23:59:59' AND c.nome_canal_discord REGEXP 'CMD BPChq|BPChq'";
					$cmd_registro = $con->prepare($sql_registro);
					$cmd_registro->execute();
					
				
					//$totalSegundosPorUsuario = 0; // Variável para armazenar o total de segundos do usuário atual
					$totalSegundosPorUsuario = array();
					while($row_registro = $cmd_registro->fetch(PDO::FETCH_BOTH)){
						$dataInicio = new DateTime($row_registro['dt_inicio']);
						$dataFinal = new DateTime($row_registro['dt_final']);
	
	
						if (!isset($totalSegundosPorUsuario[$nome_usuario])) {
							//echo "".$nome_usuario." Não tem Registro";
							$totalSegundosPorUsuario[$nome_usuario] = '00:00:00';
						}
						
						$diferenca = $dataFinal->diff($dataInicio);
						$segundos = $diferenca->s + $diferenca->i * 60 + $diferenca->h * 3600;
						$totalSegundosPorUsuario[$nome_usuario] += $segundos; // soma os segundos deste registro ao total do usuário
	
						// echo "-----------------------";
						// print_r($totalSegundosPorUsuario);
						// echo "------------------------";
					}
	
					 foreach ($totalSegundosPorUsuario as $nome_usuario => $segundos) {
						$horas = floor($segundos / 3600);
						$minutos = floor(($segundos % 3600) / 60);
						$segundos = $segundos % 60;
						$horas_ = str_pad($horas, 2, '0', STR_PAD_LEFT);
						$minutos_ = str_pad($minutos, 2, '0', STR_PAD_LEFT);
						$segundos_ = str_pad($segundos, 2, '0', STR_PAD_LEFT);
						$total_horas = "$horas_:$minutos_:$segundos_";
						$dados_final[] = array("nome" => $nome_usuario,"horas" => $total_horas); #, "sql" => $sql_registro);   
					}
	
				}
				//echo count($dados_final);
				$matriz = array('resp'=>'ok','dados' => $dados_final,'sql' => $sql_registro);
				echo json_encode($matriz);
			} else if($grupo[0] == 6){
				$sql_usuario = "SELECT * FROM usuarios WHERE guarnicao LIKE '%P.M.E.R.J%' AND op9 = 1";
				$cmd_usuario = $con->prepare($sql_usuario);
				$cmd_usuario->execute();
				$dados = array();
				$totalHorasPorUsuario = array(); // Array para armazenar o total de horas de cada usuário
				
				while($row = $cmd_usuario->fetch(PDO::FETCH_BOTH)){
					
					$id_usuario = $row['id_discord_usuario'];
					$nome_usuario = $row['nome_discord_usuario'];
					$sql_registro = "SELECT * FROM usuarios u LEFT JOIN registros r ON r.id_usuario = u.id_usuario LEFT JOIN canais c ON c.id_canal = r.id_canal WHERE u.id_discord_usuario = '".$id_usuario."' AND dt_inicio >= '".$dt1." 00:00:01' AND dt_inicio <= '".$dt2." 23:59:59' AND c.nome_canal_discord REGEXP 'CMD B.O.P.E|B.O.P.E¹|B.O.P.E²|B.O.P.E³'";
					$cmd_registro = $con->prepare($sql_registro);
					$cmd_registro->execute();
					
				
					//$totalSegundosPorUsuario = 0; // Variável para armazenar o total de segundos do usuário atual
					$totalSegundosPorUsuario = array();
					while($row_registro = $cmd_registro->fetch(PDO::FETCH_BOTH)){
						$dataInicio = new DateTime($row_registro['dt_inicio']);
						$dataFinal = new DateTime($row_registro['dt_final']);
	
	
						if (!isset($totalSegundosPorUsuario[$nome_usuario])) {
							//echo "".$nome_usuario." Não tem Registro";
							$totalSegundosPorUsuario[$nome_usuario] = '00:00:00';
						}
						
						$diferenca = $dataFinal->diff($dataInicio);
						$segundos = $diferenca->s + $diferenca->i * 60 + $diferenca->h * 3600;
						$totalSegundosPorUsuario[$nome_usuario] += $segundos; // soma os segundos deste registro ao total do usuário
	
						// echo "-----------------------";
						// print_r($totalSegundosPorUsuario);
						// echo "------------------------";
					}
	
					 foreach ($totalSegundosPorUsuario as $nome_usuario => $segundos) {
						$horas = floor($segundos / 3600);
						$minutos = floor(($segundos % 3600) / 60);
						$segundos = $segundos % 60;
						$horas_ = str_pad($horas, 2, '0', STR_PAD_LEFT);
						$minutos_ = str_pad($minutos, 2, '0', STR_PAD_LEFT);
						$segundos_ = str_pad($segundos, 2, '0', STR_PAD_LEFT);
						$total_horas = "$horas_:$minutos_:$segundos_";
						$dados_final[] = array("nome" => $nome_usuario,"horas" => $total_horas); #, "sql" => $sql_registro); 
					}
	
				}
				//echo count($dados_final);
				$matriz = array('resp'=>'ok','dados' => $dados_final,'sql' => $sql_registro);
				echo json_encode($matriz);
			} else if($grupo[0] == 4){
				$sql_usuario = "SELECT * FROM usuarios WHERE guarnicao LIKE '%P.M.E.R.J%' AND op15 = 1";
				$cmd_usuario = $con->prepare($sql_usuario);
				$cmd_usuario->execute();
				$dados = array();
				$totalHorasPorUsuario = array(); // Array para armazenar o total de horas de cada usuário
				
				while($row = $cmd_usuario->fetch(PDO::FETCH_BOTH)){
					
					$id_usuario = $row['id_discord_usuario'];
					$nome_usuario = $row['nome_discord_usuario'];
					$sql_registro = "SELECT * FROM usuarios u LEFT JOIN registros r ON r.id_usuario = u.id_usuario LEFT JOIN canais c ON c.id_canal = r.id_canal WHERE u.id_discord_usuario = '".$id_usuario."' AND dt_inicio >= '".$dt1." 00:00:01' AND dt_inicio <= '".$dt2." 23:59:59' AND c.nome_canal_discord REGEXP 'NULO|P.M SUP|CMD P.M'";
					$cmd_registro = $con->prepare($sql_registro);
					$cmd_registro->execute();
					
				
					//$totalSegundosPorUsuario = 0; // Variável para armazenar o total de segundos do usuário atual
					$totalSegundosPorUsuario = array();
					while($row_registro = $cmd_registro->fetch(PDO::FETCH_BOTH)){
						$dataInicio = new DateTime($row_registro['dt_inicio']);
						$dataFinal = new DateTime($row_registro['dt_final']);
	
	
						if (!isset($totalSegundosPorUsuario[$nome_usuario])) {
							//echo "".$nome_usuario." Não tem Registro";
							$totalSegundosPorUsuario[$nome_usuario] = '00:00:00';
						}
						
						$diferenca = $dataFinal->diff($dataInicio);
						$segundos = $diferenca->s + $diferenca->i * 60 + $diferenca->h * 3600;
						$totalSegundosPorUsuario[$nome_usuario] += $segundos; // soma os segundos deste registro ao total do usuário
	
						// echo "-----------------------";
						// print_r($totalSegundosPorUsuario);
						// echo "------------------------";
					}
	
					 foreach ($totalSegundosPorUsuario as $nome_usuario => $segundos) {
						$horas = floor($segundos / 3600);
						$minutos = floor(($segundos % 3600) / 60);
						$segundos = $segundos % 60;
						$horas_ = str_pad($horas, 2, '0', STR_PAD_LEFT);
						$minutos_ = str_pad($minutos, 2, '0', STR_PAD_LEFT);
						$segundos_ = str_pad($segundos, 2, '0', STR_PAD_LEFT);
						$total_horas = "$horas_:$minutos_:$segundos_";
						$dados_final[] = array("nome" => $nome_usuario,"horas" => $total_horas); #, "sql" => $sql_registro); 
					}
	
				}
				//echo count($dados_final);
				$matriz = array('resp'=>'ok','dados' => $dados_final,'sql' => $sql_registro);
				echo json_encode($matriz);
			}
			


		} else	if($_REQUEST['acao'] == 'exibe_logs'){
            header('Content-Type: application/json');
			$sql_log = "SELECT * FROM logs_ponto WHERE dt_logs >= DATE(NOW() - INTERVAL 30 DAY) ";
			session_start();
			$sql = "SELECT * FROM usuarios WHERE nome_discord_usuario = '".$_SESSION['dados_usuario']['nome_usuario']."'";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			if($cmd->rowCount() > 0){
				$tmp_dados = $cmd->fetch();
				if($tmp_dados["guarnicao"] == '- P.M.E.R.J'){
						$sql_log .= "AND usuario REGEXP 'CMD|BOPE|CHOQUE|PM|SD¹|SD²|CB|SGT|SBT|CDT|TNT|CAP|MAJOR' ORDER BY id_ponto_logs DESC";
				} else if($tmp_dados["guarnicao"] == '- P.C.E.R.J'){
					$sql_log .= "AND usuario REGEXP 'P.C¹|P.C²|P.C³|CORE|AGT ᵉˢᵖ|DEL.GERAL|DEL.ᵃᵈʲ| ' ORDER BY id_ponto_logs DESC";
				} else if($tmp_dados["guarnicao"] == "- P.R.F"){
					$sql_log .= "AND usuario REGEXP 'DIRETOR|DEL.ᵃᵈʲ|ᵖʳᶠ|COORD CHEFE|GRR|ⁿᵒᵉ|NOE|P.R.F.¹|P.R.F.²|P.R.F³' ORDER BY id_ponto_logs DESC";
				} else if($tmp_dados["guarnicao"] == "- Polícia Federal"){
					$sql_log .= "AND usuario REGEXP 'P.F¹|P.F ²|P.F³|P.F⁴|COT|CMD.COT|SUB.COT|INSP ᵖᶠ|COORD ᵖᶠ|ᵖᶠ|Catra' ORDER BY id_ponto_logs DESC";
				}
			}

           // $sql = "SELECT * FROM logs_ponto WHERE dt_logs >= DATE(NOW() - INTERVAL 2 DAY) ORDER BY id_ponto_logs DESC"; // Utilizar Inner Join
            $cmd = $con->prepare($sql_log);
            $cmd->execute();
            $dados = array();
            while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("id_registro" => $row["id_ponto_logs"], "dt" => data_br($row["dt_logs"]), "dados" => $row["dados_logs"], "usuario" => $row['usuario']);
			}
			$matriz = array('resp'=>'ok','dados' => $dados,'sql' => $sql_log);
			echo json_encode($matriz);
        } else if($_REQUEST['acao'] == 'relatorio_dia'){
			header('Content-Type: application/json');
			$g = $_POST['guarnicao'];
			$busca_deletado = $_POST['registro_deletado'];
			if($_POST['data'] == null){
				$matriz = array('resp' => 'faltando_data');
				echo json_encode($matriz);
			} else if($_POST['usuario'] == null){
				$matriz = array('resp' => 'faltando_usuario');
				echo json_encode($matriz);
			} else {
				$sql_check = "SELECT * FROM usuarios WHERE id_usuario = '".$_POST['usuario']."'";
				$cmd_check = $con->prepare($sql_check);
				$cmd_check->execute();
				if(!$cmd_check->rowCount() > 0){
					echo "Não existe Registro";
					$matriz = array('resp' => 'usuario_nao_encontrado');
					echo json_encode($matriz);
				} else {
					//echo "existe Registro";
					$dt = $_POST['data'];
					$dt_ = data_en($dt);
					// Verificando qual guarnição foi Selecionada
					if($g[0] == 1){
						$guarnicao = 'NULO|P.M SUP|CMD P.M';
					} else if($g[0] == 2){
						$guarnicao = 'CMD G.T.M|G.T.M|CMD B.P.M|B.P.M';
					} else if($g[0] == 3){
						$guarnicao = 'CMD G.A.M|G.A.M';
					} else if($g[0] == 4){
						$guarnicao = 'PATAMO';
					} else if($g[0] == 5){
						$guarnicao = 'BPVe';
					} else if($g[0] == 6){
						$guarnicao = 'CMD B.O.P.E|B.O.P.E¹|B.O.P.E²|B.O.P.E³';
					} else if($g[0] == 7){
						$guarnicao = 'CMD BPChq|BPChq';
					} else if($g[0] == 8){
						$guarnicao = 'Em Cursos¹|Em Cursos²|Em Cursos';
					} else if($g[0] == 9){
						$guarnicao = 'Reunião';
						//$guarnicao = 'Reunião P.M|Reunião B.O.P.E|Reunião C.H.O.Q.U.E|Reunião geral|Reunião P.C|Reunião C.O.R.E';
					} else if($g[0] == 10){
						$guarnicao = 'Instrutores P.M|Instrutores B.O.P.E|Instrutores C.H.O.Q.U.E|Instrutores';
					} else if($g[0] == 11){
						$guarnicao = 'Comando Geral|Comando P.F|Comando P.M.E.R.J|Comando B.O.P.E|Comando C.H.O.Q.U.E|Comando P.C.E.R.J|Comando C.O.R.E|Comando P.R.F|Comando G.R.R|Comando N.O.E|Comando C.O.E|Aguardando Comando';
					} else if($g[0] == 12){
						$guarnicao = 'Aguardando PTR - PMERJ';
					} else if($g[0] == 14){
						$guarnicao = 'Incursões|Ronda Ostensiva';
					} else if($g[0] == 15){
						$guarnicao = 'CMD P.C.E.R.J|P.C.E.R.J¹|P.C.E.R.J²|P.C.E.R.J³|P.C.E.R.J⁴|P.C.E.R.J⁵|P.C.E.R.J⁶|P.C.E.R.J⁷|P.C.E.R.J⁸';
					} else if($g[0] == 16){
						$guarnicao = 'CMD S.A.E.R|S.A.E.R';
					} else if($g[0] == 17){
						$guarnicao = 'CMD G.E.T.E.M|G.E.T.E.M';
					} else if($g[0] == 18){
						$guarnicao = 'CMD C.O.R.E|C.O.R.E¹|C.O.R.E²|C.O.R.E³';
					} else if($g[0] == 19){
						$guarnicao = 'INVESTIGANDO';
					} else if($g[0] == 20){
						$guarnicao = 'Aguardando PTR - PCERJ';
					} else if($g[0] == 21){
						$guarnicao = 'C.O.E¹|C.O.E²|C.O.E³|CMD C.O.E';
					} else if($g[0] == 22){
						$guarnicao = 'G.T.M C.O.E';
					} else if($g[0] == 23){
						$guarnicao = 'G.A.M C.O.E';
					} else if($g[0] == 24){
						$guarnicao = 'C.O.E¹|C.O.E²|C.O.E³|G.A.M C.O.E|CMD C.O.E|G.A.M. C.O.E¹|GTM C.O.E';
					} else if($g[0] == 25){
						$guarnicao = 'CMD P.F|Supervisão P.F|P.F¹|P.F²|P.F³|P.F⁴|P.F⁵';
					} else if($g[0] == 26){
						$guarnicao = 'CMD C.O.T|C.O.T¹|C.O.T²';
					} else if($g[0] == 27){
						$guarnicao = 'G.A.P.E';
					} else if($g[0] == 28){
						$guarnicao = 'C.A.O.P¹|C.A.O.P²';
					} else if($g[0] == 29){
						$guarnicao = 'Comando P.F|Comando C.O.T';
					} else if($g[0] == 30){
						$guarnicao = 'Corregedoria P.F';
					} else if($g[0] == 31){
						$guarnicao = 'Em Cursos|Sala #1|Sala #2';
					} else if($g[0] == 32){
						$guarnicao = 'Instrutores C.O.T|Instrutores P.F';
					} else if($g[0] == 33){
						$guarnicao = 'Em Cursos';
					} else if($g[0] == 34){
						$guarnicao = 'Reunião C.O.T|Reunião P.F';
					} else if($g[0] == 35){
						$guarnicao = 'Comando C.O.E';
					} else if($g[0] == 36){
						$guarnicao = 'DEMON';
					} else if($g[0] == 37){
						$guarnicao = 'P.R.F¹|P.R.F²|P.R.F³|P.R.F⁴|P.R.F⁵|P.R.F⁶|P.R.F⁷|P.R.F⁸|P.R.F⁹|CMD P.R.F';
					} else if($g[0] == 38){
						$guarnicao = 'CMD SPEED|SPEED';
					} else if($g[0] == 39){
						$guarnicao = 'D.O.A';
					} else if($g[0] == 40){
						$guarnicao = 'CMD B.T.M|B.T.M';
					} else if($g[0] == 41){
						$guarnicao = 'CMD G.R.R|G.R.R¹|G.R.R²';
					} else if($g[0] == 42){
						$guarnicao = 'CMD N.O.E|N.O.E¹|N.O.E²';
					} else if($g[0] == 43){
						$guarnicao = 'INVESTIGANDO N.O.E';
					} else if($g[0] == 44){
						$guarnicao = 'Blitz';
					} else if($g[0] == 45){
						$guarnicao = 'Incursões|Ronda Ostensiva|Aguardando PTR - PMERJ|Comando Geral|Comando P.F|Comando P.M.E.R.J|Comando B.O.P.E|Comando C.H.O.Q.U.E|Comando P.C.E.R.J|Comando C.O.R.E|Comando P.R.F|Comando G.R.R|Comando N.O.E|Comando C.O.E|Reunião P.M|Reunião B.O.P.E|Reunião C.H.O.Q.U.E|Reunião geral|Aguardando Comando|Instrutores P.M|Instrutores B.O.P.E|Instrutores C.H.O.Q.U.E|NULO|P.M SUP|CMD P.M|CMD G.T.M|G.T.M|CMD B.P.M|B.P.M|CMD G.A.M|G.A.M|PATAMO|CMD B.O.P.E|B.O.P.E¹|B.O.P.E²|B.O.P.E³|CMD BPChq|BPChq|Em Cursos¹|Em Cursos²|Em Cursos';
					} else if($g[0] == 46){
						$guarnicao = 'Reunião P.C|Reunião C.O.R.E|CMD P.C.E.R.J|P.C.E.R.J¹|P.C.E.R.J²|P.C.E.R.J³|P.C.E.R.J⁴|P.C.E.R.J⁵|P.C.E.R.J⁶|P.C.E.R.J⁷|P.C.E.R.J⁸|CMD S.A.E.R|S.A.E.R|CMD G.E.T.E.M|G.E.T.E.M|CMD C.O.R.E|C.O.R.E¹|C.O.R.E²|C.O.R.E³|INVESTIGANDO P.C.E.R.J|Aguardando PTR - PCERJ|C.O.E¹|C.O.E²|C.O.E³|CMD C.O.E|Em Cursos|Administrativo|Instrutores P.C|Instrutores C.O.R.E|Comando';
					} else if($g[0] == 47){
						$guarnicao = 'P.R.F¹|P.R.F²|P.R.F³|P.R.F⁴|P.R.F⁵|P.R.F⁶|P.R.F⁷|P.R.F⁸|P.R.F⁹|CMD P.R.F|CMD SPEED|SPEED|D.O.A|CMD B.T.M|B.T.M|CMD G.R.R|G.R.R¹|G.R.R²|CMD N.O.E|N.O.E¹|N.O.E²|INVESTIGANDO N.O.E|Blitz|Comando';
					} else if($g[0] == 48){
						$guarnicao = 'CMD P.F|Supervisão P.F|P.F¹|P.F²|P.F³|P.F⁴|P.F⁵|CMD C.O.T|C.O.T¹|C.O.T²|G.A.P.E|C.A.O.P¹|C.A.O.P²|Comando P.F|Comando C.O.T|Corregedoria P.F|Em Cursos|Sala #1|Sala #2|Instrutores C.O.T|Instrutores P.F';
					}  else if($g[0] == 0){
						$guarnicao = '$';
					}
					unset($sql);
					if($busca_deletado == 0){			
						//$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio LIKE '%".$dt_."%' AND u.id_usuario = '".$_POST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."' AND del <> 1 AND nome_canal_discord != '「⏰」Aguardando PTR'";
						$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio LIKE '%".$dt_."%' AND u.id_usuario = '".$_POST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."' AND id_canal_discord != '1203823497621540984' AND id_canal_discord != '1180709468456095782' AND del <> 1 AND c.id_canal != 568";
						//$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio LIKE '%".$dt_."%' AND u.id_usuario = '".$_POST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."'  AND del <> 1 AND c.id_canal != 568";
					} else {
						//$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio LIKE '%".$dt_."%' AND u.id_usuario = '".$_POST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."' AND nome_canal_discord != '「⏰」Aguardando PTR'";
						$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio LIKE '%".$dt_."%' AND u.id_usuario = '".$_POST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."' AND id_canal_discord != '1203823497621540984' AND id_canal_discord != '1180709468456095782' AND c.id_canal != 568";
						//$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio LIKE '%".$dt_."%' AND u.id_usuario = '".$_POST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."' AND c.id_canal != 568";
					}

		
					$cmd = $con->prepare($sql);
					$cmd->execute();
					$dados = array();
					while($row = $cmd->fetch(PDO::FETCH_BOTH)){
						$dados[] = array("id_registro" => $row["id_registros"], "dt_inicio" => data_br($row["dt_inicio"]), "dt_final" => data_br($row["dt_final"]), "nome_canal" => $row["nome_canal_discord"], "nome_usuario" => $row["nome_discord_usuario"], "del" => $row["del"], "id_canal_discord" => $row['id_canal_discord']);
					}
					if($dados == null){
						$matriz = array('resp' => 'ok','dados' => $dados,'dados_' => 'null');
						//$matriz = array('resp' => 'registro_nao_encontrado', 'sql' => $sql);
						echo json_encode($matriz);
					} else {
					//$matriz = array('resp'=>'ok','dados' => $dados);
					//echo json_encode($matriz);
					$matriz = array('resp' => 'ok','dados' => $dados);
					echo json_encode($matriz);

					}
				
				}
			}
		} else if($_REQUEST['acao'] == 'lista_usuarios'){
			header('Content-Type: application/json');
			// Adicionar verificação de guarnição, para exibir somente os usuarios que pertece a mesma guarnição

			$sql_usuarios = "SELECT * FROM usuarios";
			session_start();
			$sql = "SELECT * FROM usuarios WHERE nome_discord_usuario = '".$_SESSION['dados_usuario']['nome_usuario']."'";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			
			// if($cmd->rowCount() > 0){
			// 	$tmp_dados = $cmd->fetch();
				// Montando o SELECT conforme a Guarnição
				//if($tmp_dados["guarnicao"] == '- P.M.E.R.J'){
				// 	$sql_usuarios .= "WHERE guarnicao = '- P.M.E.R.J'";
				// 	// if($tmp_dados["equipe"] == 'pmerj_comando'){
				// 	// 	$equipe = 'pmerj_comando';
				// 	// 	$sql_usuarios .= "WHERE guarnicao = '- P.M.E.R.J'";
				// 	// } else if($tmp_dados["equipe"] == 'pmerj_comando_bpchq'){
				// 	// 	$equipe = 'pmerj_comando_bpchq';
				// 	// 	$sql_usuarios .= "WHERE guarnicao = '- P.M.E.R.J' AND nome_discord_usuario LIKE '%CHOQUE%'";
				// 	// } else if($tmp_dados["equipe"] == 'pmerj_subcomando_bpchq'){
				// 	// 	$equipe = 'pmerj_subcomando_bpchq';
				// 	// 	$sql_usuarios .= "WHERE guarnicao = '- P.M.E.R.J' AND nome_discord_usuario LIKE '%CHOQUE%'";
				// 	// } else if($tmp_dados["equipe"] == 'pmerj_subcomando_BOPE'){
				// 	// 	$equipe = 'pmerj_subcomando_BOPE';
				// 	// 	$sql_usuarios .= "WHERE guarnicao = '- P.M.E.R.J' AND nome_discord_usuario LIKE '%BOPE%'";
				// 	// } else if($tmp_dados["equipe"] == 'pmerj_alpha' OR $tmp_dados["equipe"] == 'pmerj_bravo' OR $tmp_dados["equipe"] == 'pmerj_charlie' OR $tmp_dados["equipe"] == 'pmerj_delta' OR $tmp_dados["equipe"] == 'pmerj_echo' OR $tmp_dados["equipe"] == 'pmerj_foxtrot' OR $tmp_dados["equipe"] == 'pmerj_golf' OR $tmp_dados["equipe"] == 'pmerj_hotel'){
				// 	// 	$sql_usuarios .= "WHERE guarnicao = '- P.M.E.R.J' AND nome_discord_usuario = '".$_SESSION['dados_usuario']['nome_usuario']."'";
				// 	// } else if($tmp_dados["equipe"] == 'all'){
				// 	// 	$sql_log .= "";
				// 	// }
				// } else if($tmp_dados["guarnicao"] == '- P.R.F'){
				// 	$sql_usuarios .= "WHERE guarnicao = '- P.R.F'";
				// } else if($tmp_dados["guarnicao"] == '- P.C.E.R.J'){
				//  	$sql_usuarios .= "WHERE guarnicao = '- P.C.E.R.J'";
				// } else if($tmp_dados["guarnicao"] == '- Polícia Federal'){
				// 	$sql_usuarios .= "WHERE guarnicao = '- Polícia Federal'";
				// } else if($tmp_dados["guarnicao"] == 'comando_geral'){
				// 	$sql_usuarios .= "WHERE guarnicao LIKE '%-%'";
				// }
				// echo "Guarnição -> $guarnicao \n";
				// echo "Equipe -> $equipe \n";
				// echo "SQL -> $sql_usuarios";
				// die();
			//} else {
			//	echo "ERRO";
			//	exit;
			//}
			$cmd = $con->prepare($sql_usuarios);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("id_usuario" => $row["id_usuario"], "nome_usuario" => $row["nome_discord_usuario"]);
			}
			$matriz = array('resp'=>'ok','dados' => $dados,'sql' => $sql_usuarios);
			echo json_encode($matriz);


		}  else if($_REQUEST['acao'] == 'lista_usuarios_coe'){
			header('Content-Type: application/json');
			// Adicionar verificação de guarnição, para exibir somente os usuarios que pertece a mesma guarnição
			$sql = "SELECT * FROM usuarios WHERE op7 = 1";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("id_usuario" => $row["id_usuario"], "nome_usuario" => $row["nome_discord_usuario"]);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);


		} else if($_REQUEST['acao'] == 'lista_usuarios_civil'){
			header('Content-Type: application/json');
			// Adicionar verificação de guarnição, para exibir somente os usuarios que pertece a mesma guarnição
			$sql = "SELECT * FROM usuarios WHERE guarnicao = '- P.C.E.R.J'";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("id_usuario" => $row["id_usuario"], "nome_usuario" => $row["nome_discord_usuario"]);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);


		} else if($_REQUEST['acao'] == 'lista_usuarios_prf'){
			header('Content-Type: application/json');
			// Adicionar verificação de guarnição, para exibir somente os usuarios que pertece a mesma guarnição
			$sql = "SELECT * FROM usuarios WHERE guarnicao = '- P.R.F'";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("id_usuario" => $row["id_usuario"], "nome_usuario" => $row["nome_discord_usuario"]);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);


		} else if($_REQUEST['acao'] == 'lista_usuarios_pmerj'){
			header('Content-Type: application/json');
			// Adicionar verificação de guarnição, para exibir somente os usuarios que pertece a mesma guarnição
			$sql = "SELECT * FROM usuarios WHERE guarnicao = '- P.M.E.R.J'";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("id_usuario" => $row["id_usuario"], "nome_usuario" => $row["nome_discord_usuario"]);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);


		}  else if($_REQUEST['acao'] == 'lista_usuarios_pf'){
			header('Content-Type: application/json');
			// Adicionar verificação de guarnição, para exibir somente os usuarios que pertece a mesma guarnição
			$sql = "SELECT * FROM usuarios WHERE guarnicao = '- Polícia Federal'";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("id_usuario" => $row["id_usuario"], "nome_usuario" => $row["nome_discord_usuario"]);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);


		}  else if($_REQUEST['acao'] == 'lista_todos_usuarios'){
			header('Content-Type: application/json');
			// Adicionar verificação de guarnição, para exibir somente os usuarios que pertece a mesma guarnição
			$sql = "SELECT * FROM usuarios";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("id_usuario" => $row["id_usuario"], "id_discord" => $row['id_discord_usuario'], "nome_usuario" => $row["nome_discord_usuario"]);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);


		} else if($_REQUEST['acao'] == 'relatorio_equipe_dia1'){
			header('Content-Type: application/json');
			$dt = data_en($_POST['dt']);
			$equipe = $_POST['equipe'];

			$sql = "SELECT * FROM usuarios LEFT JOIN registros ON usuarios.id_usuario = registros.id_usuario WHERE equipe = '".$equipe[0]."' AND dt_inicio LIKE '%".$dt."%' AND id_canal != 265";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
			 	$dados[] = array("id_registro" => $row["id_registros"], "id_discord" => $row["id_discord_usuario"], "nome_usuario" => $row['nome_discord_usuario'], "id_usuario" => $row['id_usuario'], "data_inicio" => $row['dt_inicio'], "data_final" => $row['dt_final'], "del" => $row['del']);
			 }
			 // Inicialize a diferença total de horas e minutos
			 $somaDiferencasPorUsuario = [];
			 // Percorra os registros e calcule as diferenças e a soma total por usuário
			 foreach ($dados as $registro) {
				 $nome_discord = $registro['nome_usuario'];
				 $data_inicio = new DateTime($registro['data_inicio']);
				 $data_fim = new DateTime($registro['data_final']);
				 $interval = $data_inicio->diff($data_fim);
			 
				 if (!isset($somaDiferencasPorUsuario[$nome_discord])) {
					 $somaDiferencasPorUsuario[$nome_discord] = new DateInterval('PT0S');
				 }
			 
				 $somaDiferencasPorUsuario[$nome_discord]->h += $interval->h;
				 $somaDiferencasPorUsuario[$nome_discord]->i += $interval->i;

			 }
			 
			 // Exiba a soma total das diferenças de cada usuário
			 foreach ($somaDiferencasPorUsuario as $nome_discord => $diferencaTotal) {
				//echo "Usuário ID $usuario_id: " . $diferencaTotal->format('%H horas %i minutos') . PHP_EOL;
				$horas = $diferencaTotal->s + $diferencaTotal->i * 60 + $diferencaTotal->h * 3600;
				//echo "Usuário ID $usuario_id: " . gmdate("H:i:s", $horas) . PHP_EOL;
				$horas_ = gmdate("H:i:s", $horas);
				$dados_final[] = array("id" => $nome_discord,"horas" => $horas_);   

			 }
			$matriz = array('resp'=>'ok','dados' => $dados_final);
            echo json_encode($matriz);

		} else if($_REQUEST['acao'] == 'relatorio_equipe_dia'){
			header('Content-Type: application/json');
			$dt = data_en($_POST['dt']);
			$equipe = $_POST['equipe'];

			$sql = "SELECT * FROM usuarios LEFT JOIN registros ON usuarios.id_usuario = registros.id_usuario WHERE equipe = '".$equipe[0]."' AND dt_inicio LIKE '%".$dt."%' AND id_canal != 265 AND del <> 1";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
			 	$dados[] = array("id_registro" => $row["id_registros"], "id_discord" => $row["id_discord_usuario"], "nome_usuario" => $row['nome_discord_usuario'], "id_usuario" => $row['id_usuario'], "data_inicio" => $row['dt_inicio'], "data_final" => $row['dt_final'], "del" => $row['del']);
			 }
			 // Inicializa um array para armazenar a soma das horas por usuário
			$somaHorasPorUsuario = array();

			// Processa os registros
			foreach ($dados as $registro) {
    			$idUsuario = $registro['nome_usuario'];
    			$entrada = new DateTime($registro['data_inicio']);
    			$saida = new DateTime($registro['data_final']);

    			$diferenca = $saida->diff($entrada);
    			$intervaloEmSegundos = $diferenca->s + $diferenca->i * 60 + $diferenca->h * 3600;

    			if (!isset($somaHorasPorUsuario[$idUsuario])) {
        			$somaHorasPorUsuario[$idUsuario] = 0;
    			}
				$somaHorasPorUsuario[$idUsuario] += $intervaloEmSegundos;
}

				// Exibe a soma das horas por usuário
				foreach ($somaHorasPorUsuario as $idUsuario => $segundos) {
    				$horas = floor($segundos / 3600);
    				$minutos = floor(($segundos % 3600) / 60);
    				$segundos = $segundos % 60;
					$horas_ = "$horas:$minutos:$segundos";
					$dados_final[] = array("id" => $idUsuario,"horas" => $horas_);   
    				//echo "Usuário $idUsuario: $horas horas, $minutos minutos, $segundos segundos\n";
					//echo "Usuario: $idUsuario: $horas_\n";
				}
				$matriz = array('resp'=>'ok', 'dados' => $dados_final);
				echo json_encode($matriz);

		}   else if($_REQUEST['acao'] == 'relatorio_equipe_datas'){
			header('Content-Type: application/json');
			$dt1 = data_en($_POST['data1']);
			$dt2 = data_en($_POST['data2']);
			$equipe = $_POST['equipe'];

			$sql = "SELECT * FROM usuarios LEFT JOIN registros ON usuarios.id_usuario = registros.id_usuario WHERE equipe = '".$equipe[0]."' AND dt_inicio >='".$dt1." 00:00:01' AND dt_inicio <= '".$dt2." 23:59:59' AND id_canal != 265 AND del <> 1";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
			 	$dados[] = array("id_registro" => $row["id_registros"], "id_discord" => $row["id_discord_usuario"], "nome_usuario" => $row['nome_discord_usuario'], "id_usuario" => $row['id_usuario'], "data_inicio" => $row['dt_inicio'], "data_final" => $row['dt_final'], "del" => $row['del']);
			 }
			 $somaHorasPorUsuario = array();
			 // Processa os registros
			 foreach ($dados as $registro) {
				 $idUsuario = $registro['nome_usuario'];
				 $entrada = new DateTime($registro['data_inicio']);
				 $saida = new DateTime($registro['data_final']);
 
				 $diferenca = $saida->diff($entrada);
				 $intervaloEmSegundos = $diferenca->s + $diferenca->i * 60 + $diferenca->h * 3600;
 
				 if (!isset($somaHorasPorUsuario[$idUsuario])) {
					 $somaHorasPorUsuario[$idUsuario] = 0;
				 }
				 $somaHorasPorUsuario[$idUsuario] += $intervaloEmSegundos;
 }
				 // Exibe a soma das horas por usuário
				 foreach ($somaHorasPorUsuario as $idUsuario => $segundos) {
					 $horas = floor($segundos / 3600);
					 $minutos = floor(($segundos % 3600) / 60);
					 $segundos = $segundos % 60;
					 $horas_ = "$horas:$minutos:$segundos";
					 $dados_final[] = array("id" => $idUsuario,"horas" => $horas_);   
					 //echo "Usuário $idUsuario: $horas horas, $minutos minutos, $segundos segundos\n";
					 //echo "Usuario: $idUsuario: $horas_\n";
				 }
				 $matriz = array('resp'=>'ok','dados' => $dados_final);
				 echo json_encode($matriz);

		}  else if($_REQUEST['acao'] == 'relatorio_equipe_datas1'){
			header('Content-Type: application/json');
			$dt1 = data_en($_POST['data1']);
			$dt2 = data_en($_POST['data2']);
			$equipe = $_POST['equipe'];

			//$sql = "SELECT * FROM usuarios LEFT JOIN registros ON usuarios.id_usuario = registros.id_usuario WHERE equipe = '".$equipe[0]."' AND dt_inicio LIKE '%".$dt1."%' AND id_canal != 265";
			$sql = "SELECT * FROM usuarios LEFT JOIN registros ON usuarios.id_usuario = registros.id_usuario WHERE equipe = '".$equipe[0]."' AND dt_inicio >= '".$dt1." 00:00:01' AND dt_inicio <= '".$dt2." 23:59:59' AND id_canal != 568";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
			 	$dados[] = array("id_registro" => $row["id_registros"], "id_discord" => $row["id_discord_usuario"], "nome_usuario" => $row['nome_discord_usuario'], "id_usuario" => $row['id_usuario'], "data_inicio" => $row['dt_inicio'], "data_final" => $row['dt_final'], "del" => $row['del']);
			 }
			 // Inicialize a diferença total de horas e minutos


			 $somaDiferencasPorUsuario = [];

			 // Percorra os registros e calcule as diferenças e a soma total por usuário
			 foreach ($dados as $registro) {
				 $nome_discord = $registro['nome_usuario'];
				 $data_inicio = new DateTime($registro['data_inicio']);
				 $data_fim = new DateTime($registro['data_final']);
				 $interval = $data_inicio->diff($data_fim);
			 
				 if (!isset($somaDiferencasPorUsuario[$nome_discord])) {
					 $somaDiferencasPorUsuario[$nome_discord] = new DateInterval('PT0S');
				 }
			 
				 $somaDiferencasPorUsuario[$nome_discord]->h += $interval->h;
				 $somaDiferencasPorUsuario[$nome_discord]->i += $interval->i;

			 }
			 
			 // Exiba a soma total das diferenças de cada usuário
			 foreach ($somaDiferencasPorUsuario as $nome_discord => $diferencaTotal) {
				//echo "Usuário ID $usuario_id: " . $diferencaTotal->format('%H horas %i minutos') . PHP_EOL;
				$horas = $diferencaTotal->s + $diferencaTotal->i * 60 + $diferencaTotal->h * 3600;
				//echo "Usuário ID $usuario_id: " . gmdate("H:i:s", $horas) . PHP_EOL;
				$horas_ = gmdate("H:i:s", $horas);
				$dados_final[] = array("id" => $nome_discord,"horas" => $horas_);   

			 }
			$matriz = array('resp'=>'ok', 'dados' => $dados_final);
            echo json_encode($matriz);

		} else if($_REQUEST['acao'] == 'relatorio_ponto_datas'){
			header('Content-Type: application/json');
			$g = $_POST['guarnicao'];
			$busca_deletado = $_POST['registro_deletado'];
			if($_POST['data_inicio'] == null){
				$matriz = array('resp' => 'faltando_data_inicio');
				echo json_encode($matriz);
			} else if ($_POST['data_final'] == null){
				$matriz = array('resp' => 'faltando_data_final');
				echo json_encode($matriz);
			} else if($_POST['usuario'] == null){
				$matriz = array('resp' => 'faltando_usuario');
				echo json_encode($matriz);
			} else {
				$sql_check = "SELECT * FROM usuarios WHERE id_usuario = '".$_POST['usuario']."'";
				$dt_inicio = data_en($_POST['data_inicio']);
				$dt_final = data_en($_POST['data_final']);
				//echo $sql_check;
				$cmd_check = $con->prepare($sql_check);
				$cmd_check->execute();
				if(!$cmd_check->rowCount() > 0){
					$matriz = array('resp' => 'usuario_nao_encontrado');
					echo json_encode($matriz);
				} else {
					if($g[0] == 1){
						$guarnicao = 'NULO|P.M SUP|CMD P.M';
					} else if($g[0] == 2){
						$guarnicao = 'CMD G.T.M|G.T.M|CMD B.P.M|B.P.M';
					} else if($g[0] == 3){
						$guarnicao = 'CMD G.A.M|G.A.M';
					} else if($g[0] == 4){
						$guarnicao = 'PATAMO';
					} else if($g[0] == 5){
						$guarnicao = 'BPVe';
					} else if($g[0] == 6){
						$guarnicao = 'CMD B.O.P.E|B.O.P.E¹|B.O.P.E²|B.O.P.E³';
					} else if($g[0] == 7){
						$guarnicao = 'CMD BPChq|BPChq';
					} else if($g[0] == 8){
						$guarnicao = 'Em Cursos¹|Em Cursos²|Em Cursos';
					} else if($g[0] == 9){
						$guarnicao = 'Reunião';
						//$guarnicao = 'Reunião P.M|Reunião B.O.P.E|Reunião C.H.O.Q.U.E|Reunião geral|Reunião P.C|Reunião C.O.R.E';
					} else if($g[0] == 10){
						$guarnicao = 'Instrutores P.M|Instrutores B.O.P.E|Instrutores C.H.O.Q.U.E|Instrutores';
					} else if($g[0] == 11){
						$guarnicao = 'Comando Geral|Comando P.F|Comando P.M.E.R.J|Comando B.O.P.E|Comando C.H.O.Q.U.E|Comando P.C.E.R.J|Comando C.O.R.E|Comando P.R.F|Comando G.R.R|Comando N.O.E|Comando C.O.E|Aguardando Comando';
					} else if($g[0] == 12){
						$guarnicao = 'Aguardando PTR - PMERJ';
					} else if($g[0] == 14){
						$guarnicao = 'Incursões|Ronda Ostensiva';
					} else if($g[0] == 15){
						$guarnicao = 'CMD P.C.E.R.J|P.C.E.R.J¹|P.C.E.R.J²|P.C.E.R.J³|P.C.E.R.J⁴|P.C.E.R.J⁵|P.C.E.R.J⁶|P.C.E.R.J⁷|P.C.E.R.J⁸';
					} else if($g[0] == 16){
						$guarnicao = 'CMD S.A.E.R|S.A.E.R';
					} else if($g[0] == 17){
						$guarnicao = 'CMD G.E.T.E.M|G.E.T.E.M';
					} else if($g[0] == 18){
						$guarnicao = 'CMD C.O.R.E|C.O.R.E¹|C.O.R.E²|C.O.R.E³';
					} else if($g[0] == 19){
						$guarnicao = 'INVESTIGANDO';
					} else if($g[0] == 20){
						$guarnicao = 'Aguardando PTR - PCERJ';
					} else if($g[0] == 21){
						$guarnicao = 'C.O.E¹|C.O.E²|C.O.E³|CMD C.O.E';
					} else if($g[0] == 22){
						$guarnicao = 'G.T.M C.O.E';
					} else if($g[0] == 23){
						$guarnicao = 'G.A.M C.O.E';
					} else if($g[0] == 24){
						$guarnicao = 'C.O.E¹|C.O.E²|C.O.E³|G.A.M C.O.E|CMD C.O.E|G.A.M. C.O.E¹|GTM C.O.E';
					} else if($g[0] == 25){
						$guarnicao = 'CMD P.F|Supervisão P.F|P.F¹|P.F²|P.F³|P.F⁴|P.F⁵';
					} else if($g[0] == 26){
						$guarnicao = 'CMD C.O.T|C.O.T¹|C.O.T²';
					} else if($g[0] == 27){
						$guarnicao = 'G.A.P.E';
					} else if($g[0] == 28){
						$guarnicao = 'C.A.O.P¹|C.A.O.P²';
					} else if($g[0] == 29){
						$guarnicao = 'Comando P.F|Comando C.O.T';
					} else if($g[0] == 30){
						$guarnicao = 'Corregedoria P.F';
					} else if($g[0] == 31){
						$guarnicao = 'Em Cursos|Sala #1|Sala #2';
					} else if($g[0] == 32){
						$guarnicao = 'Instrutores C.O.T|Instrutores P.F';
					} else if($g[0] == 33){
						$guarnicao = 'Em Cursos';
					} else if($g[0] == 34){
						$guarnicao = 'Reunião C.O.T|Reunião P.F';
					} else if($g[0] == 35){
						$guarnicao = 'Comando C.O.E';
					} else if($g[0] == 36){
						$guarnicao = 'DEMON';
					} else if($g[0] == 37){
						$guarnicao = 'P.R.F¹|P.R.F²|P.R.F³|P.R.F⁴|P.R.F⁵|P.R.F⁶|P.R.F⁷|P.R.F⁸|P.R.F⁹|CMD P.R.F';
					} else if($g[0] == 38){
						$guarnicao = 'CMD SPEED|SPEED';
					} else if($g[0] == 39){
						$guarnicao = 'D.O.A';
					} else if($g[0] == 40){
						$guarnicao = 'CMD B.T.M|B.T.M';
					} else if($g[0] == 41){
						$guarnicao = 'CMD G.R.R|G.R.R¹|G.R.R²';
					} else if($g[0] == 42){
						$guarnicao = 'CMD N.O.E|N.O.E¹|N.O.E²';
					} else if($g[0] == 43){
						$guarnicao = 'INVESTIGANDO N.O.E';
					} else if($g[0] == 44){
						$guarnicao = 'Blitz';
					} else if($g[0] == 0){
						$guarnicao = '$';
					}

					unset($sql);
					if($busca_deletado == 0){			
						$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio >= '".$dt_inicio." 00:00:01' AND dt_final <= '".$dt_final." 23:59:00' AND u.id_usuario = '".$_POST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."' AND id_canal_discord != '1203823497621540984' AND id_canal_discord != '1180709468456095782' AND del <> 1 AND c.id_canal != 568"; // ORDER BY dt_inicio ASC";
					} else {
						$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio >= '".$dt_inicio." 00:00:01' AND dt_final <= '".$dt_final." 23:59:00' AND u.id_usuario = '".$_POST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."' AND id_canal_discord != '1203823497621540984' AND id_canal_discord != '1180709468456095782' AND c.id_canal != 568"; // ORDER BY dt_inicio ASC";
					}

					
					// unset($sql);
					// if($busca_deletado == 0){			
					// 	$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio >= '".$dt_inicio." 00:00:01' AND dt_final <= '".$dt_final." 23:59:00' AND u.id_usuario = '".$_POST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."' AND id_canal_discord != '1203823497621540984' AND id_canal_discord != '1180709468456095782' AND del <> 1 AND c.id_canal != 568"; // ORDER BY dt_inicio ASC";
					// } else {
					// 	$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio >= '".$dt_inicio." 00:00:01' AND dt_final <= '".$dt_final." 23:59:00' AND u.id_usuario = '".$_POST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."' AND id_canal_discord != '1203823497621540984' AND id_canal_discord != '1180709468456095782' AND c.id_canal != 568"; // ORDER BY dt_inicio ASC";
					// }
					
					//$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio >= '".$dt_inicio." 00:00:01' AND dt_final <= '".$dt_final." 23:59:00' AND u.id_usuario = '".$_POST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."'";
					$cmd = $con->prepare($sql);
					$cmd->execute();
					$dados = [];
					//echo $sql;
					while ($row = $cmd->fetch(PDO::FETCH_BOTH)){
						$dados[] = array("id_registro" => $row["id_registros"], "dt_inicio" => data_br($row["dt_inicio"]), "dt_final" => data_br($row["dt_final"]), "nome_canal" => $row["nome_canal_discord"], "nome_usuario" => $row["nome_discord_usuario"], "del" => $row["del"]);
					}
					if($dados == null){
						$matriz = array('resp' => 'ok', 'dados' => $dados,'sql' => $sql);
						echo json_encode($matriz);
					} else {
					$matriz = array('resp'=>'ok','dados' => $dados,'sql' => $sql);
					echo json_encode($matriz);
					}

				}

			}

		} else if($_REQUEST['acao'] == 'relatorio_equipe'){ 
			header('Content-Type: application/json');
			$equipe = $_REQUEST['equipe'];
			$dt_inicio = data_en($_REQUEST['data_inicio']);
			$dt_final = data_en($_REQUEST['data_final']);

			if($equipe == 0){
				$e = 'pmerj_alpha';
			} else if($equipe == 1){
				$e = 'pmerj_bravo';
			} else if($equipe == 2){
				$e = 'pmerj_charlie';
			} else if($equipe == 3){
				$e = 'pmerj_echo';
			} else if($equipe == 4){
				$e = 'pmerj_delta';
			} else if($equipe == 5){
				$e = 'pmerj_foxtrot';
			} else if($equipe == 6){
				$e = 'pmerj_golf';
			} else if($equipe == 7){
				$e = 'pmerj_hotel';
			}
			$sql = "SELECT * FROM registros r CROSS JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio >= '".$dt_inicio." 00:00:01' AND dt_final <= '".$dt_final." 23:59:59' AND u.equipe = '".$e."'";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];

			while ($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$id_discord = $row['id_discord_usuario'];
				$nome_discord = $row['nome_discord_usuario'];
				$dt_inicio = data_br($row["dt_inicio"]);
				$dt_final = data_br($row["dt_final"]);

				echo "\nID Discord -> $id_discord Nome Discord -> $nome_discord | Data Ininio -> $dt_inicio : Data Final -> $dt_final";
				
				
			}
			// URL Manual para teste
			// https://policia.complexorj.com.br/php/banco.php?tab=bateponto&acao=relatorio_equipe&data_inicio=2023/10/01&data_final=2023/10/30&equipe=0
			// https://policia.complexorj.com.br/php/banco.php?tab=bateponto&acao=relatorio_equipe&data_inicio=09/01/2023&data_final=11/01/2023&equipe=3
			// Senha Stain 42a6b5fbbc11393f1c046492e2d55309 Usuario Stain
			echo "Equipe -> $equipe - $e\nData Inicio-> $dt_inicio\nData Final -> $dt_final\nSQL -> $sql";



 		} else if($_REQUEST['acao'] == 'relatorio_ponto_mes'){
			header('Content-Type: application/json');
			$g = $_POST['guarnicao'];
			$busca_deletado = $_POST['registro_deletado'];
			if ($_POST['mes'] == null){
				$matriz = array('resp' => 'faltando_data_final');
				echo json_encode($matriz);
			} else if($_POST['usuario'] == null){
				$matriz = array('resp' => 'faltando_usuario');
				echo json_encode($matriz);
			} else {
				$sql_check = "SELECT * FROM usuarios WHERE id_usuario = '".$_POST['usuario']."'";
				$dt_inicio = data_en($_POST['data_inicio']);
				$dt_final = data_en($_POST['data_final']);
				//echo $sql_check;
				$cmd_check = $con->prepare($sql_check);
				$cmd_check->execute();
				if(!$cmd_check->rowCount() > 0){
					$matriz = array('resp' => 'usuario_nao_encontrado');
					echo json_encode($matriz);
				} else {
					if($g[0] == 1){
						$guarnicao = 'NULO|P.M SUP|CMD P.M'; 
					} else if($g[0] == 2){
						$guarnicao = 'CMD G.T.M|G.T.M|CMD B.P.M|B.P.M';
					} else if($g[0] == 3){
						$guarnicao = 'CMD G.A.M|G.A.M';
					} else if($g[0] == 4){
						$guarnicao = 'PATAMO';
					} else if($g[0] == 5){
						$guarnicao = 'BPVe';
					} else if($g[0] == 6){
						$guarnicao = 'CMD B.O.P.E|B.O.P.E¹|B.O.P.E²|B.O.P.E³';
					} else if($g[0] == 7){
						$guarnicao = 'CMD BPChq|BPChq';
					} else if($g[0] == 8){
						$guarnicao = 'Em Cursos¹|Em Cursos²|Em Cursos';
					} else if($g[0] == 9){
						$guarnicao = 'Reunião';
						//$guarnicao = 'Reunião P.M|Reunião B.O.P.E|Reunião C.H.O.Q.U.E|Reunião geral|Reunião P.C|Reunião C.O.R.E';
					} else if($g[0] == 10){
						$guarnicao = 'Instrutores P.M|Instrutores B.O.P.E|Instrutores C.H.O.Q.U.E|Instrutores';
					} else if($g[0] == 11){
						$guarnicao = 'Comando Geral|Comando P.F|Comando P.M.E.R.J|Comando B.O.P.E|Comando C.H.O.Q.U.E|Comando P.C.E.R.J|Comando C.O.R.E|Comando P.R.F|Comando G.R.R|Comando N.O.E|Comando C.O.E|Aguardando Comando';
					} else if($g[0] == 12){
						$guarnicao = 'Aguardando PTR - PMERJ';
					} else if($g[0] == 14){
						$guarnicao = 'Incursões|Ronda Ostensiva';
					} else if($g[0] == 15){
						$guarnicao = 'CMD P.C.E.R.J|P.C.E.R.J¹|P.C.E.R.J²|P.C.E.R.J³|P.C.E.R.J⁴|P.C.E.R.J⁵|P.C.E.R.J⁶|P.C.E.R.J⁷|P.C.E.R.J⁸';
					} else if($g[0] == 16){
						$guarnicao = 'CMD S.A.E.R|S.A.E.R';
					} else if($g[0] == 17){
						$guarnicao = 'CMD G.E.T.E.M|G.E.T.E.M';
					} else if($g[0] == 18){
						$guarnicao = 'CMD C.O.R.E|C.O.R.E¹|C.O.R.E²|C.O.R.E³';
					} else if($g[0] == 19){
						$guarnicao = 'INVESTIGANDO';
					} else if($g[0] == 20){
						$guarnicao = 'Aguardando PTR - PCERJ';
					} else if($g[0] == 21){
						$guarnicao = 'C.O.E¹|C.O.E²|C.O.E³|CMD C.O.E';
					} else if($g[0] == 22){
						$guarnicao = 'G.T.M C.O.E';
					} else if($g[0] == 23){
						$guarnicao = 'G.A.M C.O.E';
					} else if($g[0] == 24){
						$guarnicao = 'C.O.E¹|C.O.E²|C.O.E³|G.A.M C.O.E|CMD C.O.E|G.A.M. C.O.E¹|GTM C.O.E';
					} else if($g[0] == 25){
						$guarnicao = 'CMD P.F|Supervisão P.F|P.F¹|P.F²|P.F³|P.F⁴|P.F⁵';
					} else if($g[0] == 26){
						$guarnicao = 'CMD C.O.T|C.O.T¹|C.O.T²';
					} else if($g[0] == 27){
						$guarnicao = 'G.A.P.E';
					} else if($g[0] == 28){
						$guarnicao = 'C.A.O.P¹|C.A.O.P²';
					} else if($g[0] == 29){
						$guarnicao = 'Comando P.F|Comando C.O.T';
					} else if($g[0] == 30){
						$guarnicao = 'Corregedoria P.F';
					} else if($g[0] == 31){
						$guarnicao = 'Em Cursos|Sala #1|Sala #2';
					} else if($g[0] == 32){
						$guarnicao = 'Instrutores C.O.T|Instrutores P.F';
					} else if($g[0] == 33){
						$guarnicao = 'Em Cursos';
					} else if($g[0] == 34){
						$guarnicao = 'Reunião C.O.T|Reunião P.F';
					} else if($g[0] == 35){
						$guarnicao = 'Comando C.O.E';
					} else if($g[0] == 36){
						$guarnicao = 'DEMON';
					} else if($g[0] == 37){
						$guarnicao = 'P.R.F¹|P.R.F²|P.R.F³|P.R.F⁴|P.R.F⁵|P.R.F⁶|P.R.F⁷|P.R.F⁸|P.R.F⁹|CMD P.R.F';
					} else if($g[0] == 38){
						$guarnicao = 'CMD SPEED|SPEED';
					} else if($g[0] == 39){
						$guarnicao = 'D.O.A';
					} else if($g[0] == 40){
						$guarnicao = 'CMD B.T.M|B.T.M';
					} else if($g[0] == 41){
						$guarnicao = 'CMD G.R.R|G.R.R¹|G.R.R²';
					} else if($g[0] == 42){
						$guarnicao = 'CMD N.O.E|N.O.E¹|N.O.E²';
					} else if($g[0] == 43){
						$guarnicao = 'INVESTIGANDO N.O.E';
					} else if($g[0] == 44){
						$guarnicao = 'Blitz';
					} else if($g[0] == 45){
						$guarnicao = 'Incursões|Ronda Ostensiva|Aguardando PTR - PMERJ|Comando Geral|Comando P.F|Comando P.M.E.R.J|Comando B.O.P.E|Comando C.H.O.Q.U.E|Comando P.C.E.R.J|Comando C.O.R.E|Comando P.R.F|Comando G.R.R|Comando N.O.E|Comando C.O.E|Aguardando Comando|Instrutores P.M|Instrutores B.O.P.E|Instrutores C.H.O.Q.U.E|Instrutores|NULO|P.M SUP|CMD P.M|CMD G.T.M|G.T.M|CMD B.P.M|B.P.M|CMD G.A.M|G.A.M|PATAMO|CMD B.O.P.E|B.O.P.E¹|B.O.P.E²|B.O.P.E³|CMD BPChq|BPChq|Em Cursos¹|Em Cursos²|Em Cursos';
					} else if($g[0] == 0){
						$guarnicao = '$';
					}
					unset($sql);
					if($busca_deletado == 0){	
						$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio LIKE '%".$_REQUEST['mes']."%' AND dt_final LIKE '%".$_REQUEST['mes']."%' AND u.id_usuario = '".$_REQUEST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."' AND id_canal_discord != '1203823497621540984' AND id_canal_discord != '1180709468456095782' AND del <> 1";
					} else {
						$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio LIKE '%".$_REQUEST['mes']."%' AND dt_final LIKE '%".$_REQUEST['mes']."%' AND u.id_usuario = '".$_REQUEST['usuario']."' AND nome_canal_discord REGEXP '".$guarnicao."' AND id_canal_discord != '1203823497621540984' AND id_canal_discord != '1180709468456095782'";
					}
					$cmd = $con->prepare($sql);
					$cmd->execute();
					$dados = [];
					//echo $sql;
					while ($row = $cmd->fetch(PDO::FETCH_BOTH)){
						$dados[] = array("id_registro" => $row["id_registros"], "dt_inicio" => data_br($row["dt_inicio"]), "dt_final" => data_br($row["dt_final"]), "nome_canal" => $row["nome_canal_discord"], "nome_usuario" => $row["nome_discord_usuario"], "del" => $row["del"]);
					}
					if($dados == null){
						$matriz = array('resp' => 'ok', 'dados' => $dados);
						echo json_encode($matriz);
					} else {
					$matriz = array('resp'=>'ok','dados' => $dados);
					echo json_encode($matriz);
					}

				}

			}

		} else if($_REQUEST['acao'] == 'relatorio_inatividade'){
			header('Content-Type: application/json');
			$g = $_POST['guarnicao'];
			if($g[0] == 1){
				$guarnicao = 'NULO|P.M SUP|CMD P.M';
			} else if($g[0] == 2){
				$guarnicao = 'CMD G.T.M|G.T.M|CMD B.P.M|B.P.M';
			} else if($g[0] == 3){
				$guarnicao = 'CMD G.A.M|G.A.M';
			} else if($g[0] == 4){
				$guarnicao = 'PATAMO';
			} else if($g[0] == 5){
				$guarnicao = 'BPVe';
			} else if($g[0] == 6){
				$guarnicao = 'CMD B.O.P.E|B.O.P.E¹|B.O.P.E²|B.O.P.E³';
			} else if($g[0] == 7){
				$guarnicao = 'CMD BPChq|BPChq';
			} else if($g[0] == 8){
				$guarnicao = 'Em Cursos¹|Em Cursos²';
			} else if($g[0] == 9){
				$guarnicao = 'Reunião P.M|Reunião B.O.P.E|Reunião C.H.O.Q.U.E|Reunião geral';
			} else if($g[0] == 10){
				$guarnicao = 'Instrutores P.M|Instrutores B.O.P.E|Instrutores C.H.O.Q.U.E';
			} else if($g[0] == 11){
				$guarnicao = 'Comando Geral|Comando P.F|Comando P.M.E.R.J|Comando B.O.P.E|Comando C.H.O.Q.U.E|Comando P.C.E.R.J|Comando C.O.R.E|Comando P.R.F|Comando G.R.R|Comando N.O.E|Comando C.O.E|Aguardando Comando';
			} else if($g[0] == 12){
				$guarnicao = 'Comando Geral|Comando P.F|Comando P.M.E.R.J|Comando B.O.P.E|Comando C.H.O.Q.U.E|Comando P.C.E.R.J|Comando C.O.R.E|Comando P.R.F|Comando G.R.R|Comando N.O.E|Comando C.O.E|Aguardando Comando';
			}  else if($g[0] == 0){
				$guarnicao = '$';
			}
			$dt =  date("Y-m-d",strtotime(date("Y-m-d")."-5 days"));
			$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE dt_inicio LIKE '%".$dt."%' AND nome_canal_discord REGEXP '".$guarnicao."'";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("id_registro" => $row["id_registros"], "dt_inicio" => data_br($row["dt_inicio"]), "dt_final" => data_br($row["dt_final"]), "nome_canal" => $row["nome_canal_discord"], "nome_usuario" => $row["nome_discord_usuario"], "licenca" => $row["op6"], "id_usuario" => $row['id_usuario']);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);
		} else if($_REQUEST['acao'] == 'ponto_aberto_pmerj'){
			header('Content-Type: application/json');
			$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE guarnicao = '- P.M.E.R.J' AND dt_final IS NULL AND c.id_canal != 644";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("nome_usuario" => $row['nome_discord_usuario'], "equipe" => $row['equipe'], "cmd_pmerj" => $row['op2'], "cmd_cia" => $row['op3'], "forca_especial" => $row['op4'], "instrutor_equipe" => $row['op5'], "nome_canal" => $row['nome_canal_discord']);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);
	} else if($_REQUEST['acao'] == 'del_registro_ponto'){
		header('Content-Type: application/json');
		$id_registro = $_POST['id_registro'];
		//$nome_autor = $_SESSION['dados_usuario']['nome_usuario'];

		$sql = "UPDATE registros SET del = 1 WHERE id_registros = '$id_registro'";
		$cmd = $con->prepare($sql);
		if($cmd->execute()){
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);
		} else {
			$matriz = array('resp'=>'erro','dados' => $dados);
			echo json_encode($matriz);
		}
		

	} else if($_REQUEST['acao'] == 'envia_notificacao'){
		session_start();
		header('Content-Type: application/json');
		$nome_usuario = $_REQUEST['nome_usuario'];
		$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario WHERE u.nome_discord_usuario LIKE '%".$nome_usuario."%'";
		$cmd = $con->prepare($sql);
		$cmd->execute();
		$row = $cmd->fetch();
		$id_usuario = $row['id_usuario'];
		$dt_registro = $row['dt_final'];
		//echo "SQL -> $sql | ID Usuario -> $id_usuario";
		$sql_vernotificacoes = "SELECT * FROM notificacoes WHERE id_usuario = '$id_usuario' AND status IS NULL";
		$cmd_notificacoes = $con->prepare($sql_vernotificacoes);
		$cmd_notificacoes->execute();
		if($cmd_notificacoes->rowCount() > 0){
			echo json_encode('enviando');
			exit;
		} else {
		$nome_autor = $_SESSION['dados_usuario']['nome_usuario'];
		$id_autor = $_SESSION['dados_usuario']['id_discord'];


$mensagem = '
*Olá*

*Notamos que você esta ausente na Policia da Cidade COMPLEXORJ, Gostaríamos de saber um pouco mais sobre sua ausência, Caso estiver com algum problema fora do Game preciso que Solicite uma Licença*
*Link Solicitação Licença https://discord.com/channels/909536444849221642/1075207780836843520.*
*Pode estar entrando em contato no meu PV também.*

***Att*** *'.$nome_autor.'*
*Duvidas entre em contato Aqui* <@'.$id_autor.'>

:red_circle:**MENSAGEM ENVIADA AUTOMATICAMENTE, FAVOR NÃO RESPONDER NESTE CHAT**:red_circle:

	';
		
		// $mensagem = "*Olá*";
		// $mensagem += "*Notamos que você esta ausente na Policia da Cidade COMPLEXORJ, Gostaríamos de saber um pouco mais sobre sua ausência, Caso estiver com algum problema fora do Game preciso que Solicite uma Licença aqui https://discord.com/channels/909536444849221642/1075207780836843520. Pode estar entrando em contato no meu PV também*";
		// $mensagem += "***Ultimo Registro:*** *$id_usuario*";
		// $mensagem += "***Att*** *$nome_autor*";
		// $mensagem += "*Duvidas entre em contato aqui -> <@$id_autor>*";
		// $mensagem += ":red_circle:**MENSAGEM ENVIADA AUTOMATICAMENTE, FAVOR NÃO RESPONDER NESTE CHAT**:red_circle:";

		$sql_insert = "INSERT INTO notificacoes (id_usuario, mensagem) VALUES (:id_usuario, :mensagem)";
		$cmd_insert = $con->prepare($sql_insert);
		$cmd_insert->bindValue(':id_usuario', $id_usuario);
		$cmd_insert->bindValue(':mensagem', $mensagem);
 
		if($cmd_insert->execute()){
			echo json_encode('ok');
		} else {
			echo json_encode('erro');
			echo "Usuario -> ";
			echo $id_registro;
		}
	}

	} else if($_REQUEST['acao'] == 'ponto_aberto_pcerj'){
		header('Content-Type: application/json');
		$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE guarnicao = '- P.C.E.R.J' AND dt_final IS NULL AND c.id_canal != 644";
		$cmd = $con->prepare($sql);
		$cmd->execute();
		$dados = [];
		while($row = $cmd->fetch(PDO::FETCH_BOTH)){
			$dados[] = array("nome_usuario" => $row['nome_discord_usuario'], "nome_canal" => $row['nome_canal_discord']);
		}
		$matriz = array('resp'=>'ok','dados' => $dados);
		echo json_encode($matriz);
} else if($_REQUEST['acao'] == 'ponto_aberto_pf'){
	header('Content-Type: application/json');
	$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE guarnicao = '- Polícia Federal' AND dt_final IS NULL AND c.id_canal != 644";
	$cmd = $con->prepare($sql);
	$cmd->execute();
	$dados = [];
	while($row = $cmd->fetch(PDO::FETCH_BOTH)){
		$dados[] = array("nome_usuario" => $row['nome_discord_usuario'], "nome_canal" => $row['nome_canal_discord']);
	}
	$matriz = array('resp'=>'ok','dados' => $dados);
	echo json_encode($matriz);
} else if($_REQUEST['acao'] == 'ponto_aberto_prf'){
	header('Content-Type: application/json');
	$sql = "SELECT * FROM registros r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario INNER JOIN canais c ON c.id_canal = r.id_canal WHERE guarnicao = '- P.R.F' AND dt_final IS NULL AND c.id_canal != 644";
	$cmd = $con->prepare($sql);
	$cmd->execute();
	$dados = [];
	while($row = $cmd->fetch(PDO::FETCH_BOTH)){
		$dados[] = array("nome_usuario" => $row['nome_discord_usuario'], "nome_canal" => $row['nome_canal_discord']);
	}
	$matriz = array('resp'=>'ok','dados' => $dados);
	echo json_encode($matriz);
}

    } else if($_REQUEST['tab'] == 'bombeiros'){
        if($_REQUEST['acao'] == 'exibe_logs'){
            header('Content-Type: application/json');
            $sql = "SELECT * FROM logs_bombeiro ORDER BY id_bombeiro_logs DESC";
            $cmd = $con->prepare($sql);
            $cmd->execute();
            $dados = array();
            while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("logs_id" => $row["id_bombeiro_logs"], "dt_logs" => $row["dt_logs"], "dados_logs" => $row["dados_logs"], "usuario_discord" => $row["usuario_discord"]);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);
        } else if($_REQUEST['acao'] == 'exibe_reanimacoes'){
			header('Content-Type: application/json');
			$sql = "SELECT * FROM reanimacoes r JOIN usuarios u ON r.id_usuario = u.id_usuario";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = array();
			while ($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados [] = array("usuario" => $row["nome_discord_usuario"], "dt" => $row["dt_reanimacoes"], "local" => $row["local"]);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);
		} else if($_REQUEST['acao'] == 'exibe_usuarios'){
			header('Content-Type: application/json');
			$sql = "SELECT * FROM usuarios WHERE bombeiro = 1";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("id_usuario" => $row["id_usuario"], "nome_usuario" => $row["nome_discord_usuario"]);
			}
			$matriz = array('resp'=>'ok','dados' => $dados);
			echo json_encode($matriz);


		}
    } else if($_REQUEST['tab'] == 'discord') {
		if($_REQUEST['acao'] == 'relatorio_cargos'){
			header('Content-Type: application/json');
			$discord = $_POST['discord'];
			$sql = "SELECT * FROM logs_alteracao_cargo WHERE discord = '".$discord[0]."'";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$usuario_autor = $row['usuario_autor'];
				$usuario_alterado = $row['usuario_alterado'];
				$id_registro = $row['id_alteracao_cargo'];
				$acao = $row['acao'];
				$dt = $row['dataehora'];
				$discord = $row['discord'];
				$cargo_alterado = $row['cargo_nome'];
				$id_cargo_discord = $row['cargo'];
				$sql_usuario_autor = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$usuario_autor."'";
				$cmd_usuario_autor = $con->prepare($sql_usuario_autor);
				$cmd_usuario_autor->execute();
				$resultado_autor = $cmd_usuario_autor->fetch();
				$autor = $resultado_autor["nome_discord_usuario"];
		  
				$sql_usuario_alterado = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$usuario_alterado."'";
				$cmd_usuario_alterado = $con->prepare($sql_usuario_alterado);
				$cmd_usuario_alterado->execute();
				$resultado_alterado = $cmd_usuario_alterado->fetch();
				$alterado = $resultado_alterado["nome_discord_usuario"];
				
				$sql_cargo = "SELECT * FROM cargos_".$discord." WHERE id_cargo_discord = '".$id_cargo_discord."'";
				$cmd_cargo = $con->prepare($sql_cargo);
				$cmd_cargo->execute();
				$resultado_cargo = $cmd_cargo->fetch();
				$cargo = $resultado_cargo["nome_cargo_discord"];
				//echo "ID -> $id_registro</br>Usuario Autor -> $autor</br>Usuario Alterado -> $alterado</br>Acao -> $acao</br>Data e Hora -> $dt</br>Cargo Alterado -> $cargo_alterado</br>Discord -> $discord</br>----------------------------------";

				$dados[] = array("id" => $id_registro, "autor" => $autor, "alterado" => $alterado, "acao" => $acao, "dt" => data_br($dt), "cargo" => $cargo);
			 }
			 $matriz = array('resp'=>'ok','dados' => $dados, 'guarnicao' => $guarnica);
			 echo json_encode($matriz);

			
		}

	} else if($_REQUEST['tab'] == 'prisoes'){
		if ($_REQUEST['acao'] == 'relatorio_prisoes_divisao'){
			header('Content-Type: application/json');
			$dt_inicio = data_en($_POST['data_inicio']);
			$dt_final = data_en($_POST['data_final']);
			$guarnicao = $_POST['guarnicao'];

			$sql = "SELECT * FROM ";


		} else if($_REQUEST['acao'] == 'relatorio_prisoes'){
			header('Content-Type: application/json');
			$dt_inicio = data_en($_POST['data_inicio']);
			$dt_final = data_en($_POST['data_final']);
			$cl = $_POST['cl'];
			$usuario = $_POST['passaporte'];
			$sql_usuario = "SELECT * FROM usuarios WHERE id_usuario = '".$usuario."'";
			$cmd_usuario = $con->prepare($sql_usuario);
			$cmd_usuario->execute();
			$resultado_usuario = $cmd_usuario->fetch();
			$id_discord = $resultado_usuario["id_discord_usuario"];

			// 
			if($cl[0] == 0){
				$sql = "SELECT * FROM prisao WHERE dt_prisao >= '".$dt_inicio." 00:00:01' AND dt_prisao <= '".$dt_final." 23:59:59' AND (primeiro_oficial = '".$id_discord."' OR segundo_oficial = '".$id_discord."' OR terceiro_oficial = '".$id_discord."' OR quarto_oficial = '".$id_discord."' OR quinto_oficial = '".$id_discord."' OR sexto_oficial = '".$id_discord."' OR setimo_oficial = '".$id_discord."' OR oitavo_oficial = '".$id_discord."')";
			} else {
				$sql = "SELECT * FROM prisao WHERE artigos_prisao LIKE '%CL - Combat%' AND dt_prisao >= '".$dt_inicio." 00:00:01' AND dt_prisao <= '".$dt_final." 23:59:59' AND (primeiro_oficial = '".$id_discord."' OR segundo_oficial = '".$id_discord."' OR terceiro_oficial = '".$id_discord."' OR quarto_oficial = '".$id_discord."' OR quinto_oficial = '".$id_discord."' OR sexto_oficial = '".$id_discord."' OR setimo_oficial = '".$id_discord."' OR oitavo_oficial = '".$id_discord."')";
			}
			
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				if($row['primeiro_oficial']){
					$sql_busca_usuario1 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['primeiro_oficial']."'";
					$cmd_busca_usuario1 = $con->prepare($sql_busca_usuario1);
					$cmd_busca_usuario1->execute();
					$resultado_busca_usuario1 = $cmd_busca_usuario1->fetch();
					$nome_usuario1 = $resultado_busca_usuario1["nome_discord_usuario"];
				}
	
				if($row['segundo_oficial']){
					$sql_busca_usuario2 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['segundo_oficial']."'";
					$cmd_busca_usuario2 = $con->prepare($sql_busca_usuario2);
					$cmd_busca_usuario2->execute();
					$resultado_busca_usuario2 = $cmd_busca_usuario2->fetch();
					$nome_usuario2 = $resultado_busca_usuario2["nome_discord_usuario"];
				}

				if($row['terceiro_oficial']){
					$sql_busca_usuario3 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['terceiro_oficial']."'";
					$cmd_busca_usuario3 = $con->prepare($sql_busca_usuario3);
					$cmd_busca_usuario3->execute();
					$resultado_busca_usuario3 = $cmd_busca_usuario3->fetch();
					$nome_usuario3 = $resultado_busca_usuario3["nome_discord_usuario"];
				}

				if($row['quarto_oficial']){
					$sql_busca_usuario4 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['quarto_oficial']."'";
					$cmd_busca_usuario4 = $con->prepare($sql_busca_usuario4);
					$cmd_busca_usuario4->execute();
					$resultado_busca_usuario4 = $cmd_busca_usuario4->fetch();
					$nome_usuario4 = $resultado_busca_usuario4["nome_discord_usuario"];
				}

				if($row['quinto_oficial']){
					$sql_busca_usuario5 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['quinto_oficial']."'";
					$cmd_busca_usuario5 = $con->prepare($sql_busca_usuario5);
					$cmd_busca_usuario5->execute();
					$resultado_busca_usuario5 = $cmd_busca_usuario5->fetch();
					$nome_usuario5 = $resultado_busca_usuario5["nome_discord_usuario"];
				}

				if($row['sexto_oficial']){
					$sql_busca_usuario6 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['sexto_oficial']."'";
					$cmd_busca_usuario6 = $con->prepare($sql_busca_usuario6);
					$cmd_busca_usuario6->execute();
					$resultado_busca_usuario6 = $cmd_busca_usuario6->fetch();
					$nome_usuario6 = $resultado_busca_usuario6["nome_discord_usuario"];
				}

				if($row['setimo_oficial']){
					$sql_busca_usuario7 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['setimo_oficial']."'";
					$cmd_busca_usuario7 = $con->prepare($sql_busca_usuario7);
					$cmd_busca_usuario7->execute();
					$resultado_busca_usuario7 = $cmd_busca_usuario7->fetch();
					$nome_usuario7 = $resultado_busca_usuario7["nome_discord_usuario"];
				}

				if($row['oitavo_oficial']){
					$sql_busca_usuario8 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['oitavo_oficial']."'";
					$cmd_busca_usuario8 = $con->prepare($sql_busca_usuario8);
					$cmd_busca_usuario8->execute();
					$resultado_busca_usuario8 = $cmd_busca_usuario8->fetch();
					$nome_usuario8 = $resultado_busca_usuario8["nome_discord_usuario"];
				}

				$dados[] = array("id_registro" => $row['id_prisao'], "primeiro" => $nome_usuario1, "segundo" => $nome_usuario2, "terceiro" => $nome_usuario3, "quarto" => $nome_usuario4, "quinto" => $nome_usuario5, "sexto" => $nome_usuario6, "setimo" => $nome_usuario7, "oitavo" => $nome_usuario8, "passaporte_detento" => $row['id_detento'], "nome_detento" => $row['nome_detento'], "artigos" => $row['artigos_prisao'], "pena" => $row['pena_prisao'], "multa" => $row['multa_prisao'], "fianca" => $row['fianca_prisao'], "qsj" => $row['qsj'], "reu_primario" => $row['reu_primario'], "reu_confesso" => $row['reu_confesso'], "adv_constituido" => $row['adv_constituido'], "obs" => $row['obs'], "dt" => data_br($row['dt_prisao']));
				//$dados[] = array("primeiro" => $nome_usuario1);
			}
			$matriz = array('resp'=>'ok','dados' => $dados, "sql" => $sql, "CL" => $cl);
			echo json_encode($matriz);
		} else if($_REQUEST['acao'] == 'relatorio_prisoes_detento'){
			header('Content-Type: application/json');
			$dt_inicio = data_en($_POST['data_inicio']);
			$dt_final = data_en($_POST['data_final']);
			$detento  = $_POST['detento'];
			$sql = "SELECT * FROM prisao WHERE dt_prisao >= '".$dt_inicio." 00:00:01' AND dt_prisao <= '".$dt_final." 23:59:59' AND (nome_detento LIKE '%".$detento."%' OR id_detento LIKE '%".$detento."%')";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				if($row['primeiro_oficial']){
					$sql_busca_usuario1 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['primeiro_oficial']."'";
					$cmd_busca_usuario1 = $con->prepare($sql_busca_usuario1);
					$cmd_busca_usuario1->execute();
					$resultado_busca_usuario1 = $cmd_busca_usuario1->fetch();
					$nome_usuario1 = $resultado_busca_usuario1["nome_discord_usuario"];
				}
	
				if($row['segundo_oficial']){
					$sql_busca_usuario2 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['segundo_oficial']."'";
					$cmd_busca_usuario2 = $con->prepare($sql_busca_usuario2);
					$cmd_busca_usuario2->execute();
					$resultado_busca_usuario2 = $cmd_busca_usuario2->fetch();
					$nome_usuario2 = $resultado_busca_usuario2["nome_discord_usuario"];
				}

				if($row['terceiro_oficial']){
					$sql_busca_usuario3 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['terceiro_oficial']."'";
					$cmd_busca_usuario3 = $con->prepare($sql_busca_usuario3);
					$cmd_busca_usuario3->execute();
					$resultado_busca_usuario3 = $cmd_busca_usuario3->fetch();
					$nome_usuario3 = $resultado_busca_usuario3["nome_discord_usuario"];
				}

				if($row['quarto_oficial']){
					$sql_busca_usuario4 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['quarto_oficial']."'";
					$cmd_busca_usuario4 = $con->prepare($sql_busca_usuario4);
					$cmd_busca_usuario4->execute();
					$resultado_busca_usuario4 = $cmd_busca_usuario4->fetch();
					$nome_usuario4 = $resultado_busca_usuario4["nome_discord_usuario"];
				}

				if($row['quinto_oficial']){
					$sql_busca_usuario5 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['quinto_oficial']."'";
					$cmd_busca_usuario5 = $con->prepare($sql_busca_usuario5);
					$cmd_busca_usuario5->execute();
					$resultado_busca_usuario5 = $cmd_busca_usuario5->fetch();
					$nome_usuario5 = $resultado_busca_usuario5["nome_discord_usuario"];
				}

				if($row['sexto_oficial']){
					$sql_busca_usuario6 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['sexto_oficial']."'";
					$cmd_busca_usuario6 = $con->prepare($sql_busca_usuario6);
					$cmd_busca_usuario6->execute();
					$resultado_busca_usuario6 = $cmd_busca_usuario6->fetch();
					$nome_usuario6 = $resultado_busca_usuario6["nome_discord_usuario"];
				}

				if($row['setimo_oficial']){
					$sql_busca_usuario7 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['setimo_oficial']."'";
					$cmd_busca_usuario7 = $con->prepare($sql_busca_usuario7);
					$cmd_busca_usuario7->execute();
					$resultado_busca_usuario7 = $cmd_busca_usuario7->fetch();
					$nome_usuario7 = $resultado_busca_usuario7["nome_discord_usuario"];
				}

				if($row['oitavo_oficial']){
					$sql_busca_usuario8 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['oitavo_oficial']."'";
					$cmd_busca_usuario8 = $con->prepare($sql_busca_usuario8);
					$cmd_busca_usuario8->execute();
					$resultado_busca_usuario8 = $cmd_busca_usuario8->fetch();
					$nome_usuario8 = $resultado_busca_usuario8["nome_discord_usuario"];
				}

				$dados[] = array("id_registro" => $row['id_prisao'], "primeiro" => $nome_usuario1, "segundo" => $nome_usuario2, "terceiro" => $nome_usuario3, "quarto" => $nome_usuario4, "quinto" => $nome_usuario5, "sexto" => $nome_usuario6, "setimo" => $nome_usuario7, "oitavo" => $nome_usuario8, "passaporte_detento" => $row['id_detento'], "nome_detento" => $row['nome_detento'], "artigos" => $row['artigos_prisao'], "pena" => $row['pena_prisao'], "multa" => $row['multa_prisao'], "fianca" => $row['fianca_prisao'], "qsj" => $row['qsj'], "reu_primario" => $row['reu_primario'], "reu_confesso" => $row['reu_confesso'], "adv_constituido" => $row['adv_constituido'], "obs" => $row['obs'], "dt" => data_br($row['dt_prisao']));
				//$dados[] = array("primeiro" => $nome_usuario1);
			}
			$matriz = array('resp'=>'ok','dados' => $dados, "sql" => $sql);
			echo json_encode($matriz);
		} else if($_REQUEST['acao'] == 'exibe_detalhes'){
			header('Content-Type: application/json');
			$id_prisao = $_REQUEST['id_prisao'];
			$sql = "SELECT * FROM prisao WHERE id_prisao = '".$id_prisao."'";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				if($row['primeiro_oficial']){
					$sql_busca_usuario1 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['primeiro_oficial']."'";
					$cmd_busca_usuario1 = $con->prepare($sql_busca_usuario1);
					$cmd_busca_usuario1->execute();
					$resultado_busca_usuario1 = $cmd_busca_usuario1->fetch();
					$nome_usuario1 = $resultado_busca_usuario1["nome_discord_usuario"];
				}
	
				if($row['segundo_oficial']){
					$sql_busca_usuario2 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['segundo_oficial']."'";
					$cmd_busca_usuario2 = $con->prepare($sql_busca_usuario2);
					$cmd_busca_usuario2->execute();
					$resultado_busca_usuario2 = $cmd_busca_usuario2->fetch();
					$nome_usuario2 = $resultado_busca_usuario2["nome_discord_usuario"];
				}

				if($row['terceiro_oficial']){
					$sql_busca_usuario3 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['terceiro_oficial']."'";
					$cmd_busca_usuario3 = $con->prepare($sql_busca_usuario3);
					$cmd_busca_usuario3->execute();
					$resultado_busca_usuario3 = $cmd_busca_usuario3->fetch();
					$nome_usuario3 = $resultado_busca_usuario3["nome_discord_usuario"];
				}

				if($row['quarto_oficial']){
					$sql_busca_usuario4 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['quarto_oficial']."'";
					$cmd_busca_usuario4 = $con->prepare($sql_busca_usuario4);
					$cmd_busca_usuario4->execute();
					$resultado_busca_usuario4 = $cmd_busca_usuario4->fetch();
					$nome_usuario4 = $resultado_busca_usuario4["nome_discord_usuario"];
				}

				if($row['quinto_oficial']){
					$sql_busca_usuario5 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['quinto_oficial']."'";
					$cmd_busca_usuario5 = $con->prepare($sql_busca_usuario5);
					$cmd_busca_usuario5->execute();
					$resultado_busca_usuario5 = $cmd_busca_usuario5->fetch();
					$nome_usuario5 = $resultado_busca_usuario5["nome_discord_usuario"];
				}

				if($row['sexto_oficial']){
					$sql_busca_usuario6 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['sexto_oficial']."'";
					$cmd_busca_usuario6 = $con->prepare($sql_busca_usuario6);
					$cmd_busca_usuario6->execute();
					$resultado_busca_usuario6 = $cmd_busca_usuario6->fetch();
					$nome_usuario6 = $resultado_busca_usuario6["nome_discord_usuario"];
				}

				if($row['setimo_oficial']){
					$sql_busca_usuario7 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['setimo_oficial']."'";
					$cmd_busca_usuario7 = $con->prepare($sql_busca_usuario7);
					$cmd_busca_usuario7->execute();
					$resultado_busca_usuario7 = $cmd_busca_usuario7->fetch();
					$nome_usuario7 = $resultado_busca_usuario7["nome_discord_usuario"];
				}

				if($row['oitavo_oficial']){
					$sql_busca_usuario8 = "SELECT * FROM usuarios WHERE id_discord_usuario = '".$row['oitavo_oficial']."'";
					$cmd_busca_usuario8 = $con->prepare($sql_busca_usuario8);
					$cmd_busca_usuario8->execute();
					$resultado_busca_usuario8 = $cmd_busca_usuario8->fetch();
					$nome_usuario8 = $resultado_busca_usuario8["nome_discord_usuario"];
				}
				$dados[] = array("id_prisao" => $row['id_prisao'], "primeiro" => $nome_usuario1, "segundo" => $nome_usuario2, "terceiro" => $nome_usuario3, "quarto" => $nome_usuario4, "quinto" => $nome_usuario5, "sexto" => $nome_usuario6, "setimo" => $nome_usuario7, "oitavo" => $nome_usuario8, "passaporte_detento" => $row['id_detento'], "nome_detento" => $row['nome_detento'], "artigos" => $row['artigos_prisao'], "pena" => $row['pena_prisao'], "multa" => $row['multa_prisao'], "fianca" => $row['fianca_prisao'], "itens" => $row['itens_prisao'], "qsj" => $row['qsj_prisao'], "reu_primario" => $row['reu_primario'], "reu_confesso" => $row['reu_confesso'], "adv_constituido" => $row['adv_constituido'], "autenticacao" => $row['autenticacao'], "advogado" => $row['bombeiro'], "obs" => $row['obs'], "dt" => data_br($row['dt_prisao']), "obs1" => $row['observacoes']);
			}
			$matriz = array('resp'=>'ok','dados' => $dados, "sql" => $sql,'eric' => 'ok','id' => $id_prisao);
			echo json_encode($matriz);

		}
	} else if($_REQUEST['tab'] == 'rank'){
		if($_REQUEST['acao'] == 'prisao'){
			header('Content-Type: application/json');
			$dt1 = data_en($_POST['data_inicio']);
			$dt2 = data_en($_POST['data_final']);
			$guarnicao = $_POST['guarnicao'];
			$quantidade = $_POST['quantidade_registro'];

			if($guarnicao[0] == 0){
				$guarnicao_ = '$';
			} else if($guarnicao[0] == 1){
				$guarnicao_ = 'P.M.E.R.J';
			} else if($guarnica[0] == 2){
				$guarnicao_ = 'P.C.E.R.J';
			} else if($guarnicao[0] == 3){
				$guarnicao_ = 'P.R.F';
			} else if($guarnicao[0] == 4){
				$guarnicao_ = 'Polícia Federal';
			}

			$sql = "SELECT u.nome_discord_usuario, COUNT(r.ID) AS TOTAL  FROM ( SELECT primeiro_oficial AS ID FROM prisao WHERE dt_prisao >= '".$dt1." 00:00:01' AND dt_prisao <= '".$dt2." 23:59:59' UNION ALL SELECT segundo_oficial FROM prisao WHERE dt_prisao >= '".$dt1." 00:00:01' AND dt_prisao <= '".$dt2." 23:59:59' UNION ALL SELECT terceiro_oficial FROM prisao WHERE dt_prisao >= '".$dt1." 00:00:01' AND dt_prisao <= '".$dt2." 23:59:59' UNION ALL SELECT quarto_oficial FROM prisao WHERE dt_prisao >= '".$dt1." 00:00:01' AND dt_prisao <= '".$dt2." 23:59:59' UNION ALL SELECT quinto_oficial FROM prisao WHERE dt_prisao >= '".$dt1." 00:00:01' AND dt_prisao <= '".$dt2." 23:59:59' UNION ALL SELECT sexto_oficial FROM prisao WHERE dt_prisao >= '".$dt1." 00:00:01' AND dt_prisao <= '".$dt2." 23:59:59' UNION ALL SELECT setimo_oficial FROM prisao WHERE dt_prisao >= '".$dt1." 00:00:01' AND dt_prisao <= '".$dt2." 23:59:59' UNION ALL SELECT oitavo_oficial FROM prisao WHERE dt_prisao >= '".$dt1." 00:00:01' AND dt_prisao <= '".$dt2." 23:59:59' ) AS r INNER JOIN usuarios AS u ON r.ID = u.id_discord_usuario WHERE guarnicao REGEXP '".$guarnicao_."' GROUP BY r.ID, u.nome_discord_usuario ORDER BY TOTAL DESC LIMIT ".$quantidade."";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("nome_usuario" => $row["nome_discord_usuario"], "total_prisao" => $row["TOTAL"]);
			}
			//$matriz = array('resp'=>'ok','dados' => $dados);
			//echo json_encode($matriz);

			$matriz = array('resp'=>'ok','dados' => $dados,'sql' => $sql);
			echo json_encode($matriz);

			
		} else if($_REQUEST['acao'] == 'horas'){
			header('Content-Type: application/json');
			$dt1 = data_en($_POST['data_inicio']);
			$dt2 = data_en($_POST['data_final']);
			$guarnicao = $_POST['guarnicao'];
			$quantidade = $_POST['quantidade_registro'];
			if($guarnicao[0] == 0){
				$guarnicao_ = '$';
			} else if($guarnicao[0] == 1){
				$guarnicao_ = 'P.M.E.R.J';
			} else if($guarnica[0] == 2){
				$guarnicao_ = 'P.C.E.R.J';
			} else if($guarnicao[0] == 3){
				$guarnicao_ = 'P.R.F';
			} else if($guarnicao[0] == 4){
				$guarnicao_ = 'Polícia Federal';
			}

			$sql = "SELECT r.id_usuario, u.nome_discord_usuario, SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(r.dt_final, r.dt_inicio)))) AS horas_totais_formatadas FROM registros r JOIN canais c ON r.id_canal = c.id_canal JOIN usuarios u ON u.id_usuario = r.id_usuario WHERE dt_inicio >= '".$dt1." 00:00:01' AND dt_inicio <= '".$dt2." 23:59:59' AND c.obs != 2 AND u.status = 0 AND u.guarnicao REGEXP '".$guarnicao_."' GROUP BY r.id_usuario ORDER BY horas_totais_formatadas DESC LIMIT ".$quantidade."";
			$cmd = $con->prepare($sql);
			$cmd->execute();

			$dados = [];

			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("nome_usuario" => $row["nome_discord_usuario"], "total_horas" => $row["horas_totais_formatadas"]);
			}
			$matriz = array('resp' => 'ok', 'dados' => $dados, 'sql' => $sql);
			echo json_encode($matriz);

		}
	} else if($_REQUEST['tab'] == 'config'){
		if($_REQUEST['acao'] == 'lista_canais'){
			header('Content-Type: application/json');
			$sql = "SELECT * FROM canais";
			$cmd = $con->prepare($sql);
			$cmd->execute();
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("nome_canal" => $row["nome_canal_discord"], "id_canal" => $row["id_canal_discord"],"obs_canal" => $row["obs"]);
			}
			$matriz = array('resp' => 'ok', 'dados' => $dados, 'sql' => $sql);
			echo json_encode($matriz);

			
		} else if($_REQUEST['acao'] == 'logs_cargo'){
			header('Content-Type: application/json');
			$usuario = $_POST['passaporte'];
			$dt = $_POST['data'];
			$dt_ = data_en($dt);
			$sql = "SELECT * FROM logs_cargo WHERE executor_id = '".$usuario."' OR target_id = '".$usuario."'";
			$dados = [];
			while($row = $cmd->fetch(PDO::FETCH_BOTH)){
				$dados[] = array("acao" => $row["action"], "nome_usuario" => $row["executor_name"], "id_usuario" => $row["executor_id"], "nome_usuario2" => $row["target_name"], "id_usaurio1" => $row["target_id"]);
			}
			$matriz = array('resp' => 'ok', 'dados' => $dados);
			echo json_encode($matriz);
		}

	}
} else {
	echo ".";
}

?>