<?php


try {
    
	
	$db = new PDO('mysql:host=localhost;dbname=imasters', 'root', '');	
	$stmt = $db->prepare("SELECT hora, tipo FROM hr_parada order by id ASC");		
	
	/*
	CREATE TABLE paradas(
		 id INT(8) 		PRIMARY KEY AUTO_INCREMENT
		,hr_ini			DATETIME	
		,hr_term		DATETIME	
	);
	*/
	
	$stmt->execute();
	$horas  = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	
	$ultima_acao = '';
	$hrs = array();
	foreach($horas as $row){
		
		if($ultima_acao == '' || $ultima_acao != $row['tipo']){
			$hrs[] = $row['hora'];
		}
		
		$ultima_acao = $row['tipo'];
	}
	
	
	
	$horas = array();	
	foreach($hrs as $hr){		
		$horas[] = array(
			'hora' => $hr
		);
	}
	
	
	$hrsLength = count($horas);	
	
	$x = 0;
	for($i = 0; $i < $hrsLength; $i++){
		
		$proximo = '';
		if($i != ($hrsLength - 1)){
			$nextKey = $i + 1;
			$proximo = $horas[$nextKey]['hora'];
		}
		$atual = $horas[$i]['hora'];
		
		if($x % 2 == 0 && $proximo != ''){
			$sqls[] = "INSERT INTO paradas(hr_ini, hr_term) VALUES ('{$atual}', '{$proximo}');";
		}
		$x++;
	}
	print_r($sqls);
	
	
	
	
	//var_dump($datas);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}