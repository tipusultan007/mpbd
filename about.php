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
                    <div class="title-divider">
                        <h3>About MPBD</h3>
                        <div class="divider-arrow"></div>
                    </div>
                    <div class="block-grey">
                        <div class="block-light wrap15">
                            <?php
                            $run = mysqli_query($connect, "SELECT * FROM `pages` WHERE id=1");
                            $row = mysqli_fetch_assoc($run);
                            echo html_entity_decode($row['content']);
                            ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <br>
<?php
//sidebar();
footer();
?>