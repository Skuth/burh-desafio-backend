# Desafio Backend BURH

Este é o projeto backend desenvolvido para o desafio da Burh.

## Tecnologias Utilizadas

- PHP, com Laravel
- MySql
- Docker

## Como executar

Primeiro que será preciso ter o Docker instalado na máquina.

1. Inicializar o contâiner:
   ```
   docker-compose up -d
   ```
2. Rodar as migrations e factories (vai criar as empresas e usuários de exemplo):
   ```
   docker exec -it laravel-app bash
   php artisan migrate:fresh --seed
   ```
3. Inicie o servidor:
   ```
   php artisan serve
   ```

Qualquer alteração no ambiente pode ser realizado nos arquivos `docker-compose.yml`, `Dockerfile`, ou `.env`.

Para conectar no banco, use estes parâmetros:
<table>
    <tr>
        <td>IP</td>
        <td>127.0.0.1</td>
    </tr>
    <tr>
        <td>Porta</td>
        <td>3306</td>
    </tr>
    <tr>
        <td>Usuário</td>
        <td>laravel</td>
    </tr>
    <tr>
        <td>Senha</td>
        <td>secret</td>
    </tr>
</table>

## Testes

Para rodar os testes:
```
php artisan test
```

## Documentação

Eu fiz uma documentação para a API utilizando Swagger, para acessar, utilizar o link <a href="http://localhost:8000/api/documentation">`http://localhost:8000/api/documentation`</a>.