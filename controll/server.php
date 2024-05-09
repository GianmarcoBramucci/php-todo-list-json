<?php 
    $todoJson= file_get_contents("../js/data.json");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method== 'POST') {
        if(isset($_POST['id'])) {
            $todoJsonPhp= json_decode($todoJson,true);
            $newTodo = [
                'id'=> $_POST['id'],
                'text'=> $_POST['text'],
                'done'=> $_POST['done'],
            ];
            $todoJsonPhp[] = $newTodo;
            $todoJson = json_encode($todoJsonPhp,JSON_PRETTY_PRINT);
            file_put_contents("../js/data.json",$todoJson);             
        }
    }
    header("Content-Type: application/json");
    echo $todoJson;