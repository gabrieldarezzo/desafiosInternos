Exemplo de validação por Ajax a cada entrada de dados,

Toda a validação é centralizada no Back-End porem mantem o dinamismo do JavaScript.

Obs:
Não esqueça de rodar criação da tabela:

```sql
DROP DATABASE IF EXISTS imasters;
CREATE DATABASE imasters;
use imasters;

CREATE TABLE usuario(
	 id            int(8) primary key auto_increment
	,nome_completo varchar(50) not null
	,email         varchar(250) not null
	,senha         varchar(100) not null
	,token         CHAR(32)
	,criado_em     DATETIME
);
```



Live Demo:  
https://inwork.com.br/clientes/github/valida/