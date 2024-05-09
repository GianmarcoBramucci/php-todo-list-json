<?php 
    $todoJson= file_get_contents("../js/data.json");
    $method = $_SERVER['REQUEST_METHOD'];
    $todoJsonPhp= json_decode($todoJson,true);
    if ($method== 'POST') {
        if(isset($_POST['id'])) {
            $newTodo = [
                'id'=> $_POST['id'],
                'text'=> $_POST['text'],
                'done'=> $_POST['done'],
            ];
            $todoJsonPhp[] = $newTodo;             
        }
    }
    elseif ($method == 'DELETE') {
        $todoDelete= json_decode(file_get_contents('php://input'),true);
        $idTodoDelete = $todoDelete['id'];
        array_splice($todoJsonPhp,$idTodoDelete,1);
    }
    $todoJson = json_encode($todoJsonPhp,JSON_PRETTY_PRINT);
    file_put_contents("../js/data.json",$todoJson);
    header("Content-Type: application/json");
    echo $todoJson;