<?php
$mysql = mysqli_connect('localhost', 'root', 'root', 'blog-db') 
    or die('Could not connect: ' . mysqli_connect_error());