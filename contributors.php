<?php
include "core.php";
head();

$id = (int) $_GET['id'];
if (empty($id)) {
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
}

$run = mysqli_query($connect, "SELECT * FROM `contributors` WHERE id='$id' LIMIT 1");
if (mysqli_num_rows($run) == 0) {
    echo '<meta http-equiv="refresh" content="0; url=index.php">';
}

$row = mysqli_fetch_assoc($run);
?>
    <div class="container">
        <div class="row">
        <?php
        sidebar();
        ?>
            <div class="col-md-8">

                    <section class="alignleft col-md-12">
                                <div class="title-divider">
                                    <h3><?php echo $row['title'] ;?></h3>
                                    <div class="divider-arrow"></div>
                                </div>
                                <div class="block-grey">
                                    <div class="block-light wrap15">
                                    <?php echo $row['content'];?>
                                    </div>
                                </div>
                    </section>
				</div>
        </div>
    </div>
    <br>
    </div>
<?php

//sidebar();
footer();
?>