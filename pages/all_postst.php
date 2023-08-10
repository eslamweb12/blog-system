<?php
require_once('../config/database.php');
require_once('../class/post.php');


$post = new Post($pdo);


$posts = $post->readAllPosts();

if($posts)
print_r($posts);


?>