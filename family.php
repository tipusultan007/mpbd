<?php
include "core.php";
head();
?>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ism-slider" id="my-slider">
                    <ol>
                        <li>
                            <img src="ism/image/slides/_u/1580713133781_337682.jpg">
                           
                        </li>
                        <li>
                            <img src="ism/image/slides/_u/1580713133713_104895.jpg">
                           
                        </li>
                        <li>
                            <img src="ism/image/slides/_u/1580713133570_604754.jpg">
                            
                        </li>
                    </ol>
                </div>
            </div>


            <?php
            sidebar();
            ?>
            <div class="col-md-8">

                <section class="alignleft col-md-12">
                    <div class="title-divider">
                        <h3>Family Names List</h3>
                        <div class="divider-arrow"></div>
                    </div>
                    <?php
                    $run = mysqli_query($connect, "SELECT DISTINCT family_name FROM `medicinal_plants`");
                    $count = mysqli_num_rows($run);
                    if ($count <= 0) {
                        echo '<br><center>There are no published posts</center><br>';
                    } else {

                        ?>
                        <ul style="columns: 4 160px;column-width: 160px;">
                            <?php
                            while ($row = mysqli_fetch_assoc($run)) {
                                ?>
                                <li>
                                    <a href="plants-by-family.php?family=<?php echo $row['family_name']; ?>"
                                       style="padding: 5px"><?php echo $row['family_name']; ?></a>
                                </li>

                                <?php
                            }
                            ?>
                        </ul>


                        <?php
                    }
                    ?>

                </section>
                <br>

            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

<?php
//sidebar();
footer();
?>