<?php
	try {
		$con = new PDO("mysql:host=br.redhosting.com.br;port=3306;dbname=s687_policia_db", "u687_kUMtwZFdaj", "dNf.jFXys!xqeXuy.by6b8.7", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	} catch(PDOException $e) {
		echo "Erro!: " . $e->getMessage() . "<br/>";
	}		
?>
