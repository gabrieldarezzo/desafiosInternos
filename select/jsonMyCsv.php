<?php

$row = 1;

//cidades.csv
//Retirado do Wiki -> https://pt.wikipedia.org/wiki/Lista_alfab%C3%A9tica_dos_munic%C3%ADpios_de_S%C3%A3o_Paulo


$cidades = array();
if (($handle = fopen("cidades.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$cidades[] = trim($data[0]);//Equivalente ao .push() ou $cidades[$cidades.length]
	}
	fclose ($handle);
}
//var_dump($cidades);


//print json_encode($cidades);
$fp = fopen('cidades_sp.json', 'w+');
fwrite($fp, json_encode($cidades, JSON_UNESCAPED_UNICODE)); // JSON_UNESCAPED_UNICODE -> Evita de salvar daquela forma maluca 'ã' -> '\u00e3'
fclose($fp);