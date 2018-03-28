# Projeto Vacosa

## Instalação:
- Crie um banco de dados local;
- Crie um arquivo chamado db-local.php dentro de config e coloca o seguinte conteúdo:

> 
`<?php
 return [
 'class' => 'yii\db\Connection',
 'dsn' => 'mysql:host=localhost;dbname=nome_banco',
 'username' => 'root',
 'password' => 'senha',
 'charset' => 'utf8',
];
`

- Configue o **db-local.php** conforme sua conexão local.
- IMPORTANTE: Mude para o branch **dev**, executando **git checkout -b dev**;
- No terminal, execute os comandos abaixo:
    - **composer install** para baixar e instalar as dependencias;
    - **php yii migrate --migrationPath=@yii/rbac/migrations** para instalar as tabelas do RBAC;
    - **php yii migrate** para instalar as outras tabelas e conteúdos;
    - **php yii serve** para iniciar um servidor local;
- Acesse [http://localhost:8080](http://localhost:8080) no navegador.
- O migration já deve criar o usuario. Acesse com *admin* e senha *admin* 

## Importante
- Não se esqueça que a cada vez que fizer pull, executar **composer update** e **php yii migrate**, para atualizar 
dependencias e banco de dados.
- Faça push sempre no branch **dev**. O branch **master** somente será usado para atualizar o sistema em produção.