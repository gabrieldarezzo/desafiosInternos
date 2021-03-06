# Como Inativar um registro do sistema e mantê-lo  no banco de dados

https://forum.imasters.com.br/topic/555907-como-inativar-um-registro-do-sistema-mas-mant%C3%AA-lo-no-banco-de-dados/?do=findComment&comment=2217595

```sql
CREATE DATABASE imasters;
use imasters;
CREATE TABLE blog_imasters(
     id            int(8) PRIMARY KEY AUTO_INCREMENT
    ,nome          varchar(100) not null
    ,excluido      TINYINT(1) default 0
    ,excluido_por  varchar(100)  /* Ou pode ser o _id da tabela referenciado o user que exclui como FOREING KEY*/
    ,excluido_em   DATETIME
);
```

Bora inserir uma galera
```sql
INSERT INTO blog_imasters(nome) VALUES ('Beraldo');
INSERT INTO blog_imasters(nome) VALUES ('Gabriel');
INSERT INTO blog_imasters(nome) VALUES ('Wbruno');
INSERT INTO blog_imasters(nome) VALUES ('AndersonMamede');
```


Então basicamente sempre que você quiser trazer os usuários ativos o seguinte comando: 
```sql
SELECT id, nome FROM blog_imasters where excluido <> 1;
```

Bora 'excluir' alguém...  
Vamos deletar o @AndersonMamede já q ele sumiu do Imasters....

```sql
UPDATE blog_imasters set excluido = 1, excluido_por = 'Gabriel', excluido_em = now() where nome = 'AndersonMamede'
```

Vamos confirmar se ele realmente foi 'excluido'...
```sql
mysql> SELECT * FROM blog_imasters where excluido <> 1;
+----+---------+----------+--------------+-------------+
| id | nome    | excluido | excluido_por | excluido_em |
+----+---------+----------+--------------+-------------+
|  1 | Beraldo |        0 | NULL         | NULL        |
|  2 | Gabriel |        0 | NULL         | NULL        |
|  3 | Wbruno  |        0 | NULL         | NULL        |
+----+---------+----------+--------------+-------------+
```

Show, e agora qnd alguem perguntar... (vão perguntar pode confiar... )  QUEM EXCLUIU ?! FOI ERRO NO SISTEMA!  
Se já saca o 'log' até com a hora, seg, e usuário.

```sql
mysql> SELECT * FROM blog_imasters where excluido  = 1;
+----+----------------+----------+--------------+---------------------+
| id | nome           | excluido | excluido_por | excluido_em         |
+----+----------------+----------+--------------+---------------------+
|  4 | AndersonMamede |        1 | Gabriel      | 2017-02-07 21:46:19 |
+----+----------------+----------+--------------+---------------------+
```



### @Dica bonus: 
Utilize o carinha abaixo para ter o datetime da ultima ateração, assim sempre que ocorrer uma alteração você tem a data/hora + pessoa que alterou (Independente se foi exclusão ou não)
```sql 
CREATE TABLE blog_imasters_alterado(
	 nome VARCHAR(50)
    ,alterado_por VARCHAR(50) /* Ou pode ser o _id da tabela referenciado o user que exclui como FOREING KEY*/
    ,alterado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP    
);
```

Bora Inserir alguem...
```sql
INSERT INTO blog_imasters_alterado(nome, alterado_por) VALUES ('Ronaldinho', 'GABRIEL');
```
```
mysql> SELECT * FROM blog_imasters_alterado;
+------------+--------------+---------------------+
| nome       | alterado_por | alterado_em         |
+------------+--------------+---------------------+
| Ronaldinho | GABRIEL      | 2017-02-17 11:08:36 |
+------------+--------------+---------------------+
```

Repare no alterado_em = **"2017-02-17 11:08:36"**
Agora vamos alterar apenas o nome para 'Ronaldinho Gaucho'

```sql
UPDATE blog_imasters_alterado SET nome = 'Ronaldinho Gaucho', alterado_por = 'JOSE'
```
```
mysql> SELECT * FROM blog_imasters_alterado;
+-------------------+--------------+---------------------+
| nome              | alterado_por | alterado_em         |
+-------------------+--------------+---------------------+
| Ronaldinho Gaucho | JOSE         | 2017-02-17 11:10:15 |
+-------------------+--------------+---------------------+
```


EPIC WIN! Alterado_em = **"2017-02-17 11:10:15"** (Sendo que o UPDATE foi feito **apenas** nas colunas **(nome, alterado_por)**
Pois a coluna alterado_em tem instrução de ```ON UPDATE CURRENT_TIMESTAMP```
