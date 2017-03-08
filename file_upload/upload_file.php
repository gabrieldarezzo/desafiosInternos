<?php


set_time_limit(0);
ini_set('post_max_size','2GB');
ini_set('upload_max_filesize','2GB');
ini_set('max_input_time', 0);

// var_dump(!isset($_FILES['arquivo']));
// var_dump(!isset($_FILES['arquivo']['name']));
// var_dump(count($_FILES['arquivo']['name']) == 0);

/*
if(!isset($_FILES['arquivo']) || !isset($_FILES['arquivo']['name']) || count($_FILES['arquivo']['name']) == 0){
	die('Nenhum arquivo selecionado' . '<a href="index.html">Voltar</a>');	
}
*/



for($i = 0; $i < count($_FILES['arquivo']['name']); $i++){
	
	if ($_FILES['arquivo']['error'][$i] == UPLOAD_ERR_OK) {		
		$name 		 = $_FILES['arquivo']['name'][$i];
		$tmp_name 	 = $_FILES['arquivo']['tmp_name'][$i];
		move_uploaded_file($tmp_name, "uploads/{$name}");
	}
}
	
