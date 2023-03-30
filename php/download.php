<?php
//чтение файлов
$posts = file_get_contents('https://jsonplaceholder.typicode.com/posts'); 
$comments = file_get_contents('https://jsonplaceholder.typicode.com/comments');
//сохраниение файлов
file_put_contents('../json/posts.json', $posts);
file_put_contents('../json/comments.json', $comments);

$posts = json_decode($posts, true);
$comments = json_decode($comments, true);

require_once 'connect.php'; 



foreach ($posts as $post){
    $stmt = $mysql->prepare("INSERT INTO posts(userId,id,title,body) VALUES (?,?,?,?)");
    $stmt->bind_param("iiss", $post['userId'], $post['id'], $post['title'], $post['body'] );
    $stmt->execute();
    $stmt->close();
};

foreach ($comments as $comment){
    $stmt = $mysql->prepare("INSERT INTO comments(postId,id,name,email,body) VALUES (?,?,?,?,?)");
    $stmt->bind_param("iisss", $comment['postId'], $comment['id'], $comment['name'],$comment['email'], $comment['body'] );
    $stmt->execute();
    $stmt->close();
};

$result = "Загружено ". count($posts) . " записей и ". count($comments) ." комментариев";
echo $result;
echo "<p><a href=../index.html>Вернуться</a></p>";