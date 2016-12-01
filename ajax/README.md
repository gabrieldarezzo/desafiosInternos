# Guia definitivo AJAX  

A galera do [http://forum.imasters.com.br/](http://forum.imasters.com.br/) vive perguntando sobre como fazer o bendito Ajax/Pagina sem refresh, pegar coisas do servidor* pelo JavaScript...
(( servidor* = Php, Java, NodeJs, C#, FireBase, Etc, etc etc.... ))

Então pensei em fazer uma espécie de Tutorial para ajudar quem está começando...

Muito se fala de S.P.A... mas e ai? tu manja dos **XMLHttpRequest**?!

A Divisão deste guia está em etapas para ficar mais fácil de pegar os conceitos.

### 1 - Capturar evento Click do JavaScript pelo jQuery
	
JavaScript é uma linguagem orientada a eventos, então precisamos monitorar o mesmo para ativar o Ajax.  
Seria interessante você ter uma familiaridade com Evento do JS...
-- Ex: Usuário clicou elemento 'X'...
-- Ex²: Usuário pressionou a tecla enquanto estava com o foco no elemento 'Y'...
-- Ex²: Usuário passou o mouse em cima do elemento 'K'...
	 
-- Tudo isso pode ser monitorado com Listeners e assim possibilitando uma ação a partir dele...

### 2 - Modificar um campo texto a partir do evento Click
Antes de pensar em Ajax, você precisa saber alterar os elementos e seus atributos (value, text é um atributo (u.u)).
Então outro exemplo bem básico caso você não manja alterar.
Uma dica bacana é fazer o curso interativo de jQuery da  [CodeSchool](http://try.jquery.com/), você vai entender bem melhor esse lance de Seletores, DOM, Elements, Node, Childs, Parent, etc, etc, etc....

## 3 - Exemplo básico de Ajax (Pegar um arquivo.txt e exibir o conteúdo sem efetuar o refresh da pagina)
Basicamente aproveitamos o exemplo anterior que monitora o botão, e ao disparar a ação efetuamos uma requisição Ajax.
	
## 4 - Enviar dados do Formulário via POST 
Exemplo de como enviar um POST a partir de uma div dinâmica serialize()
	
## 5 - Enviar dados do Formulário via POST


## 6 - Acompanhar oq foi enviado...
-- As vezes o problema é na requisição...
-- As vezes o problema é na resposta (back-end)
-- As vezes você nem sabe onde caralhos o problema está....
Entenda como monitorar a requisição, acompanhando  o que foi enviado **(GET/POST/HEADER)** e o que foi respondido (Response)..
Exemplo Abaixo pratico:
	![Fluxo de Debbug](https://gabrieldarezzo.github.io/imasters/img/ajax_fluxo.png)
	
Mais motivos para utilizar o Chrome:
https://www.youtube.com/playlist?list=PLOU2XLYxmsILUKyjDYUVYLeq7yyTxM_3d