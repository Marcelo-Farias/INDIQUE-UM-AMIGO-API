# INDIQUE-UM-AMIGO-Marcelo-Farias
API RESTful do projeto solicitado no processo de seleção para programador back-end da UNISUAM em 2021.

## Detalhes do projeto:
O SGBD utilizado foi o PostgreSQL. A implementação da API RESTful foi feita com o Lumen(Laravel). E o front-end foi feito em um projeto separado usando o framework Angular.

## Instruções:
Criar um banco de dados (PostgreSQL) chamado INDIQUE-UM-AMIGO. Usando as seguintes informações:

 	Host: localhost
 	Port: 5432
 	Database_name: INDIQUE-UM-AMIGO
 	User: postgres
 	Password: UNISUAM2021

O projeto requer a instalação do:
 	PostgreSQL
 	Composer
 	NodeJS
	 Angular/CLI
 
Após instalar o NodeJS, podemos instalar o Angular/CLI com o seguinte comando no terminal:
 
	 npm install -g @angular/cli
 
## Fazendo o download das dependências dos projetos:
Após as instalações. Executar os comandos no terminal:
	
 	Para a API Rest (Laravel/Lumen), no diretório do projeto:
		1) composer install
		2) php artisan migrate:install
		2) php -S localhost:8000 -t public

	Para a SPA (Angular), no diretório do projeto:
		1) npm install
		2) ng serve
  
OBS: A porta para a API deve ser 8000. E a porta para a SPA deve ser 4200.

## Link:
O link para a página do projeto é:

http://localhost:4200
 

