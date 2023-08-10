<?php
session_start();

// Include the database connection and Post class
include_once('../config/database.php');
include_once('../class/Post.php');
include('../include/header.php');
include('../include/navbar.php');

$post=new post($pdo);

if(isset($_GET['id']))
{
    if($post->readOne($_GET['id']))
    {
        $post2=$post->readOne($_GET['id']);
    }
}

if (isset($_POST['delete_post'])) {
    $post->id = $_GET['id'];
    if ($post->delete()) {
        header('Location:../index.php');
    }
    else
    {
        echo "error";
    }
}




?>

<!-- Page Header-->
<header class="masthead" style="background-image: url('../assets/img/post-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
    <?php if($_SESSION['user_id']==$post2['author_id']) {?>
        <form method="post">
            <button class="btn" type="submit" name="delete_post"><i class="fas fa-trash text-white fs-3"></i></button>
        </form>
        <a href=<?= "edit_post.php?id=" . $_GET['id'] ?> class=" btn" type="submit"><i
                class="fas fa-edit text-white fs-3"></i></a>
        <?php }?>
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="post-heading">
                <h2>
                    <?php
                    if (isset($post2['title'])) :
                        echo $post2['title'];
                    endif
                    ?>
                </h2>

                <span class="meta">

                    Posted by
                    <a href="#!">
                        <?php
                        if (isset($post2['author_name'])) :
                            echo $post2['author_name'];
                        endif
                        ?>
                    </a>
                    <?php
                    if ($post) :
                        echo $post2['created_at'];
                    endif
                    ?>
                </span>
            </div>
        </div>
    </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>
                    <?php
                    if ($post) :
                        echo $post2['content'];
                    endif
                    ?>
                </p>
            </div>
        </div>
    </div>
</article>

<?php
    include('../include/footer.php');
?>