https://forum.imasters.com.br/topic/557082-busca-por-intervalos-de-tempos/


TL;DR:
Tabela com apenas um registro de tempo, e agora precisa fazer as comparações....


Duvida na integra:                                     
------------------ 
10:00:01	PARADO    (00:00:49)
10:00:50	MOVIMENTO 

10:02:01	PARADO    (00:03:26)
10:05:27	MOVIMENTO

10:10:33	PARADO    (00:04:37)
10:15:10	MOVIMENTO

10:17:01	PARADO






10:00:01	PARADO 		00:01 ~ 00:50 = 00:49
10:00:50	MOVIMENTO	

10:03:45	PARADO      02:01 ~ 05:27 = 03:26                                                                   
10:07:01	MOVIMENTO                                  

10:12:33	PARADO      10:33 ~ 15:10 = 04:37                                                                         
10:15:10	MOVIMENTO                                  



hr_ini               hr_term              
-------------------  -------------------  
2017-03-22 10:00:01  2017-03-22 10:00:50  
2017-03-22 10:02:01  2017-03-22 10:05:27  
2017-03-22 10:10:33  2017-03-22 10:15:10  



                                   
                                                       
Precisaria fazer uma consulta entre "10:00:01" e  "10:17:01" e mostrar os tempos de cada parada.  
no caso acima deveria retornar:  
 
00:00:49  
00:01:44  
00:02:00  
   
   

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

Basicamente no altorimo tiro as duplicidades.
E calculo a diferença de tempo.


Ficando algo +/- assim:

Duvida na integra:                                     
------------------ 
10:00:01	PARADO    (00:00:49)
10:00:50	MOVIMENTO 

10:02:01	PARADO    (00:03:26)
10:05:27	MOVIMENTO

10:10:33	PARADO    (00:04:37)
10:15:10	MOVIMENTO

10:17:01	PARADO
-----
SQLs:

INSERT INTO paradas(hr_ini, hr_term) VALUES ('2017-03-22 10:00:01', '2017-03-22 10:00:50');
INSERT INTO paradas(hr_ini, hr_term) VALUES ('2017-03-22 10:02:01', '2017-03-22 10:05:27');
INSERT INTO paradas(hr_ini, hr_term) VALUES ('2017-03-22 10:10:33', '2017-03-22 10:15:10');

;
SELECT 
	 hr_ini  
	,hr_term
	,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, hr_ini, hr_term)) AS tempo_parada
FROM paradas

----

hr_ini               hr_term              tempo_parada  
-------------------  -------------------  --------------
2017-03-22 10:00:01  2017-03-22 10:00:50  00:00:49      
2017-03-22 10:02:01  2017-03-22 10:05:27  00:03:26      
2017-03-22 10:10:33  2017-03-22 10:15:10  00:04:37      



