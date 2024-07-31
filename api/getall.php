<?php

require('../config.php');

$method=strtolower($_SERVER['REQUEST_METHOD']);

if ($method==='get') {
    $sql = $pdo->query("SELECT * FROM lembrete");    
   
    if ($sql->rowCount()>0) {
        $data=$sql->fetchAll(PDO::FETCH_ASSOC);        
        // var_dump($data); // demonstrar como vem sem fetch_assoc apenas com ()
        foreach ($data as $item) {
            $array['result'][]=[
                "id"=>$item['idLembrete'],
                "tituloLembrete"=>$item['tituloLembrete']
            ];
        }
    }
} else {
    $array['error'] = "Ação não permitida - (only GET)";
}

require('../return.php');