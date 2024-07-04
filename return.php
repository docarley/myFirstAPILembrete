<?php
//um site nao pode fazer requisicao a outro site sem a devida permissão - a api deve permitir que determinadas pessoas acessem ou geral
header("Access-Control-Allow-Origin: *"); //Para domínio específico só colocar o nome no lugar do * que é aberta a todos
header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS"); //Para definir quais metodos podem ser enviados para a api o options e executado sempre antes do get nos bastidores.
header("Content-Type: application/json;charset=utf-8"); //Informar o tipo de retorno Devemos pois apps sem esta informação apresentarao erros o navegador até se vira bem com isso


echo json_encode($array,JSON_UNESCAPED_UNICODE); //desafio acrescentar o JSON_UNESCAPED_UNICODE
exit;
