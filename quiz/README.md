# PGQuiz

##Instalação

1 - Faça o download dos arquivos.

2 - Extraia o pacote e copie para seu webserver (Requirido PHP 7.2 ou Superior / PostgreSQL 9.5 ou superior).

3 - Criar um banco de dados no PostgreSQL

4 - Executar o arquivo que se encontra na raiz do repositório chamado Banco de Dados.sql, onde serão criados os objetos no banco de dados.

5 - Editar o arquivo index.php que está na raiz do projeto e alterar a variável BASEURL com o endereço do webserver e diretório da aplicação.

6 - Editar o arquivo aplication\config\database.php e ajustar os parâmetros (hostname, port, username, password, database) do banco de dados (PostgreSQL).

7 - A aplicação possui um portal de administração onde serão cadastradas as perguntas e respostas, o portal será acessado no endereço da aplicação, por exemplo: http://www.seudominio.com.br/pgquiz

8 - Para responder a Quiz acesse no endpoint /quiz, por exemplo, http://www.seudominio.com.br/pgquiz/quiz

9 - Para finalizar o ranking estará disponível no endpoint /ranking, por exemplo, http://www.seudominio.com.br/pgquiz/quiz
