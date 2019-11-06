# PA2.SENAI
Bom dia, seguem instruções.

Para inicializar o servidor (rodar a aplicação)
Php bin/console server:run

Quando quiser subir um Commit no Git hub 
git push origin master

Se quiser instalar a aplicação do zero

Vai no github (https://github.com/perrushow/PA2.SENAI)
Vai no botão clone ou download (copia a chave)
Abre o iterm/powershell numa pasta onde deseja instalar 

Escreva o comando no Iterm:
git clone  https://github.com/perrushow/PA2.SENAI.git

Volta ao PHP storm e sera criada uma pasta no PHP Storm a qual devera ser aberta.
Vai no Terminal do PHPStorm e executa os comandos (sempre que perguntar algo, dar yes):
Composer install
Php bin/console doctrine: database: create
Php bin/console make: migration
Php bin/console doctrine: migrations: migrate
Php bin/console doctrine: fixtures: load

Apos os acima voce precisa colocar novamente o Php bin/console server:run para executar!

Endereco base do servidor - http://127.0.0.1:8000
Para dar uma rota - http://127.0.0.1:8000/cadastrarcliente por exemplo depois de dar server run.

Sobre a estrutura dos códigos
PASTA PUBLIC
Na Pasta public ficam os css, integração com o atlantis, bootstrap e tudo relacionado aos estilos do sistema e frontend (javascript também).

SRC (pasta central do projeto)
 - Controller – e aonde fica o gerenciamento das rotas, criação dos forms, tudo relacionado as mudanças de paginas (passagem de uma pagina pra outra).
- DataFixtures – essa pasta guarda os dados que serão guardados no DB por exemplo, tudo que já começa a ser cadastrado antes do sistema abrir. Como as especialidades. Os fixtures no final são exatamente para definição dos horários e especialidades dos médicos pois elas são pre cadastradas no DB.
- Entity – e a pasta que contem todos os métodos (ou seja as acoes das classes) de get e set  e variáveis. Por exemplo, e aonde estão todas as tabelas criadas para o DB como para Cliente, clinome, telefone, id, planos_idplanos. Se no mysql criamos que um cliente pode ter varias consultas mas as consultas so podem ser associadas a um cliente, essas relações são colocadas na Entidade (classe cliente).
- Migrations – essa pasta contem a criação das tabelas no DB quando damos o doctrine migrations la em cima e essa e criada automaticamente. N mexe. 
- Repository – tbm e criada automaticamente, e aonde o DB cria as query ou seja os comandos sql, os selects os inserts, updates, joins etc. Mas e colocado da forma do phpstorm e n em sql.
OBs - SE QUISER CRIAR UMA QUERY VA NO TERMINAL DO PHP STORM E ESCREVE – php bin/console doctrine: query: sql “escreva o comando em sql q vc quiser”DEPOIS DA ENTER
- Templates – contem os templates de cada pagina. Basicamente e a pagina em HTML e aonde fica as paradas da integração com o Atlantis. Os Twigs são essas paginas em html, e hrefs nelas são links. 

