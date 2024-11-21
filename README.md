# Primeiro projeto teste com Symfony

## Passo A passo para o primeiro BLOG

## Instalação e entendendo o server start

Pela documentação, como estou usando Windows, fiz a instalação do Scoop primeiro.
Após, com Scoop instalado, pensei em fazer um blog, e seguindo a lógica na própria documentação, rodei o comando:

```bash
symfony new --webapp blog
```

e depois para testar o início do projeto e também startar o server:

```bash
symfony server:start
```

e o projeto já ficou no ar.

## Para o banco(Sqlite). Model:

Adicionado ao env:

```bash
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
```

E arquivo dentro de var, data.db, criado.

```bash
php bin/console make:entity News
```

Criei title, content e datepublished
campos são praticamente automáticos.

Criação de banco, rodando migration.

```bash
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

Nessa parte vou procurar algo parecido com o seeds, e existe o fixtures

```bash
composer require --dev doctrine/doctrine-fixtures-bundle
```

Adicionado só um for mesmo com os campos pra adicionar as notícias.

pra rodar e testar:

```bash
php bin/console doctrine:fixtures:load
```

Tudo ok até aqui.

## Controller:

```bash
php bin/console make:controller NewsController
```

Só adição de controller com as funções de listagem/index e detalhe.
seguindo o básico do padrão de rota também

## Twigs

Alterando os arquivos twigs:
index e base
criando o arquivo detail

Tudo parcialmente funcionando. Campo de data deu erro mas vou deixar tudo junto como datepublished, errei no padrão.

Adicionado só o bootstrap no base

Alterado Base, Detail e Index.

Vou adicionar as outras notícias dentro do detail, obviamente sem o id da notícia que está sendo visualizada.

Pra terminar vou só mudar o esquema de rotas, pelo que entendi, pode-se criar uma controller ou limitar dentro do routes usando o catch_all. Fiz o routes, mas ele trata a rota com existente, jogando o conteúdo da index. vou manter assim.

## Entendimento Final

O Symfony para esse tipo de projeto é muito parecido com o Laravel, segue o MVC(nomenclaturas tipo twig/blade ou pastas), um pouco mais manual para configurar e documentação é simples, mas maneira diferente de se fazer, com o tutorial usando doctrine foi bem tranquilo. A criação de dados é bem simples também, sem problemas com isso. Migrations e comandos já bem definidos, nada que um alias de comando não resolva pro tamanho do mesmo.

Pra projetos assim também aceita sqlite, o que facilita, foi alterado apenas a linha do database no .env.

Pra esse tipo de projeto, talvez pelo conhecimento, achei o Laravel bem mais rápido. O Symfony pela documentação, achei mais flexível, principalmente para realização de queries iniciais.

Acredito ter sido 'tranquilo' pela facilidade que já existe com Laravel. O projeto funciona bem rápido também, mesmo sendo algo simples, e o retorno de erro, mesmo sendo poucos pra esse projeto, é bem definido e fácil pra debugar.
