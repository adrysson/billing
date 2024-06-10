# Sistema de Cobrança de Débitos

Este é um sistema de cobrança de débitos desenvolvido em Laravel. O sistema permite o upload e processamento de arquivos CSV contendo informações de débitos e fornece uma interface para visualizar os arquivos carregados.

## Descrição do Projeto

O sistema é composto por um backend Laravel que oferece duas principais funcionalidades:
1. Upload de arquivos CSV contendo informações de débitos.
2. Visualização dos arquivos CSV carregados.

## Funcionalidades Principais

- **Upload de Arquivos CSV**: Permite aos usuários fazer o upload de arquivos CSV contendo dados de débitos.
- **Visualização de Arquivos Carregados**: Lista todos os arquivos CSV que foram carregados pelo usuário.

## Pré-requisitos

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Git](https://git-scm.com/)

## Passo a Passo de Instalação

1. **Clone o repositório do projeto**
    ```sh
   git clone git@github.com:adrysson/billing.git
   cd billing
    ```

2. **Configure as variáveis de ambiente**
    ```sh
   cp .env.example .env
    ```
    Configure as seguintes variáveis de ambiente:
    ```dotenv
    DB_DATABASE=seu_database
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
    ```

3. **Instale as dependências**
    ```sh
    docker run --rm -v $(pwd):/var/www -w /var/www composer install
    ```

4. **Build dos containers**
    ```
   docker compose build
    ```

5. **Gere a chave da aplicação**
    ```
   docker compose exec app php artisan key:generate
    ```

6. **Execute as migrations**
    ```
   docker compose exec app php artisan migrate
    ```

7. **Acesse a aplicação**
    A aplicação estará disponível no endereço http://localhost:8000.

## Utilização das Rotas

A aplicação oferece duas principais rotas para interação com o sistema de cobrança de débitos:

### 1. Upload de Arquivos CSV

- **Método**: POST
- **URL**: `/api/upload-file`
- **Parâmetro**:
  - `csv_file` (obrigatório): O arquivo CSV contendo os dados de débitos.

### 2. Visualização de Arquivos Carregados

- **Método**: GET
- **URL**: `/api/uploaded-files`
- **Descrição**: Retorna uma lista de todos os arquivos CSV que foram carregados.

## Resultados

Nos testes de desempenho realizados, a rota de upload e processamento de arquivos CSV (`/api/upload-file`) foi capaz de processar mais de 1.000.000 de linhas em menos de 5 segundos.
