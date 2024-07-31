<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'delete') {
    //Não temos as globais DELETE e PUT então temos que ler as entradas que vem do form através de PUT através do file get contents, esta função lê o array do que foi enviado via put converte os elementos para string e guarda no array que criamos , o $_PUT
    parse_str(file_get_contents("php://input"), $_DELETE);

    $id = filter_var($_DELETE["id"] ?? null, FILTER_VALIDATE_INT);

    //Alternativa
    // $id = $_PUT["id"] ?? null;
    // $id = filter_var($id,FILTER_VALIDATE_INT);

    if ($id) {

        $sql = $pdo->prepare("SELECT * FROM Lembrete WHERE idLembrete=:id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $pdo->prepare("DELETE FROM Lembrete WHERE idLembrete=:id");
            
            $sql->bindValue(":id", $id);
            
            $sql->execute();

            $array['result'] = "Lembrete excluído com sucesso!";
        } else {
            $array['error'] = "Id de lembrete não encontrado";
        }
    } else {
        $array['error'] = "Dados enviados são vazios ou inválidos";
    }
} else {
    $array['error'] = "Erro: ação não permitida - (requisição apenas com método DELETE)";
}

require('../return.php');

/* Testar
1-chamada com metodo errado
2-chamar sem enviar id
3-chamar enviando id incorreto
4-usar getall para ver o que foi deletado na lista
5-usar get para ver apenas o que foi deletado
6-mostrar no BD o que foi deletado via API
*/