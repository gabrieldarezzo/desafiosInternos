Panela eu tenho um formulário, na hora que selecionar o estado aparece as cidades do mesmo usando "select" em 
HTML eu fiz os select só que não sei como ficaria os script pra isso, alguém pode ajudar?


```html
<p>UF:</p>
<select name="uf" id="uf">
     <option value="">Selecione UF</option>
     <option value="SP">São Paulo</option>
     <option value="RJ">Rio de Janeiro</option>
     <option value="MS">Mato Grosso do Sul</option>
</select>
<!--Caso selecione SP por exemplo aparece as Cidades Dynamics!....-->
<p>Cidades:</p>
<select name="cidades" id="cidades">
     <option value="">Selecione a Cidade</option>
     <option value="3">São Paulo (Capital)</option>
     <option value="2">Sorocaba</option>     
</select><hr />
```

Resposta (JS-Vanilla):
https://github.com/gabrieldarezzo/desafiosInternos/blob/master/select/index.html

Live Demo (JS-Vanilla):
http://gabrieldarezzo.github.io/desafiosInternos/select/index.html

(New - Jquery)

Resposta (jQuery):
https://github.com/gabrieldarezzo/desafiosInternos/blob/master/select/jquery.html

Live Demo (jQuery):
http://gabrieldarezzo.github.io/desafiosInternos/select/jquery.html