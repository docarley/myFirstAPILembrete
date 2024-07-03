<?php   
$db_servidor = 'localhost';
$db_banco = 'myfirstapilembretedb';
$db_usuario = 'docarley';
$db_pwd = 'senac123';

$pdo = new PDO ("mysql:dbname=$db_banco;host=$db_servidor,$db_usuario,$db_pwd");

