<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=imasters', 'root', '');	
	
	if(!isset($_POST) || count($_POST) == 0){
		die('Nenhum E-mail');
	}
	
	$emails_validos = array();
	foreach($_POST['m'] as $email){
		//Validação de e-mail bla bla bla
		$emails_validos[] =  "('" . $email . "')" ;
	}
	
	$sql = "INSERT INTO emails (email) VALUES ". implode(',',  $emails_validos ) .";";
	$stmt = $db->prepare($sql);                                  
	
	if($stmt->execute()){
		print 'SUCCESS';
		die();
	} else {
		print 'FAIL';
		die();
	}


} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}