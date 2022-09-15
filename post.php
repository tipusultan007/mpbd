<?php
include "core.php";
head();
?>
    <div class="container">
        <div class="row">
            <?php
            sidebar();
            ?>
            <div class="col-md-8">

                <section class="alignleft col-md-12">
                    <?php
                    $id = (int)$_GET['id'];

                    if (empty($id)) {
                        echo '<meta http-equiv="refresh" content="0; url=blog.php">';
                    }

                    $runq = mysqli_query($connect, "SELECT * FROM `posts` WHERE id='$id'");
                    if (mysqli_num_rows($runq) == 0) {
                        echo '<meta http-equiv="refresh" content="0; url=blog.php">';
                    }

                    mysqli_query($connect, "UPDATE `posts` SET views = views + 1 WHERE active='Yes' and id='$id'");
                    $row = mysqli_fetch_assoc($runq);
                    $post_id = $row['id'];
                    $runq3 = mysqli_query($connect, "SELECT * FROM `comments` WHERE post_id='$post_id' AND approved='Yes'");
                    $uNum = mysqli_num_rows($runq3);
                    $category_id = $row['category_id'];
                    $runq4 = mysqli_query($connect, "SELECT * FROM `categories` WHERE id='$category_id'");
                    $cat = mysqli_fetch_array($runq4);
                    echo '
                    <article class="blog-post">
                        <div class="block-grey">
                            <div class="block-light">
                                <div class="wrapper-img">
                                    <img src="' . $row['image'] . '" width="100%" height="260"/>
                                </div>
                                <div class="wrapper">
                                    <h2 class="post-title">' . $row['title'] . '</h2><hr />
                                    ' . html_entity_decode($row['content']) . '
									<hr>
                                   
';
                    ?>


            </div>
        </div>
    </div>

    </div>

    </article>
    </section>
    </div>
    </div>
<?php
//sidebar();
footer();
?>