<?php

require('../config.php');

$method=strtolower($_SERVER['REQUEST_METHOD']);

if ($method==='get') {
    $id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);

    if ($id) {
        $sql=$pdo->prepare("SELECT * FROM lembrete WHERE idLembrete=:id");
        $sql->bindValue(':id',$id);
        $sql->execute();
        
        if ($sql->rowCount()>0) {            
            $dadosRetornados=$sql->fetch(PDO::FETCH_ASSOC);
            $array['result'][]=[
                "id"=>$dadosRetornados['idLembrete'],
                "tituloLembrete"=>$dadosRetornados['tituloLembrete'],
                "corpoLembrete"=>$dadosRetornados['corpoLembrete']
            ];
        }
        else{
            $array['error']="Erro: Lembrete não existente";
        }
    }
    // else{
    //     $array['error']="Erro: informar o id do lembrete";
    // } //deixado como desafio para os alunos

} else {
    $array['error'] = "Erro: ação não permitida - (requisição apenas com método GET)";
}

require('../return.php');

/* Testar
1-chamada com metodo errado
2-chamar sem enviar parâmetro --> desafio
3-chamar com id errado 
4-chamar com id certo
*/

