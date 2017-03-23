https://forum.imasters.com.br/topic/557082-busca-por-intervalos-de-tempos/


TL;DR:
Tabela com apenas um registro de tempo, e agora precisa fazer as comparações....

   

Olha a estrutura q louco:
```sql
CREATE TABLE hr_parada(
	 id		INT(8) PRIMARY KEY AUTO_INCREMENT
	,hora	DATETIME	
	,tipo	VARCHAR(50)
);

INSERT INTO hr_parada(hora, tipo) VALUES 
	 ('2017-03-22 10:00:01', 'PARADO')
	,('2017-03-22 10:00:50', 'MOVIMENTO')	
	,('2017-03-22 10:02:01', 'PARADO')
	,('2017-03-22 10:03:45', 'PARADO')	
	,('2017-03-22 10:05:27', 'MOVIMENTO')
	,('2017-03-22 10:07:01', 'MOVIMENTO')
	,('2017-03-22 10:10:33', 'PARADO')
	,('2017-03-22 10:12:33', 'PARADO')
	,('2017-03-22 10:15:10', 'MOVIMENTO')
	,('2017-03-22 10:17:01', 'PARADO')
;
```
Com meus humildes conhecimentos em SQL não encontrei a solução....

Mas assim como o MasterCard pra tudo na vida existe uma linguagem de programação O.P. para ajudar....



Original:  
```

10:00:01	PARADO
10:00:50	MOVIMENTO
10:02:01	PARADO
10:03:45	PARADO
10:05:27	MOVIMENTO
10:07:01	MOVIMENTO
10:10:33	PARADO
10:12:33	PARADO
10:15:10	MOVIMENTO
10:17:01	PARADO
```

Basicamente no altorimo tiro as duplicidades.  
E calculo a diferença de tempo.


Ficando algo +/- assim:  
```
10:00:01	PARADO    (00:00:49)
10:00:50	MOVIMENTO 

10:02:01	PARADO    (00:03:26)
10:05:27	MOVIMENTO

10:10:33	PARADO    (00:04:37)
10:15:10	MOVIMENTO

10:17:01	PARADO
```


SQLs:

```sql
INSERT INTO paradas(hr_ini, hr_term) VALUES ('2017-03-22 10:00:01', '2017-03-22 10:00:50');
INSERT INTO paradas(hr_ini, hr_term) VALUES ('2017-03-22 10:02:01', '2017-03-22 10:05:27');
INSERT INTO paradas(hr_ini, hr_term) VALUES ('2017-03-22 10:10:33', '2017-03-22 10:15:10');

;
SELECT 
	 hr_ini  
	,hr_term
	,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hr_ini, hr_term)) AS tempo_parada
FROM paradas
```

----

```
hr_ini               hr_term              tempo_parada  
-------------------  -------------------  --------------
2017-03-22 10:00:01  2017-03-22 10:00:50  00:00:49      
2017-03-22 10:02:01  2017-03-22 10:05:27  00:03:26      
2017-03-22 10:10:33  2017-03-22 10:15:10  00:04:37      
```


