# Soft Bolos API

Realizar o desenvolvimento da proposta a seguir utilizando ao máximo as funcionalidades do framework Laravel em sua versão mais recente.

- Criar um CRUD de rotas de API para o cadastro de bolos.
- Os bolos deverão ter Nome, Peso (em gramas), Valor, Quantidade disponível e uma lista de e-mail de interessados.
- Após o cadastro de e-mails interessados, caso haja bolo disponível, o sistema deve enviar um e-mail para os interessados sobre a disponibilidade do bolo.
- Deve haver algum percentual de cobertura de testes

## Setup inicial

1. Após realizar o clone do projeto, instale as dependências do mesmo com:
```shell
composer install
```

2. Caso você não possua o `composer` instalado localmente:
```shell

docker run --rm -itv $(pwd):/app -w /app -u $(id -u):$(id -g) composer:2.5.8 install
```

3. Com as dependências instaladas, crie o arquivo de configuração `.env`:
```shell
cp .env.example .env
```

4. Inicie o ambiente _Docker_ executando:
```shell
docker-compose up -d
```

5. Dê permissões ao usuário correto para escrever logs na aplicação
```shell
docker-compose exec app chown -R www-data:www-data /app/storage
```

6. Garanta que o contêiner de banco de dados está de pé. Os logs devem exibir a mensagem _ready for connections_ nas últimas linhas
```shell
docker-compose logs database
``` 
Aguarde até que o comando acima tenha como uma das últimas linhas a mensagem _ready for connections_.

7. Para criar o banco de dados, execute:
```shell
docker-compose exec app php artisan migrate --seed
```

API já estará acessível através do endereço http://localhost:8123/api. Além disso, o endereço http://localhost:8025 provê acesso ao serviço de e-mail _Mailpit_.

## Testes

Para executar os testes automatizados, utilize o comando:

```bash
docker-compose exec app php artisan test
```

## Iniciando a fila

```bash
docker-compose exec app php artisan queue:work
```

## Endpoints da API

API possui os seguintes endpoints:

## Autenticação:

Realizar autenticação com o payload abaixo para `http://localhost:8123/api/login`.: coletar o token gerado e utilizar como bearer token nas demais requisições.

```json
{
  "email": "email@example.com",
  "password": "12345678"
}
```

### Bolos

Listar todos os bolos:

```bash
GET /api/cakes
```

Criar um novo bolo:

```bash
POST /api/cakes
```

Exemplo de corpo da requisição:

```json
{
  "name": "Bolo de Chocolate",
  "weight": 500,
  "value": 20.50,
  "quantity": 10
}
```

Obter detalhes de um bolo específico:

```bash
GET /api/cakes/{id}
```

Atualizar um bolo:

```bash
PUT /api/cakes/{id}
```

Exemplo de corpo da requisição:

```json
{
  "name": "Bolo de Morango",
  "quantity": 5
}
```

Excluir um bolo:

```bash
DELETE /api/cakes/{id}
```

### E-mails de Interessados

Registrar um e-mail de interessado:

```bash
POST /api/interested-emails
```

Exemplo de corpo da requisição:

```json
{
  "email": "interessado@example.com",
  "cake_id": 1
}
```

## Mailpit

O Mailpit é utilizado para simular o envio de e-mails. Você pode acessar a interface do Mailpit para visualizar os e-mails enviados:

Acesse o Mailpit:

Abra o navegador e acesse `http://localhost:8025`.

## Estrutura do Projeto

O projeto segue o padrão MVC e está organizado da seguinte forma:

- **Models**:
  - `Cake` e `InterestedEmail` para gerenciar os dados de bolos e e-mails de interessados.

- **Controllers**:
  - `CakeController` e `InterestedEmailController` para gerenciar as requisições da API.

- **Jobs**:
  - `SendEmailToInterestedUsers` para enviar e-mails de forma assíncrona quando um bolo estiver disponível.

- **Resources**:
  - `CakeResource` para formatar a resposta da API.

- **Migrations**:
  - Definição das tabelas `cakes` e `interested_emails`.

- **Tests**:
  - Testes automatizados para garantir a qualidade do código.

## Tecnologias Utilizadas

- **Laravel 11.x** - Framework PHP.
- **MySQL** - Banco de dados para armazenamento.
- **Redis** - Cache e filas.
- **Docker** - Conteinerização da aplicação.
- **Mailpit** - Simulação de envio de e-mails.
- **PHPUnit** - Testes automatizados.

## Escalabilidade e Performance

- **Filas**: O envio de e-mails é feito de forma assíncrona utilizando filas, garantindo que a aplicação não seja bloqueada por processos demorados.
- **Redis**: Poderá ser utilizado para cache entre outras funcionalidades, melhorando o tempo de resposta da API.
- **Docker**: Facilita a escalabilidade e o deploy da aplicação em diferentes ambientes.
- **Load Balance**: Foi criado duas instancias da aplicação em um load balancer, para que aplicação possa lidar com um grande volume de requisições simultaneamente.

## Pipeline

- **PHP Codesniffer**: Para análise estática.
- **PHP Stan**: Para verificar padrões de código.
