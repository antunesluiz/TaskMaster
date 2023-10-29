# TaskMaster

## Sobre

`TaskMaster` é uma aplicação de gerenciamento de tarefas robusta e focada no back-end, construída usando Laravel 10 com PHP 8.2. Este projeto também utiliza Laravel Sail para um ambiente de desenvolvimento Dockerizado e Pest PHP para testes elegantes.

## Recursos

- Laravel 10
- PHP 8.2
- Laravel Sail
- Pest PHP
- MySQL

## Pré-requisitos

- Docker
- Composer
- PHP 8.2

## Configuração inicial

1. **Clone o repositório:**
    ```bash
    git clone https://github.com/seu_usuario/TaskMaster.git
    ```

2. **Navegue até o diretório do projeto:**
    ```bash
    cd TaskMaster
    ```

3. **Levante os serviços do Docker:**
    ```bash
    ./vendor/bin/sail up
    ```

## Instalação de dependências

Execute o seguinte comando para instalar as dependências:
```bash
./vendor/bin/sail composer install
```

## Configuração do ambiente

1. **Copie o arquivo `.env.example` para `.env`:**
    ```bash
    cp .env.example .env
    ```

2. **Gere uma chave para a aplicação:**
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

## Executando as migrações e seeders

Execute as migrações e seeders para popular o banco de dados:
```bash
./vendor/bin/sail artisan migrate --seed
```

## Testes

Para executar os testes unitários e de feature, utilize o seguinte comando:
```bash
./vendor/bin/sail artisan test
```
## Documentação da API

Para entender as rotas, parâmetros e formatos de resposta da API, consulte o arquivo `api-docs.md` incluído no projeto. Este documento fornecerá exemplos e descrições detalhadas para cada endpoint da API.

## Ferramentas Auxiliares

- **Postman:** Use esta ferramenta para testar todos os endpoints da API. Você pode importar a coleção Postman incluída no projeto para começar rapidamente.
- **Swagger:** O projeto também inclui uma especificação Swagger que pode ser acessada em `http://seu_dominio/api/documentation`.

## Monitoramento e Logging

Este projeto utiliza o Laravel Telescope para monitoramento e logging em ambiente de desenvolvimento. Acesse `http://seu_dominio/telescope`.

## Segurança

Para garantir a segurança da API, o projeto implementa autenticação via Laravel Sanctum. Certifique-se de seguir as melhores práticas de segurança ao consumir ou expor esta API.

## Atualizações e Manutenção

Para atualizar o projeto com as últimas melhorias e correções de segurança, siga o guia de atualização fornecido em `UPGRADE.md`.

## Créditos

- [Seu Nome](https://github.com/seu_usuario)
- [Contribuidor](https://github.com/contribuidor)

## Licença

Este projeto está sob a licença MIT. Consulte o arquivo `LICENSE.md` para mais detalhes.
