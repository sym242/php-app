<?php
require_once('config.php');

//PDOクラスのインスタンス化
function connectPdo()
{
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) { 
        echo $e->getMessage();
        exit();
    }
}

function createTodoData($todoText)
{
    $dbh = connectPdo();
    // $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';
    $sql = 'INSERT INTO todos (content) VALUES (:todoText)';
    $stmt = $dbh->prepare($sql);
    //var_dump($stmt);
    $stmt->bindValue(':todoText', $todoText, PDO::PARAM_STR);
    $stmt->execute(); 
}

function getAllRecords()
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
    // var_dump($dbh->query($sql));
    return $dbh->query($sql);
}

function updateTodoData($post)
{
    $dbh = connectPdo();
    $sql = 'UPDATE todos SET content = :todoText WHERE id = :id'; 
    $stmt = $dbh->prepare($sql); 
    var_dump($stmt);
    $stmt->bindValue(':todoText', $post['content'], PDO::PARAM_STR); 
    $stmt->bindValue(':id', (int) $post['id'], PDO::PARAM_INT); 
    $stmt->execute(); 
    // $dbh = connectPdo();
    // $sql = 'UPDATE todos SET content = "' . $post['content'] . '" WHERE id = ' . $post['id'];
    // $dbh->query($sql);
    // $sql = 'UPDATE todos SET content = :todoText WHERE id = :id';
    // $stmt = $dbh->prepare($sql);
    // var_dump($stmt);
    // $stmt->bindValue(':todoText', $post['content'], PDO::PARAM_STR);
    // $stmt->bindValue(':id', (int) $post['id'], PDO::PARAM_INT);
}

function getTodoTextById($id)
{
    $dbh = connectPdo();
    // $sql = "SELECT * FROM todos WHERE deleted_at IS NULL AND id = '" . $id . "'";
    // $data = $dbh->query($sql)->fetch();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id = :id';
    // var_dump($data);
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetch();
    return $data['content'];
}

function deleteTodoData($id)
{ 
    $dbh = connectPdo();
    $now = date('Y-m-d H:i:s');
    $sql = 'UPDATE todos SET deleted_at = :now WHERE id = :id'; 
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':now',  $now, PDO::PARAM_STR);
    $stmt->bindValue(':id',  $id, PDO::PARAM_INT);
    $stmt->execute();
    // $sql = "UPDATE todos SET deleted_at ='" . $now . "'WHERE id = '" . $id ."'";
    // $dbh->query($sql);
} 