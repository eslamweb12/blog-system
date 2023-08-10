<?php
session_start();
require_once('../include/header.php');
require_once('../include/navbar.php');
require_once ('../config/database.php');
require_once('../class/post.php');





$post = new Post($pdo);
$posts = $post->readAllPosts();









?>



    <header class="masthead" style="background-image: url('../assets/img/home-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Clean Blog</h1>
                        <span class="subheading">A Blog Website by Tech Time</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">

                <?php foreach ($posts as $post) { ?>
                <div class="post-preview">
                    <a href=<?="post.php?id=". $post['id'] ?>>
                        <h2 class="post-title"><?php echo $post['title'] ?></h2>
                        <h3 class="post-subtitle"><?php echo $post['content']; ?></h3>
                    </a>
                    <p class="post-meta">
                        Posted by
                        <a href="#!"><?php echo $post['username']; ?></a>
                        <?php echo $post['created_at']; ?>
                    </p>
                </div>


                <?php } ?>
                <!-- Divider-->
                <hr class="my-4" />
                <!-- Pager-->
                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older
                        Posts
                        →</a></div>
            </div>
        </div>
    </div>







    <?php
include('../include/footer.php' );
?>