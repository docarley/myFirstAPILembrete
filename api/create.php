<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'post') {
    $titulo = filter_input(INPUT_POST, 'titulo');
    $corpo = filter_input(INPUT_POST, 'corpo');
    if ($titulo && $corpo) {
        $sql = $pdo->prepare("INSERT INTO lembrete(titulolembrete,corpolembrete) VALUES (:titulo,:corpo)");
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':corpo', $corpo);
        $sql->execute();

        $id = $pdo->lastInsertId();

        $array['result'][] = [
            "id" => $id,
            "tituloLembrete" => $titulo,
            "corpoLembrete" => $corpo
        ];
    } else {
        $array['error'] = "Erro - valores inválidos";        
    }
} else {
    $array['error'] = "Erro: ação não permitida - (requisição apenas com método POST)";
}

require('../return.php');

/* Testar
1-chamada com metodo errado
2-chamar sem enviar parâmetro 
3-retornar o objeto inserido --> desafio
*/