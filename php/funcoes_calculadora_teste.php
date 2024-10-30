<?php

// require_once(__DIR__.'/../assets/vendor/dompdf/autoload.php');
// use Dompdf\Dompdf;

// //Função para gerar pdf
// function gera_pdf($html, $pdf_name){
  
//     //instanciando o dompdf
//     $dompdf = new Dompdf();
  
//     //inserindo o HTML que queremos converter
//     $dompdf->loadHtml($html);
    
//     // Definindo o papel e a orientação
//     $dompdf->setPaper('A4', 'landscape');
  
//     // Renderizando o HTML como PDF
//     $dompdf->render();
  
//     // Enviando o PDF para o browser
//     $dompdf->stream("".$pdf_name.".pdf", array("Attachment" => false));
  
//   }

function insert_log($dados){
    require 'conexao.php';
    $sql = "INSERT INTO logs (id_usuarios, dt, dados) VALUES (:id_usuarios, :dt, :dados)";
    $cmd = $con->prepare($sql);
    $cmd->bindValue(':id_usuarios',$_SESSION['dados_usuario']['id_usuario']);
    $cmd->bindValue(':dt',date('Y-m-d H:i:s'));
    $cmd->bindValue(':dados',$dados);
    $cmd->execute();


}
function envia_apreensao_teste($primeiro_oficial,$segundo_oficial,$terceiro_oficial,$quarto_oficial,$quinto_oficial,$sexto_oficial,$setimo_oficial,$oitavo_oficial,$nome_detento,$id_detento,$artigos,$iten_prisao,$pena,$fianca,$multa,$primario,$confesso,$adv,$id_registro,$qsj_,$data_registro,$autenticacao){
    $oficial = "<@$primeiro_oficial>";

if($segundo_oficial == NULL ){
        $oficial .= "";
} else {
    $oficial .= " "."<@$segundo_oficial>";
}
if($terceiro_oficial == NULL){
    $oficial .= "";
} else {
    $oficial .= " "."<@$terceiro_oficial>";
}
if($quarto_oficial == NULL ){
    $oficial .= "";
} else {
    $oficial .= " "."<@$quarto_oficial>";
}
if($quinto_oficial == NULL){
    $oficial .= "";
} else {
    $oficial .= " "."<@$quinto_oficial>";
}
if($sexto_oficial == NULL ){
    $oficial .= "";
} else {
    $oficial .= " "."<@$sexto_oficial>";
}
if($setimo_oficial == NULL ){
    $oficial .= "";
} else {
    $oficial .= " "."<@$setimo_oficial>";
}
if($oitavo_oficial == NULL ){
    $oficial .= "";
} else {
    $oficial .= " "."<@$oitavo_oficial>";
}
    //$webhookurl = "https://discord.com/api/webhooks/1145721102446907512/YhS5699N35g-j6yPhHTw4a4VI7VtaXxGQqRcFJg11cRh2Z_5LZ_ejReugTIZO9qb4OPC";
    $webhookurl = "https://discord.com/api/webhooks/1145714046008569878/BD7G2lKFTDTCNk6viAlFvMv6VRDweE0XRuyA7yaPcL1OK68XrP-S4_rsWd0QnGUBU80h";
    $timestamp = date("c", strtotime("now"));
    $json_data = json_encode([
        "tts" => true,
        //"username" => "APRENSÕES - MARE",
        "embeds" => [
            [
                "url" => "https://gist.github.com/Mo45/cb0813cb8a6ebcd6524f6a36d4f8862c",
                "timestamp" => $timestamp,
                "color" => hexdec( "3366ff" ),
                "footer" => [
                    "text" => "Apreensões Maré"
                ],
                "fields" => [
                    [
                        "name" => "**Oficiais**",
                        "value" => "$oficial",
                        "inline" => false
                    ],                
                    [
                        "name" => "**Nome Detento:**",
                        "value" => "$nome_detento",
                        "inline" => true
                    ],
                    [
                        "name" => "**ID Detento:**",
                        "value" => "$id_detento",
                        "inline" => true
                    ],
                    [
                        "name" => "**Artigos:**",
                        "value" => "$artigos",
                        "inline" => false
                    ],
                    [
                        "name" => "**Itens Aprendido:**",
                        "value" => "$iten_prisao",
                        "inline" => false
                    ],
                    [
                        "name" => "**Fiança:**",
                        "value" => "$fianca",
                        "inline" => true
                    ],
                    [
                        "name" => "**Multa:**",
                        "value" => "$multa",
                        "inline" => true
                    ],
                    [
                        "name" => "**Pena:**",
                        "value" => "$pena Meses",
                        "inline" => true
                    ],
                    [
                        "name" => "**Reu Primario?**",
                        "value" => "$primario",
                        "inline" => true
                    ],
                    [
                        "name" => "**Reu Confesso?**",
                        "value" => "$confesso",
                        "inline" => true
                    ],
                    [
                        "name" => "**Advogado Constituido?**",
                        "value" => "$adv",
                        "inline" => true
                    ],
                    [
                        "name" => "**Dinheiro Sujo**",
                        "value" => "R$ $qsj_",
                        "inline" => true
                    ],
                    [
                        "name" => "**Autenticação**",
                        "value" => "$autenticacao",
                        "inline" => false
                    ],
                    // Etc..
                ]
            ]
        ]
    
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
    
    
    $ch = curl_init( $webhookurl );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    
    $response = curl_exec( $ch );
    $http = curl_getinfo( $ch );
    
    //echo 'HTTP Code: ' . $http;
    curl_close( $ch );
    }
    
function envia_apreensao($primeiro_oficial,$segundo_oficial,$terceiro_oficial,$quarto_oficial,$quinto_oficial,$sexto_oficial,$setimo_oficial,$oitavo_oficial,$nome_detento,$id_detento,$artigos,$iten_prisao,$pena,$fianca,$multa,$primario,$confesso,$adv,$id_registro,$qsj_,$data_registro,$bombeiro,$autenticacao,$obs_){
    $oficial = "<@$primeiro_oficial>";

if($segundo_oficial == NULL ){
        $oficial .= "";
} else {
    $oficial .= " "."<@$segundo_oficial>";
}
if($terceiro_oficial == NULL){
    $oficial .= "";
} else {
    $oficial .= " "."<@$terceiro_oficial>";
}
if($quarto_oficial == NULL ){
    $oficial .= "";
} else {
    $oficial .= " "."<@$quarto_oficial>";
}
if($quinto_oficial == NULL){
    $oficial .= "";
} else {
    $oficial .= " "."<@$quinto_oficial>";
}
if($sexto_oficial == NULL ){
    $oficial .= "";
} else {
    $oficial .= " "."<@$sexto_oficial>";
}
if($setimo_oficial == NULL ){
    $oficial .= "";
} else {
    $oficial .= " "."<@$setimo_oficial>";
}
if($oitavo_oficial == NULL ){
    $oficial .= "";
} else {
    $oficial .= " "."<@$oitavo_oficial>";
}
if($bombeiro == NULL ){
    $nome_bombeiro = "";
} else {
    $nome_bombeiro = $bombeiro;
}
    $webhookurl = "https://discord.com/api/webhooks/1261410633702969516/j2T-btYzaT3-PYWcLBNVzd-uTT7aidPww3nkIx-3rVqHjQGctN6Me2IKMhcQThjNdeMC";
    //$webhookurl = "https://discord.com/api/webhooks/1145714046008569878/BD7G2lKFTDTCNk6viAlFvMv6VRDweE0XRuyA7yaPcL1OK68XrP-S4_rsWd0QnGUBU80h";
    $timestamp = date("c", strtotime("now"));
    $json_data = json_encode([
        "tts" => false,
        //"username" => "APRENSÕES - MARE",
        "embeds" => [
            [
                "url" => "https://gist.github.com/Mo45/cb0813cb8a6ebcd6524f6a36d4f8862c",
                "timestamp" => $timestamp,
                "color" => hexdec( "3366ff" ),
                "footer" => [
                    "text" => "Apreensões Maré"
                ],
                "fields" => [
                    [
                        "name" => "**Oficiais**",
                        "value" => "$oficial",
                        "inline" => false
                    ],                
                    [
                        "name" => "**Nome Detento:**",
                        "value" => "$nome_detento",
                        "inline" => true
                    ],
                    [
                        "name" => "**ID Detento:**",
                        "value" => "$id_detento",
                        "inline" => true
                    ],
                    [
                        "name" => "**Artigos:**",
                        "value" => "$artigos",
                        "inline" => false
                    ],
                    [
                        "name" => "**Itens Aprendido:**",
                        "value" => "$iten_prisao",
                        "inline" => false
                    ],
                    [
                        "name" => "**Fiança:**",
                        "value" => "$fianca",
                        "inline" => true
                    ],
                    [
                        "name" => "**Multa:**",
                        "value" => "$multa",
                        "inline" => true
                    ],
                    [
                        "name" => "**Pena:**",
                        "value" => "$pena Meses",
                        "inline" => true
                    ],
                    [
                        "name" => "**Reu Primario?**",
                        "value" => "$primario",
                        "inline" => true
                    ],
                    [
                        "name" => "**Reu Confesso?**",
                        "value" => "$confesso",
                        "inline" => true
                    ],
                    [
                        "name" => "**Advogado Constituido?**",
                        "value" => "$adv",
                        "inline" => true
                    ],
                    [
                        "name" => "**Dinheiro Sujo**",
                        "value" => "$qsj_",
                        "inline" => true
                    ],
                    [
                        "name" => "**Nome / ID Advogado**",
                        "value" => "$nome_bombeiro",
                        "inline" => true
                    ],
                    [
                        "name" => "**Observações / Anotações**",
                        "value" => "$obs_",
                        "inline" => false
                    ],
                    [
                        "name" => "**Autenticação**",
                        "value" => "$autenticacao",
                        "inline" => false
                    ],
                    // Etc..
                ]
            ]
        ]
    
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
    
    
    $ch = curl_init( $webhookurl );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    
    $response = curl_exec( $ch );
    $http = curl_getinfo( $ch );
    
    //echo 'HTTP Code: ' . $http;
    curl_close( $ch );
}

function envia_apreensao_visao($primeiro_oficial,$segundo_oficial,$terceiro_oficial,$quarto_oficial,$quinto_oficial,$sexto_oficial,$setimo_oficial,$oitavo_oficial,$nome_detento,$id_detento,$artigos,$iten_prisao,$pena,$fianca,$multa,$primario,$confesso,$adv,$id_registro,$qsj_,$data_registro,$bombeiro,$autenticacao){
    $oficial = "<@$primeiro_oficial>";

if($segundo_oficial == NULL ){
        $oficial .= "";
} else {
    $oficial .= " "."<@$segundo_oficial>";
}
if($terceiro_oficial == NULL){
    $oficial .= "";
} else {
    $oficial .= " "."<@$terceiro_oficial>";
}
if($quarto_oficial == NULL ){
    $oficial .= "";
} else {
    $oficial .= " "."<@$quarto_oficial>";
}
if($quinto_oficial == NULL){
    $oficial .= "";
} else {
    $oficial .= " "."<@$quinto_oficial>";
}
if($sexto_oficial == NULL ){
    $oficial .= "";
} else {
    $oficial .= " "."<@$sexto_oficial>";
}
if($setimo_oficial == NULL ){
    $oficial .= "";
} else {
    $oficial .= " "."<@$setimo_oficial>";
}
if($oitavo_oficial == NULL ){
    $oficial .= "";
} else {
    $oficial .= " "."<@$oitavo_oficial>";
}
if($bombeiro == NULL ){
    $nome_bombeiro = "";
} else {
    $nome_bombeiro = $bombeiro;
}
    $webhookurl = "https://discord.com/api/webhooks/1248414946254127195/AgY_IbaCRbyrwz8BjxYLQOU-ZpwtX01WJjS-5dUJApU_pAVOMv1CFJ8I4h3SDrpgNJdT";
    //$webhookurl = "https://discord.com/api/webhooks/1145714046008569878/BD7G2lKFTDTCNk6viAlFvMv6VRDweE0XRuyA7yaPcL1OK68XrP-S4_rsWd0QnGUBU80h";
    $timestamp = date("c", strtotime("now"));
    $json_data = json_encode([
        "tts" => false,
        //"username" => "APRENSÕES - MARE",
        "embeds" => [
            [
                "url" => "https://gist.github.com/Mo45/cb0813cb8a6ebcd6524f6a36d4f8862c",
                "timestamp" => $timestamp,
                "color" => hexdec( "3366ff" ),
                "footer" => [
                    "text" => "Apreensões Maré"
                ],
                "fields" => [
                    [
                        "name" => "**Oficiais**",
                        "value" => "$oficial",
                        "inline" => false
                    ],                
                    [
                        "name" => "**Nome Detento:**",
                        "value" => "$nome_detento",
                        "inline" => true
                    ],
                    [
                        "name" => "**ID Detento:**",
                        "value" => "$id_detento",
                        "inline" => true
                    ],
                    [
                        "name" => "**Artigos:**",
                        "value" => "$artigos",
                        "inline" => false
                    ],
                    [
                        "name" => "**Itens Aprendido:**",
                        "value" => "$iten_prisao",
                        "inline" => false
                    ],
                    [
                        "name" => "**Fiança:**",
                        "value" => "$fianca",
                        "inline" => true
                    ],
                    [
                        "name" => "**Multa:**",
                        "value" => "$multa",
                        "inline" => true
                    ],
                    [
                        "name" => "**Pena:**",
                        "value" => "$pena Meses",
                        "inline" => true
                    ],
                    [
                        "name" => "**Reu Primario?**",
                        "value" => "$primario",
                        "inline" => true
                    ],
                    [
                        "name" => "**Reu Confesso?**",
                        "value" => "$confesso",
                        "inline" => true
                    ],
                    [
                        "name" => "**Advogado Constituido?**",
                        "value" => "$adv",
                        "inline" => true
                    ],
                    [
                        "name" => "**Dinheiro Sujo**",
                        "value" => "R$ $qsj_",
                        "inline" => true
                    ],
                    [
                        "name" => "**Nome / ID Advogado**",
                        "value" => "$nome_bombeiro",
                        "inline" => false
                    ],
                    [
                        "name" => "**Autenticação**",
                        "value" => "$autenticacao",
                        "inline" => false
                    ],
                    // Etc..
                ]
            ]
        ]
    
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
    
    
    $ch = curl_init( $webhookurl );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    
    $response = curl_exec( $ch );
    $http = curl_getinfo( $ch );
    
    //echo 'HTTP Code: ' . $http;
    curl_close( $ch );
}


function envia_log_bateponto($log, $cor){

    #$webhookurl = "https://discord.com/api/webhooks/1184846599323652106/QljGMH0Ds7UUuylFrTkgiW8YOqvPzfi5ZXoVpaGhc_xXfWllyvmN-DJgjYDozD50ln6D";
    //$webhookurl = "https://discord.com/api/webhooks/1145714046008569878/BD7G2lKFTDTCNk6viAlFvMv6VRDweE0XRuyA7yaPcL1OK68XrP-S4_rsWd0QnGUBU80h";
    $timestamp = date("c", strtotime("now"));
    $json_data = json_encode([
        "tts" => true,
        //"username" => "APRENSÕES - MARE",
        "embeds" => [
            [
                "url" => "https://gist.github.com/Mo45/cb0813cb8a6ebcd6524f6a36d4f8862c",
                "timestamp" => $timestamp,
                "color" => hexdec( "$cor" ),
                "footer" => [
                    "text" => "Apreensões Maré"
                ],
                "fields" => [
                    [
                        "name" => "**Oficiais**",
                        "value" => "$oficial",
                        "inline" => false
                    ],                
                    [
                        "name" => "**Nome Detento:**",
                        "value" => "$nome_detento",
                        "inline" => true
                    ],
                    [
                        "name" => "**ID Detento:**",
                        "value" => "$id_detento",
                        "inline" => true
                    ],
                    [
                        "name" => "**Artigos:**",
                        "value" => "$artigos",
                        "inline" => false
                    ],
                    [
                        "name" => "**Itens Aprendido:**",
                        "value" => "$iten_prisao",
                        "inline" => false
                    ],
                    [
                        "name" => "**Fiança:**",
                        "value" => "$fianca",
                        "inline" => true
                    ],
                    [
                        "name" => "**Multa:**",
                        "value" => "$multa",
                        "inline" => true
                    ],
                    [
                        "name" => "**Pena:**",
                        "value" => "$pena Meses",
                        "inline" => true
                    ],
                    [
                        "name" => "**Reu Primario?**",
                        "value" => "$primario",
                        "inline" => true
                    ],
                    [
                        "name" => "**Reu Confesso?**",
                        "value" => "$confesso",
                        "inline" => true
                    ],
                    [
                        "name" => "**Advogado Constituido?**",
                        "value" => "$adv",
                        "inline" => true
                    ],
                    [
                        "name" => "**Dinheiro Sujo**",
                        "value" => "R$ $qsj_",
                        "inline" => true
                    ],
                    [
                        "name" => "**Autenticação**",
                        "value" => "$autenticacao",
                        "inline" => false
                    ],
                    // Etc..
                ]
            ]
        ]
    
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
    
    
    $ch = curl_init( $webhookurl );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    
    $response = curl_exec( $ch );
    $http = curl_getinfo( $ch );
    
    //echo 'HTTP Code: ' . $http;
    curl_close( $ch );
}
function data_br($data){
    if($data != "" || $data != null){
        return date('d/m/Y H:i:s', strtotime($data));
    } else {
        return "Em Aberto";
    }
}

function data_en($data){
    return date('Y-m-d', strtotime(str_replace('/', '-', $data)));
}


function add_registro_ponto($id_discord){
    require 'conexao_db.php';

    $data = date('Y-m-d');
    $sql = "SELECT * FROM registro_ponto WHERE = '".$id_discord."' AND data_inicio";



    $sql = "INSERT INTO registro_ponto (dt_inicio, id_usuario) VALUES (:dt_inicio, :id_usuario)";
    $cmd_insert = $con->prepare($sql);
    $dt = date('Y-m-d H:i:s');
    $cmd_insert->bindValue(':dt_inicio', $dt);
    //$cmd_insert->bindValue(':dt_final', $dt);
    $cmd_insert->bindValue(':id_usuario', $id_discord);
    if($cmd_insert->execute()){
        echo "OK";
    } else {
        echo "ERRO";
    }

}
function altera_nome($id_discord, $nome){
    echo "teste";
}

function busca_usuario($id_discord){
    require 'conexao_db.php';
    $sql = "SELECT * FROM usuarios WHERE id_usuario = '".$id_discord."'";
    $cmd = $con->prepare($sql);
    $cmd->execute();
    if($cmd->rowCount() > 0){
        return 0;
    } else {
        return 1;
    }
}

function cria_usuario($id_discord, $nome){
    require 'conexao_db.php';
    $sql = "INSERT into usuarios(id_usuario, nome_usuario) VALUES (:id_discord, :nome)";
    $cmd = $con->prepare($sql);
    $cmd->bindValue(':id_discord', $id_discord);
    $cmd->bindValue(':nome', $nome);
					
    if($cmd->execute()){
        return 0;
    } else {
        return 1;
    }
}

function altera_nome_usuario($id_discord, $nome){
    require 'conexao_db.php';
    $sql = "SELECT * FROM usuarios WHERE id_usuario = '".$id_discord."'";
    $cmd = $con->prepare($sql);
    $cmd->execute();
    while ($row = $cmd->fetch(PDO::FETCH_BOTH)) {
        $nome_atual = $row['nome_usuario'];
    }
    //echo "Nome usuario atual -> $nome_atual";
    //echo "<br>";
    //echo "Nome usuario atual -> $nome";
    //echo "<br>";
    if(!($nome == $nome_atual)){
        //echo "executando alteração nome";
        $sql_update = "UPDATE usuarios SET nome_usuario = :nome WHERE id_usuario = '".$id_discord."'";
        $cmd_update = $con->prepare($sql_update);
        $cmd_update->bindValue(':nome', $nome);
        $cmd_update->execute();
    }
}

function registra_ponto($id_discord){
    require 'conexao_db.php';

    // Usado para teste
    if(busca_usuario($id_discord) == 0){
        echo "Usuario Existe ";
    } else {
        echo "Usuario não Esiste";
    }

    // Verifica se o usuario existe

    /*// Verifica se o ponto já esta aberto
    $data = date('Y-m-d');
    $sql = "SELECT * FROM registro_ponto WHERE id_usuario = '".$id_discord."' AND dt_inicio LIKE '".$data."%'";
    $cmd = $con->prepare($sql);
    $cmd->execute();
    if($cmd->rowCount() > 0){
        echo "Mensagem enviada para bot -> Ponto já aberto";
    } else {
        echo "Mensagem enviada para bot -> Ponto não esta aberto";
    }
    */


}
function inicia_ponto($id_discord){
    require 'conexao_db.php';
    
    $sql = "INSERT INTO registro_ponto (dt_inicio, id_usuario) VALUES (:dthora, :id_discord)";
    $cmd = $con->prepare($sql);
    $dthora = date('Y-m-d H:i:s');
    $cmd->bindValue(':dthora', $dthora);
    $cmd->bindValue(':id_discord', $id_discord);


        if($cmd->execute()){
        //return 0;
        echo "Ponto Iniciado com sucesso";
        $sql_update = "UPDATE usuarios SET status = 0 WHERE id_usuario = '".$id_discord."'";
        $cmd_update = $con->prepare($sql_update);
        $cmd_update->execute();
    } else {
        echo "Ponto Erro";
        //return 1;
    }
}

function finaliza_ponto($id_discord){
    require 'conexao_db.php';

    $sql = "SELECT status FROM usuarios WHERE id_usuario = '".$id_discord."'";
    $cmd = $con->prepare($sql);
    $cmd->execute();

    while ($row = $cmd->fetch(PDO::FETCH_BOTH)) {
        $status = $row['status'];
    }

    if($status == 1){
        echo "Ponto Fechado"; // mensagem devera ser enviada pelo discord
    } else {
        echo "Ponto Aberto, Iniciando Fechamento"; // mensagem devera ser enviada pelo discord
        $dt = date('Y-m-d');
        $sql = "SELECT * FROM registro_ponto WHERE dt_inicio LIKE '".$dt."%' AND dt_final IS NULL AND id_usuario = '".$id_discord."'";
        $cmd = $con->prepare($sql);
        $cmd->execute();
        while ($row = $cmd->fetch(PDO::FETCH_BOTH)) {
            $id = $row['id_registro'];
        }
        $sql = "UPDATE registro_ponto SET dt_final = :dt_final WHERE id_registro = '".$id."'";
        $cmd = $con->prepare($sql);
        $dthora = date('Y-m-d H:i:s');
        $cmd->bindValue(':dt_final', $dthora);
        if($cmd->execute()){
            $sql_update = "UPDATE usuarios SET status = 1 WHERE id_usuario = '".$id_discord."'";
            $cmd_update = $con->prepare($sql_update);
            $cmd_update->execute();
        }
    }
}
function status_ponto($id_discord){
    require 'conexao_db.php';

    //verifica status do ponto
    $sql = "SELECT status FROM usuarios WHERE id_usuario = '".$id_discord."'";
    $cmd = $con->prepare($sql);
    $cmd->execute();

    while ($row = $cmd->fetch(PDO::FETCH_BOTH)) {
        $status = $row['status'];
    }
    if($status == 0){
        echo "Status Online";
        return 0;
        // Fim Script
    } else {
        echo "Status Offline";
        //inicia_ponto($id_discord);
        return 1;
    }
}



?>