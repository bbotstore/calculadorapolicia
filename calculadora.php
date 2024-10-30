<?php
$ip = '138.59.33.116';

if ($_SERVER['HTTP_X_FORWARDED_FOR'] != $ip)
   //die('');
?>
<?php require('includes/header_.php'); ?>
<div class="header bg-primary pb-6">
   <div class="container-fluid">
      <div class="header-body">
         <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
               <h6 class="h2 text-white d-inline-block mb-0">Policia - Calculadora Penal</h6>
            </div>
             <div class="col-lg-6 col-5 text-right">
               </div> 
         </div>
      </div>
   </div>
</div>
<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span><br>
  </div>
</div>
<div class="container-fluid mt--6">
<div class="card mb-4">
<div class="card-header">
      <h3 class="mb-0">CALCULADORA PENAL - INTEGRADA COM DISCORD</h3>
      <small style="color: red">ATENÇÃO, Ao finalizar é necessario Algum dos oficiais presente na prisão reagir na mensagem enviada na aba de Apreensões Mare caso contrario o registro sera deletado e não sera contabilizado</small>
</div> 

<div class="card-body">
<div class="row">
            <div class="col-md-4"><!-- Inicio Coluna 1 -->
              <div class="form-group">
              <label class="form-control-label"><b>CRIMES CONTRA A VIDA</b></label>
                    <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 1.1 - Homicídio Doloso Qualificado" type="checkbox" name="crime" value="35|150000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 1.1 - Homicídio Doloso Qualificado">Art. 1.1 - Homicídio Doloso Qualificado</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 1.2 - Homicídio Doloso" type="checkbox" name="crime" value="30|125000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 1.2 - Homicídio Doloso">Art. 1.2 - Homicídio Doloso</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 1.3 - Tentativa de Homicídio" type="checkbox" name="crime" value="30|900000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 1.3 - Tentativa de Homicídio">Art. 1.3 - Tentativa de Homicídio</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 1.4 - Homicídio Culposo" type="checkbox" name="crime" value="20|100000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 1.4 - Homicídio Culposo">Art. 1.4 - Homicídio Culposo</label>
                      </div>
              </div>
              <div class="form-group">
              <label class="form-control-label"><b>CRIMES CONTRA DIREITOS FUNDAMENTAIS</b></label>
                    <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 2.1 - Lesão Corporal" type="checkbox" name="crime" value="10|15000|200000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 2.1 - Lesão Corporal">Art. 2.1 - Lesão Corporal</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 2.2 - Sequestro" type="checkbox" name="crime" value="50|100000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 2.2 - Sequestro">Art. 2.2 - Sequestro</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 2.3 - Cárcere Privado" type="checkbox" name="crime" value="15|50000|200000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 2.3 - Cárcere Privado">Art. 2.3 - Cárcere Privado</label>
                      </div>
              </div>
              <div class="form-group">
              <label class="form-control-label"><b>CRIMES CONTRA O PATRIMÔNIO</b></label>
                    <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 3.1 - Desmanche de Veículos" type="checkbox" name="crime" value="35|70000|250000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 3.1 - Desmanche de Veículos">Art. 3.1 - Desmanche de Veículos</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 3.2 - Furto" type="checkbox" name="crime" value="20|60000|62500" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 3.2 - Furto">Art. 3.2 - Furto</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 3.3 - Receptação de Veículos" type="checkbox" name="crime" value="15|50000|62500" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 3.3 - Receptação de Veículos">Art. 3.3 - Receptação de Veículos</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 3.4 - Roubo de Veículos" type="checkbox" name="crime" value="25|70000|62500" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 3.4 - Roubo de Veículos">Art. 3.4 - Roubo de Veículos</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 3.5 - Furto de Veículos" type="checkbox" name="crime" value="25|40000|62500" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 3.5 - Furto de Veículos">Art. 3.5 - Furto de Veículos</label>
                      </div>
              </div>
              <div class="form-group">
              <label class="form-control-label"><b>CRIMES DE ROUBOS, FURTOS E SEUS VARIANTES</b></label>
                    <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 4.1 - Roubo" type="checkbox" name="crime" value="10|100000|150000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 4.1 - Roubo">Art. 4.1 - Roubo</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 4.2 - Furto a caixa eletrônico" type="checkbox" name="crime" value="15|55000|80000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 4.2 - Furto a caixa eletrônico">Art. 4.2 - Furto a caixa eletrônico</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 4.3 - Extorsão" type="checkbox" name="crime" value="25|45000|250000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 4.3 - Extorsão">Art. 4.3 - Extorsão</label>
                      </div>
              </div>
              <div class="form-group">
              <label class="form-control-label"><b>CRIMES DE PORTE, POSSE E TRÁFICO</b></label>
                    <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.1 - Posse de peças de armas" type="checkbox" name="crime" value="10|120000|125000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.1 - Posse de peças de armas">Art. 5.1 - Posse de peças de armas</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.2 - Posse de Capsula" type="checkbox" name="crime" value="35|120000|125000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.2 - Posse de Capsula">Art. 5.2 - Posse de Capsula</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.3 - Tráfico de Armas" type="checkbox" name="crime" value="60|200000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.3 - Tráfico de Armas">Art. 5.3 - Tráfico de Armas</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.4 - Porte de Arma Pesada" type="checkbox" name="crime" value="20|150000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.4 - Porte de Arma Pesada">Art. 5.4 - Porte de Arma Pesada</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.5 - Porte de Arma Leve" type="checkbox" name="crime" value="15|100000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.5 - Porte de Arma Leve">Art. 5.5 - Porte de Arma Leve</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.6 - Disparo de Arma" type="checkbox" name="crime" value="5|50000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.6 - Disparo de Arma">Art. 5.6 - Disparo de Arma</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.7 - Tráfico de Munições (+100)" type="checkbox" name="crime" value="60|150000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.7 - Tráfico de Munições (+100)">Art. 5.7 - Tráfico de Munições (+100)</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.8 - Porte de Munição (-100)" type="checkbox" name="crime" value="15|50000|125000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.8 - Porte de Munição (-100)">Art. 5.8 - Porte de Munição (-100)</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.9 - Posse de Colete" type="checkbox" name="crime" value="20|60000|30000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.9 - Posse de Colete">Art. 5.9 - Posse de Colete</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.10 - Posse de Arma Branca" type="checkbox" name="crime" value="0|12500|0" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.10 - Posse de Arma Branca">Art. 5.10 - Posse de Arma Branca</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.11 - Tráfico de drogas (+100)" type="checkbox" name="crime" value="35|150000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.11 - Tráfico de drogas (+100)">Art. 5.11 - Tráfico de drogas (+100)</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.12 - Aviãozinho (6 a 100)" type="checkbox" name="crime" value="20|75000|70000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.12 - Aviãozinho (6 a 100)">Art. 5.12 - Aviãozinho (6 a 100)</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.13 - Posse de Componentes Narcóticos" type="checkbox" name="crime" value="10|30000|125000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.13 - Posse de Componentes Narcóticos">Art. 5.13 - Posse de Componentes Narcóticos</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.14 - Posse de drogas (1 a 5)" type="checkbox" name="crime" value="0|6000|0" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.14 - Posse de drogas (1 a 5)">Art. 5.14 - Posse de drogas (1 a 5)</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.15 - Dinheiro sujo" type="checkbox" name="crime" value="25|500|60000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.15 - Dinheiro sujo">Art. 5.15 - Dinheiro sujo</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.16 - Contrabando" type="checkbox" name="crime" value="30|200000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.16 - Contrabando">Art. 5.16 - Contrabando</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 5.17 - Descaminho" type="checkbox" name="crime" value="15|100000|70000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 5.17 - Descaminho">Art. 5.17 - Descaminho</label>
                      </div>

              </div>
              <div class="form-group">
              <label class="form-control-label"><b>QUBERA DE REGRAS</b></label>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="CL - Combat Logging" type="checkbox" name="crime" value="180|100000|NA" onclick="calcular_pena()">
                            <label class="custom-control-label" for="CL - Combat Logging">CL - Combat Logging</label>
                      </div>
                      </div>
            </div> <!-- Fim Coluna 1 -->
            <div class="col-md-4"> <!-- Inicio Coluna 2 -->
              <div class="form-group">
              <label class="form-control-label"><b>CRIMES CONTRA A ORDEM PUBLICA</b></label>
                    <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.1 - Falsidade ideológica" type="checkbox" name="crime" value="25|125000|62500" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.1 - Falsidade ideológica">Art. 6.1 - Falsidade ideológica</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.2 - Formação de quadrilha" type="checkbox" name="crime" value="20|150000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.2 - Formação de quadrilha">Art. 6.2 - Formação de quadrilha</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.3 - Apologia ao crime" type="checkbox" name="crime" value="10|100000|15000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.3 - Apologia ao crime">Art. 6.3 - Apologia ao crime</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.4 - Posse de arma em públic" type="checkbox" name="crime" value="10|15000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.4 - Posse de arma em públic">Art. 6.4 - Posse de arma em público</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.5 - Suborno" type="checkbox" name="crime" value="20|30000|100000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.5 - Suborno">Art. 6.5 - Suborno</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.6 - Ameaça" type="checkbox" name="crime" value="5|15000|10000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.6 - Ameaça">Art. 6.6 - Ameaça</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.7 - Falsa comunicação de crime" type="checkbox" name="crime" value="10|50000|10000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.7 - Falsa comunicação de crime">Art. 6.7 - Falsa comunicação de crime</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.8- Uso indevido de 190/192" type="checkbox" name="crime" value="10|30000|10000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.8- Uso indevido de 190/192">Art. 6.8- Uso indevido de 190/192</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.10 - Posse de itens ilegais" type="checkbox" name="crime" value="10|10000|10000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.10 - Posse de itens ilegais">Art. 6.10 - Posse de itens ilegais</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.11 - Assédio moral" type="checkbox" name="crime" value="10|15000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.11 - Assédio moral">Art. 6.11 - Assédio moral</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.12- Atentado ao pudor" type="checkbox" name="crime" value="10|15000|10000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.12- Atentado ao pudor">Art. 6.12- Atentado ao pudor</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.13 - Vandalismo" type="checkbox" name="crime" value="10|16000|10000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.13 - Vandalismo">Art. 6.13 - Vandalismo</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.14 - Dano ao Patrimonio Público" type="checkbox" name="crime" value="15|100000|12000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.14 - Dano ao Patrimonio Público">Art. 6.14 - Dano ao Patrimonio Público</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.15 - Invasão de propriedade" type="checkbox" name="crime" value="15|20000|200000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.15 - Invasão de propriedade">Art. 6.15 - Invasão de propriedade</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.16 - Abuso de autoridade" type="checkbox" name="crime" value="20|50000|20000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.16 - Abuso de autoridade">Art. 6.16 - Abuso de autoridade</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.17 - Uso de máscara" type="checkbox" name="crime" value="10|50000|10000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.17 - Uso de máscara">Art. 6.17 - Uso de máscara</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.18 - Uso de equipamentos restritos" type="checkbox" name="crime" value="10|20000|10000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.18 - Uso de equipamentos restritos">Art. 6.18 - Uso de equipamentos restritos</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.19 - Omissão de socorro" type="checkbox" name="crime" value="15|30000|15000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.19 - Omissão de socorro">Art. 6.19 - Omissão de socorro</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.20 - Tentativa de fuga" type="checkbox" name="crime" value="15|50000|8000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.20 - Tentativa de fuga">Art. 6.20 - Tentativa de fuga</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.21 - Desacato 1" type="checkbox" name="crime" value="20|70000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.21 - Desacato 1">Art. 6.21 - Desacato 1</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.22 - Desacato 2" type="checkbox" name="crime" value="20|70000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.22 - Desacato 2">Art. 6.22 - Desacato 2</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.23 - Desacato 3" type="checkbox" name="crime" value="20|70000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.23 - Desacato 3">Art. 6.23 - Desacato 3</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.24 - Resistência a prisão" type="checkbox" name="crime" value="10|50000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.24 - Resistência a prisão">Art. 6.24 - Resistência a prisão</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.25 - Réu Reincidente" type="checkbox" name="crime" value="5|50000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.25 - Réu Reincidente">Art. 6.25 - Réu Reincidente</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.26 - Cúmplice" type="checkbox" name="crime" value="0|10000|10000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.26 - Cúmplice">Art. 6.26 - Cúmplice</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.27 - Obstrução à Justiça" type="checkbox" name="crime" value="20|50000|20000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.27 - Obstrução à Justiça">Art. 6.27 - Obstrução à Justiça</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.28 - Ocultação de Provas" type="checkbox" name="crime" value="10|50000|20000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.28 - Ocultação de Provas">Art. 6.28 - Ocultação de Provas</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.29 - Zaralho em recrutamento policial" type="checkbox" name="crime" value="100|100000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.29 - Zaralho em recrutamento policial">Art. 6.29 - Zaralho em recrutamento policial</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.30 - Prisão Militar" type="checkbox" name="crime" value="35|100000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.30 - Prisão Militar">Art. 6.30 - Prisão Militar</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.31 - Prevaricação" type="checkbox" name="crime" value="35|100000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.31 - Prevaricação">Art. 6.31 - Prevaricação</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.32 - Invasão de Departamento Policial" type="checkbox" name="crime" value="100|100000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.32 - Invasão de Departamento Policial">Art. 6.32 - Invasão de Departamento Policial</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.33 - Vadiagem" type="checkbox" name="crime" value="10|50000|10000" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.33 - Vadiagem">Art. 6.33 - Vadiagem</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="Art. 6.33 - Desobediência" type="checkbox" name="crime" value="20|50000|NA" onclick="calcular_pena()">
                        <label class="custom-control-label" for="Art. 6.33 - Desobediência">Art. 6.34 - Desobediência</label>
                      </div>
              </div>
              <div class="form-group">
              <label class="form-control-label"><b>CRIMES DE TRÂNSITO</b></label>
                    <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 7.1 - Condução imprudente" type="checkbox" name="crime" value="10|30000|10000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 7.1 - Condução imprudente">Art. 7.1 - Condução imprudente</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 7.2 - Dirigir na contra mão" type="checkbox" name="crime" value="0|30000|8000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 7.2 - Dirigir na contra mão">Art. 7.2 - Dirigir na contra mão</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 7.3 - Alta velocidade" type="checkbox" name="crime" value="0|50000|10000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 7.3 - Alta velocidade">Art. 7.3 - Alta velocidade</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 7.4 - Poluição sonora" type="checkbox" name="crime" value="0|50000|25000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 7.4 - Poluição sonora">Art. 7.4 - Poluição sonora</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 7.5 - Corridas Ilegais" type="checkbox" name="crime" value="0|50000|25000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 7.5 - Corridas Ilegais">Art. 7.5 - Corridas Ilegais</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 7.6 - Uso excessivo de insulfilm" type="checkbox" name="crime" value="0|25000|0" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 7.6 - Uso excessivo de insulfilm">Art. 7.6 - Uso excessivo de insulfilm</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 7.7 - Veículo muito danificado" type="checkbox" name="crime" value="0|25000|15000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 7.7 - Veículo muito danificado">Art. 7.7 - Veículo muito danificado</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 7.8 - Veículo Ilegalmente estacionado" type="checkbox" name="crime" value="0|30000|15000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 7.8 - Veículo Ilegalmente estacionado">Art. 7.8 - Veículo Ilegalmente estacionado</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 7.11 - Impedir o fluxo do tráfego" type="checkbox" name="crime" value="0|25000|15000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 7.11 - Impedir o fluxo do tráfego">Art. 7.11 - Impedir o fluxo do tráfego</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                            <input class="custom-control-input" id="Art. 7.12 - Colisão Proposital em viatura policial<" type="checkbox" name="crime" value="15|20000|15000" onclick="calcular_pena()">
                            <label class="custom-control-label" for="Art. 7.12 - Colisão Proposital em viatura policial<">Art. 7.12 - Colisão Proposital em viatura policial</label>
                      </div>
              </div>
            </div><!-- Fim Coluna 2 -->
            <div class="col-md-4"> <!-- Inicio Coluna 3 -->
            <label class="form-control-label"><b>PENA / MULTA / FIANÇA</b></label>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label" for="example3cols1Input">Pena</label>
                        <input type="text" class="form-control" id="total_pena" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label" for="example3cols1Input">Multa</label>
                        <input type="text" class="form-control" id="valor_total_multa" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label" for="example3cols1Input">Fiança</label>
                        <input type="text" class="form-control" id="valor_total_fianca" disabled>
                    </div>
                </div>
            </div>
            <label class="form-control-label"><b>DADOS OFICIAIS PRESENTES</b></label>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">1º Oficial</label>
                        <form><select class="form-control primeirooficial" id="primeirooficial" data-toggle="select"></select></form>
                        <small class="aviso_1oficial"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">2º Oficial</label>
                        <form><select class="form-control segundooficial" id="segundooficial" data-toggle="select"></select></form>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">3º Oficial</label>
                        <form><select class="form-control terceirooficial" id="terceirooficial" data-toggle="select"></select></form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">4º Oficial</label>
                        <form><select class="form-control quartooficial" id="quartooficial" data-toggle="select"></select></form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">5º Oficial</label>
                        <form><select class="form-control quintooficial" id="quintooficial" data-toggle="select"></select></form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">6º Oficial</label>
                        <form><select class="form-control sextooficial" id="sextooficial" data-toggle="select"></select></form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">7º Oficial</label>
                        <form><select class="form-control setimooficial" id="setimooficial" data-toggle="select"></select></form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">8º Oficial</label>
                        <form><select class="form-control oitavooficial" id="oitavooficial" data-toggle="select"></select></form>
                    </div>
                </div>
            </div>
            <label class="form-control-label"><b>DADOS DETENTO</b></label>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Nome Detento</label>
                        <input type="text" class="form-control" id="nome_detento">
                        <small class="aviso_nome_detento"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">ID Detento</label>
                        <input type="number" class="form-control" id="id_detento" >
                        <small class="aviso_id_detento"></small>

                    </div>
                </div>
            </div>
            <label class="form-control-label"><b>ITENS APREENDIDOS</b></label>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">Itens</label>
                        <textarea class="form-control" id="itensaprendidos"></textarea>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Dinheiro Sujo</label>
                      <input type="text" class="form-control" id="dinheiro_sujo" oninput="formatarMoeda(this)" value="R$ 0,00">
                        <!-- <input type="text" class="form-control" id="dinheiro_sujo" oninput="formatarMoeda(this)"> -->

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Nome / ID Advogado</label>
                        <input type="text" class="form-control" id="nome_bombeiro">
                        <!-- <input type="text" class="form-control" id="dinheiro_sujo" oninput="formatarMoeda(this)"> -->

                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">Crimes (Artigos Selecionados)</label>
                        <textarea class="form-control" id="artigos_selecionado" ></textarea>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-control-label">Observações / Anotações</label>
                        <textarea class="form-control" id="observacoes_anotacoes" maxlength="250" ></textarea><span class="caracteres">250</span> Caracteres Restantes <br>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="form-control-label"><b>ATENUANTES</b></label>
                    <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="adv_constituido" type="checkbox"onclick="calcular_pena()">
                        <label class="custom-control-label" for="adv_constituido"><b>Advogado constituído</b> - Redução de 20% na pena total.</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="reu_primario" type="checkbox" onclick="calcular_pena()">
                        <label class="custom-control-label" for="reu_primario"><b>Réu primário</b> - Redução de 15% na pena total.</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-1">
                        <input class="custom-control-input" id="reu_confesso" type="checkbox" onclick="calcular_pena()">
                        <label class="custom-control-label" for="reu_confesso"><b>Réu confesso</b> - Redução de 15% na pena total.</label>
                      </div>
                      <small><b>OBS:</b>    <li>Delação premiada fica a Critério do policial.</li><br>
                                            <li>Desacatado é cumulativo até o máximo de 100 meses, de forma subjetiva e fica a caráter do policial, porém a pena base é de 20 meses.</li><br>
                                            <li>Reincidência +10 meses (mesmo crime).</li><br>
                                            <li>A fiança NÃO depende da presença do advogado constituido.</li><br>
                                            <li>Um cúmplice irá ser sentenciado pelos mesmos crimes do réu principal (EXCETO Porte de Armas, Posse de Armas, Tráfico e Infrações de Trânsito).</li><br>
                </div>
            </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="button" class="btn btn-info " onclick="limpar()">Limpar</button>
                            <button type="button" class="btn btn-success btn_salvar">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

            </div> <!-- Fim Coluna 3 -->

