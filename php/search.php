<?php
require_once 'connect.php'; 

$mysql->set_charset("utf8mb4"); // задаем кодировку

if (isset($_POST["searchBtn"])){
   
    $query = 'SELECT posts.title, comments.body 
            FROM posts, comments
            WHERE comments.body 
            LIKE \'%' . $_POST["input"] . '%\'
            AND comments.postId = posts.id';
            
    $result = mysqli_query($mysql, $query);

    if (mysqli_num_rows($result) == 0)
    {
         echo 'не найдено совпадений';
    }
    else
    {
        echo '
        <h2 style = "font-family:\'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif; padding: 1%; padding-left: 10%">Результаты поиска </h2>';
        while ($row = mysqli_fetch_assoc($result))
        {
            echo ' 
            <div style = "font-family:\'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;padding: 1%; padding-left: 10%">
                <h3>' . $row['title'] . '</h3>
                <p>' . $row['body'] . '</p>
            </div>';
        }
    }
    echo '<div style = "position:fixed;top: 3%; left: 3%; font-size: large"
    ><a href=../index.html>Вернуться</a></div>';
}
