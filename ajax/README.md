Guia definitivo AJAX

A galera do forum.imasters http://forum.imasters.com.br/ vive perguntando sobre como fazer o bendito Ajax...

Então pensei em fazer uma especie de Tutorial para ajudar a galera que está começando


Dividi em varias etapas para ficar mais facil de pegar os conceitos.

1 - Capturar evento Click do JavaScript pelo jQuery
	O JavaScript é uma linguagem orientada a eventos, então precisamos monitorar o mesmo para ativar o Ajax.
	Seria interessante você ter uma familiariadade com Evento do JS...
	Ex: Usuario clicou elemento 'X'...
	Ex²: Usuario pressionou a tecla enquanto estava com o foco no elemento 'Y'...
	Ex²: Usuario passou o mouse em cima do elemento 'K'...
	Acho q de pra pegar...
	Tudo isso pode ser monitorado(Listener) e assim possibilitando uma ação...

2 - Modificar um campo texto a partir do evento Click
	Antes de pensar em Ajax, você precisa saber alterar os elemetos e seus atributos (value, text é um atributo (u.u))
	Então outro exemplo bem basico caso você não manja alterar....
	Uma dica bacana é fazer o curso interativo de jQuery da CodeSchool, você vai entender bem melhor esse lance de Seletores, DOM, Elements, Node, Childs, Parent, etc, etc, etc....
	http://try.jquery.com/
	


3 - Exemplo basico de Ajax



4 - Misturar o exemplo completo







Exemplo: 

```html
<table>
  <tr>
    <td>QTD</td>
    <td>VALOR UNITARIO</td>
    <td>SUB TOTAL</td>
  </tr>
  <tr>
    <td><input type="text" name="qtd[]"/></td>
    <td><input type="text" name="valorunitario[]" /></td>
    <td><input type="text" name="valorsubtotal[]" /></td>
  </tr>
  <tr>
    <td><input type="text" name="qtd[]" /></td>
    <td><input type="text" name="valorunitario[]" /></td>
    <td><input type="text" name="valorsubtotal[]" /></td>
  </tr>
  <tr>
    <td><input type="text" name="qtd[]" /></td>
    <td><input type="text" name="valorunitario[]" /></td>
    <td><input type="text" name="valorsubtotal[]" /></td>
  </tr>
</table>
```


Resposta:
https://github.com/gabrieldarezzo/desafiosInternos/blob/master/table/index.html