</div>

</div>



<?php require('includes/footer_.php'); ?>
<script>
function _0x7e42(){var _0x1a136d=['checked','getElementsByName','Atenção?','I\x20was\x20closed\x20by\x20the\x20timer','trim','id_usuario','click','Erro\x20Exibição\x20-\x20Usuarios','.quintooficial','6DIOVme','location','textContent','9BSOrFY','html','val','select2','684aBhbdM','total_pena','warning','1567089QDDSrb','showLoading','pt-br','nome_detento','DismissReason','done','crime','attr','Fechamento\x20Automatico\x20em\x20<b></b>.','Erro','adv_constituido','.aviso_1oficial','#primeirooficial','.btn_salvar','#quintooficial','R$\x20','#d33','textarea','ceil','.quartooficial','sextooficial','.sextooficial','getHtmlContainer','#quartooficial','isConfirmed','oitavooficial','height','getElementById','height:','ADV\x20->\x20','dados','fast','reu_confesso','valor_total_fianca','#segundooficial','<span\x20class=\x22alert-text\x22><strong>Erro!</strong>\x20Não\x20foi\x20possível\x20conectar!\x20Verifique\x20sua\x20conexão\x20com\x20a\x20internet!</span>','Nome\x20Detento\x20é\x20Obrigatorio!','459615CSUBED','4uUJiMg','length','11mFnBQY','.oitavooficial','log','⚠️\x20-\x20Campo\x20Obrigatorio','primeirooficial','selectedOptions','decimal','nome_bombeiro','Dados\x20enviados!','id_detento','style','replace','.setimooficial','base','.demaisoficial','observacoes_anotacoes','hide','#aviso_nome_detento','33lRoCcS','push','.primeirooficial','timer','fadeOut','getTimerLeft','artigos_selecionado','Selecione','querySelector','ajaxSend','terceirooficial','<option\x20value=\x22','reload','join','fire','nome_usuario','<option>Selecione</option>','POST','32836spdcpG','\x20Meses','Erro\x203','dinheiro_sujo','forEach','ready','split','#overlay','each','success','4508385sQksDD','empty','NÃO\x20USAR','dismiss','quartooficial','#terceirooficial','7105400ugjobW','ajax','Ok,\x20Continuar','then','639664aKDLvz','.caracteres','18365pygcCy','collapse','#setimooficial','mandado','.terceirooficial','.segundooficial','value','#3085d6','setAttribute','itensaprendidos','quintooficial','scrollHeight','BRL','pt-BR','dataset','text','</option>','toLocaleString','valor_total_multa'];_0x7e42=function(){return _0x1a136d;};return _0x7e42();}var _0x5a1d61=_0x54d7;(function(_0x116869,_0xb96053){var _0x478f65=_0x54d7,_0x362bec=_0x116869();while(!![]){try{var _0x877225=-parseInt(_0x478f65(0x26b))/0x1*(-parseInt(_0x478f65(0x1f5))/0x2)+-parseInt(_0x478f65(0x231))/0x3*(-parseInt(_0x478f65(0x257))/0x4)+-parseInt(_0x478f65(0x20b))/0x5*(-parseInt(_0x478f65(0x227))/0x6)+parseInt(_0x478f65(0x1ff))/0x7+parseInt(_0x478f65(0x209))/0x8*(parseInt(_0x478f65(0x22a))/0x9)+-parseInt(_0x478f65(0x205))/0xa*(-parseInt(_0x478f65(0x259))/0xb)+parseInt(_0x478f65(0x22e))/0xc*(-parseInt(_0x478f65(0x256))/0xd);if(_0x877225===_0xb96053)break;else _0x362bec['push'](_0x362bec['shift']());}catch(_0x1f4a02){_0x362bec['push'](_0x362bec['shift']());}}}(_0x7e42,0x76eec),$(document)[_0x5a1d61(0x1fa)](function(){var _0x51ebdf=_0x5a1d61;$(_0x51ebdf(0x267))[_0x51ebdf(0x22d)]();}));function calcular_pena(){var _0x2b06da=_0x5a1d61;const _0xa14d07=document['getElementsByName'](_0x2b06da(0x237));let _0x46fe19=[];_0xa14d07[_0x2b06da(0x1f9)](_0x40b0ec=>{var _0x25044f=_0x2b06da;_0x40b0ec[_0x25044f(0x21e)]&&_0x46fe19[_0x25044f(0x26c)](_0x40b0ec['id']);}),document[_0x2b06da(0x24c)](_0x2b06da(0x271))[_0x2b06da(0x211)]=_0x46fe19[_0x2b06da(0x1f0)]('\x0a');var _0x3c4113=0x0,_0x221414=0x0,_0x1fd1d9=0x0,_0x3c8a02=0x0,_0x25ceaf=0x0,_0x51a569='NÃO\x20USAR',_0x213d02=0x0,_0x2a139b=document[_0x2b06da(0x21f)](_0x2b06da(0x237));for(var _0x283511=0x0;_0x283511<_0x2a139b[_0x2b06da(0x258)];_0x283511++){if(_0x2a139b[_0x283511][_0x2b06da(0x21e)]){var _0x45c310=_0x2a139b[_0x283511]['value'][_0x2b06da(0x1fb)]('|'),_0x373063=_0x2a139b[_0x283511][_0x2b06da(0x219)][_0x2b06da(0x266)];_0x3c4113+=parseInt(_0x45c310[0x0]),_0x221414+=parseInt(_0x45c310[0x1]),_0x1fd1d9+=parseInt(_0x45c310[0x2]),_0x51a569=_0x2b06da(0x201);}}var _0x4904f6=parseInt(document[_0x2b06da(0x24c)](_0x2b06da(0x1f8))[_0x2b06da(0x211)]),_0x2adca6=document['getElementById']('reu_primario'),_0x548f2a=document[_0x2b06da(0x24c)]('reu_confesso'),_0x11f918=document['getElementById'](_0x2b06da(0x20e)),_0x92bfef=document[_0x2b06da(0x24c)](_0x2b06da(0x23b));_0x2adca6['checked']&&(_0x25ceaf=_0x25ceaf+0xf);_0x548f2a[_0x2b06da(0x21e)]&&(_0x25ceaf=_0x25ceaf+0xf);_0x92bfef['checked']&&(_0x25ceaf=_0x25ceaf+0x14);_0x25ceaf>0x46&&(_0x25ceaf=0x46);_0x3c8a02=_0x3c4113*parseInt(_0x25ceaf)/0x64;var _0x5eb210=_0x3c4113-_0x3c8a02,_0x2885dc='';_0x3c4113>0x3e8?_0x92bfef['checked']?(_0x2885dc=0x3e8*0.7,document['getElementById'](_0x2b06da(0x22f))[_0x2b06da(0x211)]=_0x2885dc):document[_0x2b06da(0x24c)](_0x2b06da(0x22f))[_0x2b06da(0x211)]=0x3e8:document[_0x2b06da(0x24c)](_0x2b06da(0x22f))['value']=_0x3c4113-_0x3c8a02;document[_0x2b06da(0x24c)](_0x2b06da(0x21d))['value']=_0x2b06da(0x240)+_0x221414['toLocaleString'](_0x2b06da(0x218),{'minimumFractionDigits':0x2});if(_0x92bfef[_0x2b06da(0x21e)])document[_0x2b06da(0x24c)](_0x2b06da(0x252))[_0x2b06da(0x211)]=_0x2b06da(0x240)+_0x1fd1d9[_0x2b06da(0x21c)]('pt-BR',{'minimumFractionDigits':0x2});else{var _0x357457=_0x1fd1d9*1.3;document[_0x2b06da(0x24c)]('valor_total_fianca')[_0x2b06da(0x211)]=_0x2b06da(0x240)+_0x357457['toLocaleString'](_0x2b06da(0x218),{'minimumFractionDigits':0x2});}}function calcular_pena1(){var _0x20277e=_0x5a1d61,_0x360ae6=0x0,_0x291e62=0x0,_0x250853=0x0,_0x171d5f=_0x20277e(0x201),_0x5a21b1=document['getElementsByName'](_0x20277e(0x237));for(var _0x155d14=0x0;_0x155d14<_0x5a21b1[_0x20277e(0x258)];_0x155d14++){if(_0x5a21b1[_0x155d14]['checked']){var _0x2f669b=_0x5a21b1[_0x155d14][_0x20277e(0x211)][_0x20277e(0x1fb)]('|');_0x360ae6+=parseInt(_0x2f669b[0x0]),_0x291e62+=parseInt(_0x2f669b[0x1]),_0x250853+=parseInt(_0x2f669b[0x2]),_0x171d5f=_0x20277e(0x201);}var _0x386bd9=document['getElementById'](_0x20277e(0x22f));_0x386bd9[_0x20277e(0x211)]=Math[_0x20277e(0x243)](_0x360ae6)+_0x20277e(0x1f6);var _0x342f9f=document[_0x20277e(0x24c)](_0x20277e(0x21d));_0x342f9f[_0x20277e(0x211)]=_0x291e62[_0x20277e(0x21c)](_0x20277e(0x233),{'currencyDisplay':'symbol','style':_0x20277e(0x25f),'currency':_0x20277e(0x217)}),_0x342f9f[_0x20277e(0x211)]='$\x20'+_0x342f9f[_0x20277e(0x211)];var _0x1bde52=document['getElementById'](_0x20277e(0x252));_0x1bde52['value']=_0x250853[_0x20277e(0x21c)](_0x20277e(0x233),{'style':_0x20277e(0x25f),'currency':'BRL'}),_0x1bde52[_0x20277e(0x211)]='$\x20'+_0x1bde52[_0x20277e(0x211)];}}function carrega_usuarios(){var _0x58a441=_0x5a1d61;$[_0x58a441(0x206)]({'type':_0x58a441(0x1f4),'url':'php/funcoes_calculadora.php?tab=calculadora&acao=lista_usuarios','success':function(_0x295129){var _0x46c748=_0x58a441;_0x295129['resp']=='ok'?(html='',dados=_0x295129[_0x46c748(0x24f)],html+=_0x46c748(0x1f3),dados[_0x46c748(0x258)]>0x0&&($[_0x46c748(0x1fd)](dados,function(_0x1f22b2,_0x1408b0){var _0x51027b=_0x46c748;html+=_0x51027b(0x1ee)+_0x1408b0[_0x51027b(0x223)]+'\x22>'+_0x1408b0[_0x51027b(0x1f2)]+_0x51027b(0x21b);}),$(_0x46c748(0x26d))[_0x46c748(0x22b)](html),$(_0x46c748(0x210))[_0x46c748(0x22b)](html),$(_0x46c748(0x20f))[_0x46c748(0x22b)](html),$(_0x46c748(0x244))['html'](html),$(_0x46c748(0x226))[_0x46c748(0x22b)](html),$(_0x46c748(0x246))[_0x46c748(0x22b)](html),$(_0x46c748(0x265))[_0x46c748(0x22b)](html),$(_0x46c748(0x25a))[_0x46c748(0x22b)](html))):console[_0x46c748(0x25b)](_0x46c748(0x225));},'error':function(_0x5ca85c,_0x153772){var _0x12b63f=_0x58a441;$('#alerta_sucesso')['collapse'](_0x12b63f(0x269)),$('#alerta_erro')[_0x12b63f(0x20c)]('show'),$('.alerta_erro')[_0x12b63f(0x22b)](_0x12b63f(0x254));}});}carrega_usuarios(),$(_0x5a1d61(0x242))[_0x5a1d61(0x1fd)](function(){var _0x3e2dc4=_0x5a1d61;this[_0x3e2dc4(0x213)]('style',_0x3e2dc4(0x24d)+this[_0x3e2dc4(0x216)]+'px;overflow-y:hidden;');})['on']('input',function(){var _0x9dc8e5=_0x5a1d61;this[_0x9dc8e5(0x263)][_0x9dc8e5(0x24b)]=0x0,this[_0x9dc8e5(0x263)][_0x9dc8e5(0x24b)]=this[_0x9dc8e5(0x216)]+'px';}),$(_0x5a1d61(0x23e))['on'](_0x5a1d61(0x224),function(){var _0x2fa7e4=_0x5a1d61,_0x326a1f=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x22f))[_0x2fa7e4(0x211)],_0x5d322e=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x21d))[_0x2fa7e4(0x211)],_0x472e02=document[_0x2fa7e4(0x24c)]('valor_total_fianca')['value'],_0x37b983=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x25d))['selectedOptions'][0x0][_0x2fa7e4(0x211)],_0xfea40f=document[_0x2fa7e4(0x24c)]('segundooficial')[_0x2fa7e4(0x25e)][0x0][_0x2fa7e4(0x211)],_0x1e9295=document['getElementById'](_0x2fa7e4(0x1ed))['selectedOptions'][0x0]['value'],_0x43bc16=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x203))['selectedOptions'][0x0]['value'],_0x1edd51=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x215))[_0x2fa7e4(0x25e)][0x0][_0x2fa7e4(0x211)],_0x139e2f=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x245))[_0x2fa7e4(0x25e)][0x0][_0x2fa7e4(0x211)],_0x1e0a30=document[_0x2fa7e4(0x24c)]('setimooficial')[_0x2fa7e4(0x25e)][0x0][_0x2fa7e4(0x211)],_0x2c06a5=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x24a))[_0x2fa7e4(0x25e)][0x0][_0x2fa7e4(0x211)],_0x38526b=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x234))[_0x2fa7e4(0x211)],_0x31f6d8=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x262))[_0x2fa7e4(0x211)],_0xdda613=document['getElementById']('itensaprendidos')[_0x2fa7e4(0x211)],_0x46fe2e=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x271))[_0x2fa7e4(0x211)],_0x366a44=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x1f8))[_0x2fa7e4(0x211)],_0x4356db=document['getElementById'](_0x2fa7e4(0x260))['value'],_0x328a78=document[_0x2fa7e4(0x24c)]('reu_primario'),_0x5e7809=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x251)),_0x36152e=document[_0x2fa7e4(0x24c)](_0x2fa7e4(0x23b)),_0x152b0f=document['getElementById'](_0x2fa7e4(0x268))['value'];console[_0x2fa7e4(0x25b)]('QSV\x20->\x20'+_0x366a44+_0x2fa7e4(0x24e)+_0x4356db+'Observações\x20->\x20'+_0x152b0f);var _0x31f538='',_0x512ebc='',_0x2a5bdd='';_0x36152e[_0x2fa7e4(0x21e)]?_0x31f538=0x1:_0x31f538=0x0;_0x328a78[_0x2fa7e4(0x21e)]?_0x512ebc=0x1:_0x512ebc=0x0;_0x5e7809[_0x2fa7e4(0x21e)]?_0x2a5bdd=0x1:_0x2a5bdd=0x0;if(_0x37b983==_0x2fa7e4(0x1ea)){$(_0x2fa7e4(0x23c))[_0x2fa7e4(0x22b)](_0x2fa7e4(0x25c));return;}$(document)[_0x2fa7e4(0x1ec)](function(){var _0x74694=_0x2fa7e4;$(_0x74694(0x1fc))['fadeIn'](0x12c);});if(!_0x38526b==!![]){let _0x33e73f;Swal[_0x2fa7e4(0x1f1)]({'title':_0x2fa7e4(0x255),'html':'Fechamento\x20Automatico\x20em\x20<b></b>.','timer':0x7d0,'timerProgressBar':!![],'didOpen':()=>{var _0x3ef435=_0x2fa7e4;Swal[_0x3ef435(0x232)]();const _0x5a3997=Swal[_0x3ef435(0x247)]()['querySelector']('b');_0x33e73f=setInterval(()=>{var _0x3f7eef=_0x3ef435;_0x5a3997[_0x3f7eef(0x229)]=Swal[_0x3f7eef(0x270)]();},0x64);},'willClose':()=>{clearInterval(_0x33e73f);}})[_0x2fa7e4(0x208)](_0x5ce648=>{var _0x397c5b=_0x2fa7e4;_0x5ce648[_0x397c5b(0x202)]===Swal[_0x397c5b(0x235)]['timer']&&console['log'](_0x397c5b(0x221));});return;}if(!_0x31f6d8==!![]){let _0x2a9b5d;Swal[_0x2fa7e4(0x1f1)]({'title':'ID\x20Detento\x20é\x20Obrigatorio!','html':_0x2fa7e4(0x239),'timer':0x7d0,'timerProgressBar':!![],'didOpen':()=>{var _0x166b23=_0x2fa7e4;Swal[_0x166b23(0x232)]();const _0x3fe80a=Swal['getHtmlContainer']()[_0x166b23(0x1eb)]('b');_0x2a9b5d=setInterval(()=>{var _0x4fb01f=_0x166b23;_0x3fe80a[_0x4fb01f(0x229)]=Swal[_0x4fb01f(0x270)]();},0x64);},'willClose':()=>{clearInterval(_0x2a9b5d);}})[_0x2fa7e4(0x208)](_0x5a5cbd=>{var _0xa8d1c3=_0x2fa7e4;_0x5a5cbd[_0xa8d1c3(0x202)]===Swal[_0xa8d1c3(0x235)][_0xa8d1c3(0x26e)]&&console['log'](_0xa8d1c3(0x221));});return;}_0x326a1f>0xb4?Swal[_0x2fa7e4(0x1f1)]({'title':_0x2fa7e4(0x220),'text':'Valor\x20da\x20Pena\x20com\x20limite\x20Excedido,\x20Pena\x20Maximo\x20de\x20180\x20Meses','icon':_0x2fa7e4(0x230),'showCancelButton':!![],'confirmButtonColor':_0x2fa7e4(0x212),'cancelButtonColor':_0x2fa7e4(0x241),'confirmButtonText':_0x2fa7e4(0x207)})[_0x2fa7e4(0x208)](_0x5958d4=>{var _0x116816=_0x2fa7e4;_0x5958d4[_0x116816(0x249)]&&$[_0x116816(0x206)]({'type':_0x116816(0x1f4),'beforeSend':function(){var _0x207a05=_0x116816;$(_0x207a05(0x23e))[_0x207a05(0x238)]('disabled',!![]);},'data':{'pena':0xb4,'multa':_0x5d322e,'fianca':_0x472e02,'primeiro_oficial':_0x37b983,'segundo_oficial':_0xfea40f,'terceiro_oficial':_0x1e9295,'quarto_oficial':_0x43bc16,'quinto_oficial':_0x1edd51,'sexto_oficial':_0x139e2f,'setimo_oficial':_0x1e0a30,'oitavo_oficial':_0x2c06a5,'nome_detento':_0x38526b,'id_detento':_0x31f6d8,'itens_apreendidos':_0xdda613,'itens_apreendidos':_0xdda613,'qsj':_0x366a44,'artigos':_0x46fe2e,'check_adv':_0x31f538,'reu_primario':_0x512ebc,'reu_confesso':_0x2a5bdd,'bombeiro':_0x4356db,'obs':_0x152b0f},'url':'php/banco_calculadora.php?tab=calculadora&acao=envia_registro','success':function(_0x40c5eb){var _0x5a6a53=_0x116816,_0x421244=_0x40c5eb[_0x5a6a53(0x222)]();if(_0x421244=='ok'){let _0x8cacd;Swal[_0x5a6a53(0x1f1)]({'icon':_0x5a6a53(0x1fe),'title':'Dados\x20enviados!','showConfirmButton':![],'timer':0x5dc}),setTimeout(function(){var _0xed2d67=_0x5a6a53;window[_0xed2d67(0x228)][_0xed2d67(0x1ef)](!![]);},0x9c4);}else console['log']('Erro\x203');},'error':function(_0x201c43,_0x3c2389){var _0x412d4d=_0x116816;console[_0x412d4d(0x25b)](_0x412d4d(0x23a));}});}):$[_0x2fa7e4(0x206)]({'type':'POST','data':{'pena':_0x326a1f,'multa':_0x5d322e,'fianca':_0x472e02,'primeiro_oficial':_0x37b983,'segundo_oficial':_0xfea40f,'terceiro_oficial':_0x1e9295,'quarto_oficial':_0x43bc16,'quinto_oficial':_0x1edd51,'sexto_oficial':_0x139e2f,'setimo_oficial':_0x1e0a30,'oitavo_oficial':_0x2c06a5,'nome_detento':_0x38526b,'id_detento':_0x31f6d8,'itens_apreendidos':_0xdda613,'itens_apreendidos':_0xdda613,'qsj':_0x366a44,'artigos':_0x46fe2e,'check_adv':_0x31f538,'reu_primario':_0x512ebc,'reu_confesso':_0x2a5bdd,'bombeiro':_0x4356db,'obs':_0x152b0f},'url':'php/banco_calculadora.php?tab=calculadora&acao=envia_registro','success':function(_0xcbe8ad){var _0x2203b4=_0x2fa7e4,_0x1ab9ec=_0xcbe8ad['trim']();_0x1ab9ec=='ok'?(Swal[_0x2203b4(0x1f1)]({'icon':'success','title':_0x2203b4(0x261),'showConfirmButton':![],'timer':0x5dc}),setTimeout(function(){var _0x38b7ec=_0x2203b4;window[_0x38b7ec(0x228)][_0x38b7ec(0x1ef)](!![]);},0x9c4)):console[_0x2203b4(0x25b)](_0x2203b4(0x1f7));},'error':function(_0x19ac59,_0x43e685){var _0x4451b9=_0x2fa7e4;console['log'](_0x4451b9(0x23a));}})[_0x2fa7e4(0x236)](function(){setTimeout(function(){var _0x501758=_0x54d7;$(_0x501758(0x1fc))[_0x501758(0x26f)](0x12c);},0x1f4);});}),setTimeout(function(){var _0xe9511d=_0x5a1d61;$(_0xe9511d(0x26a))[_0xe9511d(0x26f)](_0xe9511d(0x250));},0x3e8);function limpar(){var _0x51663e=_0x5a1d61,_0x12d3e4=document[_0x51663e(0x21f)]('crime');for(var _0x68016d=0x0;_0x68016d<_0x12d3e4[_0x51663e(0x258)];_0x68016d++){_0x12d3e4[_0x68016d]['checked']=![];}document[_0x51663e(0x24c)]('reu_primario')[_0x51663e(0x21e)]=![],document[_0x51663e(0x24c)](_0x51663e(0x251))[_0x51663e(0x21e)]=![],document['getElementById'](_0x51663e(0x23b))[_0x51663e(0x21e)]=![],document[_0x51663e(0x24c)](_0x51663e(0x22f))[_0x51663e(0x211)]='0',document[_0x51663e(0x24c)](_0x51663e(0x21d))[_0x51663e(0x211)]='0',document['getElementById'](_0x51663e(0x252))['value']='0',document[_0x51663e(0x24c)]('dinheiro_sujo')[_0x51663e(0x211)]='0',document[_0x51663e(0x24c)](_0x51663e(0x234))['value']='',document[_0x51663e(0x24c)](_0x51663e(0x262))['value']='',document[_0x51663e(0x24c)](_0x51663e(0x214))[_0x51663e(0x211)]='',document['getElementById'](_0x51663e(0x271))[_0x51663e(0x211)]='',document[_0x51663e(0x24c)](_0x51663e(0x260))[_0x51663e(0x211)]='',document[_0x51663e(0x24c)](_0x51663e(0x268))[_0x51663e(0x211)]='',$(_0x51663e(0x23d))[_0x51663e(0x200)](),$(_0x51663e(0x253))[_0x51663e(0x200)](),$(_0x51663e(0x204))[_0x51663e(0x200)](),$(_0x51663e(0x248))['empty'](),$(_0x51663e(0x23f))[_0x51663e(0x200)](),$('#sextooficial')[_0x51663e(0x200)](),$(_0x51663e(0x20d))[_0x51663e(0x200)](),$('#oitavooficial')[_0x51663e(0x200)](),carrega_usuarios();}function _0x54d7(_0x36f7bc,_0x2901b9){var _0x7e4230=_0x7e42();return _0x54d7=function(_0x54d77e,_0x57171e){_0x54d77e=_0x54d77e-0x1ea;var _0x45eae1=_0x7e4230[_0x54d77e];return _0x45eae1;},_0x54d7(_0x36f7bc,_0x2901b9);}function formatarMoeda(_0x565c1d){var _0x3a6b9b=_0x5a1d61;let _0x413681=_0x565c1d[_0x3a6b9b(0x211)];_0x413681=_0x413681[_0x3a6b9b(0x264)](/[^\d]/g,''),_0x413681=(Number(_0x413681)/0x64)['toLocaleString'](_0x3a6b9b(0x218),{'style':'currency','currency':_0x3a6b9b(0x217)}),_0x565c1d[_0x3a6b9b(0x211)]=_0x413681;}$(document)['on']('keydown','#observacoes_anotacoes',function(){var _0x5157c0=_0x5a1d61,_0x1de134=0xfa,_0x2db34a=parseInt($(this)[_0x5157c0(0x22c)]()[_0x5157c0(0x258)]),_0x1de134=_0x1de134-_0x2db34a;$(_0x5157c0(0x20a))[_0x5157c0(0x21a)](_0x1de134);}); 
</script>