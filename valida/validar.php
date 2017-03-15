<?php

//header ('Content-type: application/json; charset=UTF-8');
/*
DROP DATABASE IF EXISTS imasters;
CREATE DATABASE imasters;
use imasters;

CREATE TABLE usuario(
	 id            int(8) primary key auto_increment
	,nome_completo varchar(50) not null
	,email         varchar(250) not null
	,senha         varchar(100) not null
	,token         CHAR(32)
	,criado_em     DATETIME
);

*/

function getConnection() {
	try {
			
		if(strpos($_SERVER['SERVER_NAME'], 'localhost') !== false || $_SERVER['SERVER_NAME']=='127.0.0.1' || strpos($_SERVER['SERVER_NAME'], '192') !== false){
			$db = new PDO('mysql:host=localhost;dbname=imasters', 'root', '');	
			
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
			$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
			//$db->exec("set names utf8"); //Garante UTF em versão < 5.3
			return $db;
			
		} else {
			//Prod Ambiente, assim pode commitar sem medo xD
			require 'prod_conf.php';
			
			
			$db = new PDO($string_prod, $user_prod, $pass_prod);	
			
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
			$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
			//$db->exec("set names utf8"); //Garante UTF em versão < 5.3
			return $db;


		}
		
	} catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}
}

try {		 
	
	if(!isset($_POST)){
		throw new Exception('not_send');
	}
	
	function valida_nome_completo($nome_completo = ''){
		if($nome_completo == ''){
			throw new Exception('nome_completo||Preencha o nome completo');
		}
		
		if(strlen($nome_completo) < 8){
			throw new Exception('nome_completo||O Nome deve ter ao menos 8 caracteres');
		}
	}
	
	
	//Valida Email, MX, e UNICIDADE na base
	function valida_email($email = ''){
		if($email == ''){
			throw new Exception('email||Preencha um email válido');
		}
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			//return false;
			throw new Exception('email||Preencha um email válido (1)');
		}
		
		$domain = explode('@', $email);
		if(!(checkdnsrr($domain[1],"MX") || checkdnsrr($domain[1], "A"))){
			//return false;
			throw new Exception('email||Preencha um email com dominio válido');
		}
		
		//Verifica se já existe ao menos 1		
		$db = getConnection();

		$sql = "
		SELECT 
			* 
		FROM 
			usuario 
		WHERE 
			email = :email
		";
		
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);       
		$stmt->execute();
		$usuario = $stmt->fetch(PDO::FETCH_OBJ);
		if($usuario){
			throw new Exception('email||E-mail já cadastrado');
		}
	}
	
	
	function valida_senha($senha = ''){
		
		if($senha == ''){
			throw new Exception('senha||A senha é obrigatória');
		}
		
		if(strlen($senha) < 6){
			throw new Exception('senha||O senha deve ter ao menos 6 caracteres');
		}
	}
	
	
	function valida_termos_aceite($termos_aceite = ''){
		
		if($termos_aceite == ''){
			throw new Exception('termos_aceite||O termo é obrigatório');
		}
	}
	
	//Validação de CAMPO individual	
	if(isset($_POST['validar_individual'])){
		foreach($_POST as $namePost => $value){
			
			if($namePost != 'validar_individual'){
				$funcValida = 'valida_' . $namePost;				
				$funcValida($value);
			}
		}
		
		print json_encode(array('status' => true));
		die();
	}
	
	//Validação de todos os campos (submit do form)
	
	valida_nome_completo($_POST['nome_completo']);
	valida_email($_POST['email']);
	valida_senha($_POST['email']);
	
	//Pensar em como usar a mesma função...
	if(!isset($_POST['termos_aceite'])){
		throw new Exception('termos_aceite||O termo é obrigatório');
	}
	
	//Fim das validações, INSERT TIME!
	
	
	$db = getConnection();
	
	
	$sql = "
	INSERT INTO usuario 
		(nome_completo, email, senha, token, criado_em)
	VALUES 
		(:nome_completo, :email, :senha, :token, NOW())
	";
	
	$token = bin2hex(openssl_random_pseudo_bytes(16));
	
	$stmt = $db->prepare($sql);                                  
	$stmt->bindParam(':nome_completo', $_POST['nome_completo'], PDO::PARAM_STR);
	$stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
	$stmt->bindParam(':senha', $_POST['senha'], PDO::PARAM_STR);
	$stmt->bindParam(':token', $token, PDO::PARAM_STR);

	if($stmt->execute()){
		print json_encode(array('status' => true));		
		die();
	} else {
		print json_encode(array('status' => false));
		die();
	}
	
	
	//Chegou até aqui da um echo/true
	//print json_encode(array('status' => true));
	
} catch(Exception $ex){
	print json_encode(
		array(
			 'status' 	=> false
			,'message' 		=> $ex->getMessage()
		));
	die();
}
