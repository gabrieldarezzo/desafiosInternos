<?php

// print_r($_POST);
try{
	if(!isset($_POST['nome']) || $_POST['nome'] == ''){
		throw new Exception("Informe um nome");
	}
	
	if(!isset($_POST['email']) || $_POST['email'] == ''){
		throw new Exception("Informe um E-mail");
	}
	
	
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		throw new Exception("O e-mail precisa ser valido.");
	}
	
	print json_encode(
	array(
		 'status' 	=> true
		,'msg' 		=> 'E-mail cadastrado'
	));

} catch(Exception $ex){
	print json_encode(
		array(
			 'status' 	=> false
			,'msg' 		=> $ex->getMessage()
		));
	die();
}