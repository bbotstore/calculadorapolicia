<?php
	try {
		$con = new PDO("mysql:host=localhost;dbname=policia_db","policia","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	} catch(PDOException $e) {
		echo "Erro!: " . $e->getMessage() . "<br/>";
	}		

?>