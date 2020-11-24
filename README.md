## Observações
As configurações de conexão com o Banco de Dados estão no arquivo src/model/Sql.php visto que esta classe é que realiza a conexão com o bando de dados.

O arquivo config.php configura corretamente o fuso-horario.

O arquivo htaccess contém o seguinte:
	RewriteEngine On

	RewriteCond %{REQUEST_FILENAME} !\.(js|gif|jpg|png|css|txt|ttf|map)$

	RewriteRule ^([^/]+)/? index.php?url=$1 [L,QSA]

Ele que é o responsável por redirecionar as urls para o index.php, possibilitando o funcionamento da classe de rotas.


## Informações
Está sendo utilizado:

*Apache/2.4.43 
*PHP/7.4.6
*Bootstrap 4.1.3
*Jquery 3.5.1
