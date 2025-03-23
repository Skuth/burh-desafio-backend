#Projeto API de Vagas de Emprego com Laravel

Introdução

Este projeto consiste na criação de uma API RESTful para gerenciar vagas de emprego, candidaturas de usuários e informações 

relacionadas. A API foi desenvolvida como parte de um desafio para a vaga de Desenvolvedor Backend PHP no Burh.

Tecnologias Utilizadas

*PHP: Linguagem de programação principal.

*Laravel: Framework PHP utilizado para desenvolvimento da API.

*MySQL: Banco de dados relacional para armazenamento de dados.

*Docker: Utilizado para containerização do ambiente de desenvolvimento.

Estrutura do Projeto

O projeto está estruturado da seguinte forma:

*app/: Contém os controllers, models e outras classes relacionadas à lógica de negócios da aplicação.
database/

*migrations/: Migrations para criação e alteração de tabelas no banco de dados.

*seeders/: Seeders para popular o banco de dados com dados de teste.

*routes/: Define as rotas da API.

*tests/: Testes automatizados para verificar o funcionamento da API.

*Funcionalidades Implementadas

Cadastro de Empresas e Usuários:

Empresas podem se cadastrar com nome, descrição, CNPJ e plano (Free ou Premium).

Usuários podem se cadastrar com nome, email, CPF e idade.

Gerenciamento de Vagas de Emprego:

Empresas podem criar, listar, atualizar e excluir vagas de emprego.

Restrições são aplicadas ao número máximo de vagas conforme o plano da empresa (Free ou Premium).

Candidatura de Usuários às Vagas:

Usuários podem visualizar e se candidatar às vagas disponíveis.

Validações e Restrições:

Validações são aplicadas para garantir a unicidade de CPFs e emails de usuários.

Restrições são aplicadas para garantir a unicidade de CNPJs de empresas.

Requisitos Específicos:

Tipos específicos de vagas (PJ, CLT, Estágio) com regras diferentes para salário e horário.

Limites de vagas para empresas baseados no plano (Free até 5 vagas, Premium até 10 vagas).

Instalação e Execução Local

Para executar o projeto localmente, siga os passos abaixo:

Clone este repositório:


Copiar código

git clone <[url-do-seu-repositorio](https://github.com/LuizSilva02/burh-desafio-backend.git)>

cd nome-do-seu-projeto

Configure o ambiente Docker:


Copiar código

docker-compose up -d

Instale as dependências do projeto:


Copiar código

docker-compose exec app composer install

Execute as migrações do banco de dados:


Copiar código

docker-compose exec app php artisan migrate

Execute os seeders para popular o banco de dados:


Copiar código

docker-compose exec app php artisan db:seed

Acesse a API através de http://localhost:8080.

Testes

Os testes automatizados estão localizados no diretório tests/. Eles podem ser executados usando o seguinte comando:

Copiar código

docker-compose exec app php artisan test
