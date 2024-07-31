<?php   
$db_servidor = 'localhost';
$db_banco = 'myfirstapilembretedb';
$db_usuario = 'arley';
$db_pwd = 'senac123';

$pdo = new PDO ('mysql:dbname='.$db_banco.';'.'host='.$db_servidor,$db_usuario,$db_pwd);

//estruturando a resposta em Json - sempre seguirá este padrão
$array=[
    'error'=>"",
    'result'=> []
];

