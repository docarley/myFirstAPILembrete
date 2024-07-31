<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'put') {
    //Não temos as globais DELETE e PUT então temos que ler as entradas que vem do form através de PUT através do file get contents, esta função lê o array do que foi enviado via put converte os elementos para string e guarda no array que criamos , o $_PUT
    parse_str(file_get_contents("php://input"), $_PUT);

    $id = filter_var($_PUT["id"] ?? null, FILTER_VALIDATE_INT);
    $titulo = filter_var($_PUT["tituloLembrete"] ?? null);
    $corpo = filter_var($_PUT["corpoLembrete"] ?? null);

    //Alternativa
    // $id = $_PUT["id"] ?? null;
    // $id = filter_var($id,FILTER_VALIDATE_INT);

    if ($id && $titulo && $corpo) {

        $sql = $pdo->prepare("SELECT * FROM Lembrete WHERE idLembrete=:id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $pdo->prepare("UPDATE Lembrete SET tituloLembrete=:titulo, corpoLembrete=:corpo WHERE idLembrete=:id");
            
            $sql->bindValue(":id", $id);
            $sql->bindValue(":titulo", $titulo);
            $sql->bindValue(":corpo", $corpo);
            
            $sql->execute();

            $array['result']=[
                "id"=>$id,
                "tituloLembrete"=>$titulo,
                "corpoLembrete"=>$corpo
            ];

        } else {
            $array['error'] = "Id de lembrete não encontrado";
        }
    } else {
        $array['error'] = "Dados enviados são vazios ou inválidos";
    }
} else {
    $array['error'] = "Erro: ação não permitida - (requisição apenas com método PUT)";
}

require('../return.php');

/* Testar
1-chamada com metodo errado
2-chamar sem enviar parâmetro ou todos os parâmetros 
3-chamar enviando id incorreto
4-usar getall para ver o que foi atualizado na lista
5-usar get para ver apenas o que foi atualizado
6-mostrar no BD o que foi atualizado via API
*/
