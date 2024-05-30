# MLOVI Multidisciplinar - Backend API V1


## Índice

- [Introdução](#introdução)
- [Clonando o projeto](#clonando-o-projeto)
- [Configurando .env](#configurando-.env)
- [Subindo os Serviços com Docker Compose](#subindo-os-serviços-com-docker-compose)
- [Acessando o Container da Aplicação](#acessando-o-container-da-aplicação)
- [Composer install](#composer-install)
- [Gerar key laravel](#gerar-key-laravel)
- [Criando e populando o Banco de Dados](#criando-e-populando-o-banco-de-dados)
- [Documentação Swagger Api](#documentacão-swagger-api)



## Introdução

Este documento fornece instruções detalhadas sobre como configurar e executar os serviços necessários para o projeto MLOVI Multidisciplinar - Backend API usando Docker.

## Clonando o projeto

Em seu terminal realize o comando:

    git clone https://github.com/Gsouzabd/mhealth-app-backend.git


## Configurando o .env

1. Copie o .env-example e crie o arquivo .env do projeto com o comando:

    ```bash
    cp env.example .env
    ```
2. Configure o .env informando as portas compatíveis ao docker-compose.yml


## Subindo os Serviços com Docker Compose

1. Para iniciar todos os serviços definidos no arquivo `docker-compose.yml`, execute o seguinte comando no terminal:

    ```bash
    docker compose up -d
    ```


## Acessando o Container da Aplicação

1. Para acessar o terminal do container da aplicação execute o comando:

    ```bash
    docker exec app bash
    ```


## Composer Install

Para garantir que todas as dependências necessárias estejam instaladas no seu projeto Laravel, você deve executar o `composer install` no terminal do container da aplicação. Siga os passos abaixo:

1. Execute o comando abaixo para instalar as dependências:

    ```bash
    composer install
    ```

    Este comando vai baixar e instalar todas as dependências definidas no seu arquivo `composer.json`.

2. Aguarde até que o processo de instalação seja concluído. Uma vez finalizado, você verá uma mensagem de sucesso no terminal.


## Gerar Key Laravel

Após a instalação das dependências, é crucial gerar uma chave de aplicativo. Siga estes passos para gerar uma chave:

1. Com o terminal ainda aberto no containar da aplicação laravel, execute o seguinte comando:

    ```bash
    php artisan key:generate
    ```

2. Este comando irá gerar uma nova chave de aplicativo e a inserirá automaticamente no seu arquivo `.env`, substituindo o valor de `APP_KEY`.

3. Você verá uma mensagem no terminal confirmando a geração da chave, algo como: "Application key set successfully."

Seguindo estes passos, você terá configurado as dependências necessárias para rodar a aplicação Backend.
Por padrão, na url: http://localhost:8989/


## Criando e populando o Banco de Dados

Após configurar todo o projeto laravel, precisamos gerar as tabelas do banco de dados e populá-las com dados mocks:

1. Com o terminal ainda aberto no containar da aplicação laravel, execute o seguinte comando:

    ```bash
    php artisan migrate
    ```
    
2. Este comando irá gerar as tabelas no banco de dados.

3. Caso queira popular o banco com dados mocks, utilize o comando:

    ```bash
    php artisan db:seed
    ```


## Documentação Swagger Api

Acesse a documentação da API Backend através do path:
/api/documentation#/

-Exemplo: Se sua aplicação roda em http://localhost:8989/, acesse:
http://localhost:8989/api/documentation#/

1. Comando para atualizar:

    ```bash
    php artisan l5-swagger:generate
    ```