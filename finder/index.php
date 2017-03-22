<?php

$arquivos = glob('arquivos/*.txt');

$pasta  = 'arquivos/';

$palavra_procurar = 'beraldo';

foreach($arquivos as $arquivo){
	
	$tem_palavra = false;
	
	$handle = @fopen($arquivo, "r");
	if ($handle) {
		while (($buffer = fgets($handle, 4096)) !== false) {
			
			//echo $buffer;
			
			if (strpos($buffer, $palavra_procurar) !== false) {
				$tem_palavra = true;
				
			} 
		}
		if (!feof($handle)) {
			echo "Error: unexpected fgets() fail\n";
		}
		fclose($handle);
	}
	
	
	if($tem_palavra){
		//Se entrou aqui o $arquivo do loop atual tem a palavra...
		print $arquivo . '<br />';
		
		
	}
}



