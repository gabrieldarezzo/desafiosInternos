# Guia definitivo AJAX  

A galera do [http://forum.imasters.com.br/](http://forum.imasters.com.br/) vive perguntando sobre como fazer o bendito Ajax/Pagina sem refresh, pegar coisas do servidor* pelo JavaScript...
(( servidor* = Php, Java, NodeJs, C#, FireBase, Etc, etc etc.... ))

Então pensei em fazer uma espécie de Tutorial para ajudar quem está começando...

Muito se fala de S.P.A... mas e ai? ...
Tu manja dos **XMLHttpRequest**?!

A Divisão deste guia está em etapas para ficar mais fácil de pegar os conceitos.

### 1 - Capturar evento Click do JavaScript pelo jQuery
	
JavaScript é uma linguagem orientada a eventos, então precisamos monitorar o mesmo para ativar o Ajax.  
Seria interessante você ter uma familiaridade com Evento do JS...  
-- Ex: Usuário clicou elemento 'X'...  
-- Ex²: Usuário pressionou a tecla enquanto estava com o foco no elemento 'Y'...  
-- Ex²: Usuário passou o mouse em cima do elemento 'K'...  
	 
-- Tudo isso pode ser monitorado com Listeners e assim possibilitando uma ação a partir dele:
```html
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Ajax Exemplo com Ajax</title>
	
</head>
<body>

	<!-- Botão que vamos monitorar a partir do seu atributo id (id="btn-action") -->
	<button id="btn-action">Click-me</button>
	
	<!-- jQuery cdn -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	
	<!-- Abrimos o bloco de JavaScript logo após a chamada do script de jQuery-->
	<script type="text/javascript">
		
		/*O codigo abaixo garante que o jQuery está pronto para ser executado.*/
		$(document).ready(function() {
		
			//Aqui monitoramos pelo seletor '$( "#btn-action" )' o evento 'click', assim que o evento ocorrer a function() é chamada...
			$( "#btn-action" ).bind( "click", function() {
				alert(1);
			});
		
		});
	</script>
</body>
</html>
```
(Live Show)
http://gabrieldarezzo.github.io/desafiosInternos/ajax/click.html



### 2 - Modificar um campo texto a partir do evento Click  
Antes de pensar em Ajax, você precisa saber alterar os elementos e seus atributos (value, text é um atributo (u.u)).  
Então outro exemplo bem básico caso você não manja alterar.  
Uma dica bacana é fazer o curso interativo de jQuery da [CodeSchool](http://try.jquery.com/) (É gratuito seu mão de vaca), você vai entender bem melhor esse lance de Seletores, DOM, Elements, Node, Childs, Parent, etc, etc, etc....  

```html
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Ajax Exemplo com Ajax</title>
	
</head>
<body>

	<!-- Campo que vamos alterar -->
	<input type="text" name="textao_do_feice" id="textao_do_feice" value="aqui é o texto antigo..."/>
	
	<!-- Nosso botãozinho maroto que dispara a ação -->
	<button id="btn-action">Mudar - Texto</button>
	
	
	<!-- jQuery cdn -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		
		$(document).ready(function() {		
			$( "#btn-action" ).bind( "click", function() {
			
				//Seletor -> '$( "#textao_do_feice" )'
				//Seletor -> Tudo passado dentro do val({DENTRO_DO_VAL}) é inserido dentro do atributo value....
				//Caso não entendeu clica no botão 'Mudar - Texto' que você entende ....
				$( "#textao_do_feice" ).val('O texto novo é esse...');
			});		
		});
	</script>
</body>
</html>
```
(Live Show)
http://gabrieldarezzo.github.io/desafiosInternos/ajax/trocar-texto.html

## 3 - Exemplo básico de Ajax (Pegar um arquivo.txt e exibir o conteúdo sem efetuar o refresh da pagina)  
Basicamente aproveitamos o exemplo anterior que monitora o botão, e ao disparar a ação efetuamos uma requisição Ajax.  
(file: 'arquivo.txt'):  
```Olha que lekal veio de uma pagina externa sem efetuar o Refresh...```  
(file: 'trocar-texto.html'):	  
```html
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Ajax Exemplo com TOP</title>
	
</head>
<body>
	<input type="text" name="textao_do_feice" id="textao_do_feice" value="aqui é o texto antigo..."/>
	<hr />
	<button id="btn-action">Ajax, Test!</button>
	
	
	
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		
			$( "#btn-action" ).bind( "click", function() {
				$.ajax({
					 url: 'arquivo.txt'
					,type:'GET'
					,dataType: 'html'
					,success: function(resposta){
						$( "#textao_do_feice" ).val(resposta);
						//return true;
					}
					,error: function(json){
						console.log(json);
					}
				});
			});
		});
	</script>
</body>
</html>
```
(Live Show)
http://gabrieldarezzo.github.io/desafiosInternos/ajax/ajax.html

## 4 - Enviar dados do Formulário via POST 
Exemplo de como enviar um POST a partir de uma div dinâmica serialize()
```html
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Ajax with POST</title>
	
</head>
<body>
	
	
	<div id="js-newsletter">
		<h1>Cadastre seu E-mail para Newsletter (Classico não ?!)</h1>
		<p>Nome</p>
		<input type="text" name="nome" />

		<p>E-mail</p>
		<!-- Input correto neh.. pelo amor -->
		<input type="email" name="email" />
		
		<button id="btn-action">Cadastrar</button>
		
	</div>
	
	
	
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		
			$( "#btn-action" ).bind( "click", function() {
				//Validação Server Side Pra que?!
				//if == null... return false e talz
			
				$.ajax({
					 url: 'cadastrar.php' //Um Classico php xD					 
					//Repare que por nenhum momento epecifiquei os parametros que precisam ser enviados..
					//apenas dei um serialize dentro de uma div que contem todos os campos
					,data: $('#js-newsletter *').serialize()
					,type:'POST'
					,dataType: 'json'
					,success: function(json){
						
						if(!json.status){
							alert(json.msg);
							return false;
						}

						//Chegou até aqui, significa que pode dar o parabens...
						alert('Cadastro efetuado');
						
						return true;
					}
					,error: function(json){
						console.log(json);
					}
				});
			});
		});
	</script>
</body>
</html>
```  

(file: 'cadastrar.php'):  
```php
<?php
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
```




## 5 - Acompanhar oq foi enviado...
-- As vezes o problema é na requisição...  
-- As vezes o problema é na resposta (back-end)  
-- As vezes você nem sabe onde caralhos o problema está....  
Entenda como monitorar a requisição, acompanhando  o que foi enviado **(GET/POST/HEADER)** e o que foi respondido (Response)..  
Exemplo Abaixo pratico:  
![Fluxo de Debbug](https://gabrieldarezzo.github.io/imasters/img/ajax_fluxo.png)  


## 6 (Bonus) 
-- Exemplo pratico de Ajax.... (Pegar o CEP):  
Live Code:  
http://gabrieldarezzo.github.io/busca_cep/  
  
Code:  
https://github.com/gabrieldarezzo/gabrieldarezzo.github.io/blob/master/busca_cep/index.html  



	
Mais motivos para utilizar o Chrome:  
https://www.youtube.com/playlist?list=PLOU2XLYxmsILUKyjDYUVYLeq7yyTxM_3d