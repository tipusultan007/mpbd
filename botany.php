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
                        <h3>Botany Terms</h3>
                        <div class="divider-arrow"></div>
                    </div>
                    <?php


                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }
                    $no_of_records_per_page = 10;
                    $offset = ($pageno-1) * $no_of_records_per_page;



                    $total_pages_sql = "SELECT COUNT(*) FROM botanies";
                    $result = mysqli_query($connect,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);



                    $sql = "SELECT * FROM botanies LIMIT $offset, $no_of_records_per_page";

                    $run   = mysqli_query($connect, $sql);
                    $count = mysqli_num_rows($run);
                    if ($count <= 0) {
                        echo '<br><center>There are no published posts</center><br>';
                    } else {

                        ?>
                        <table border="1">
                            <tr>
                                <th style="text-align: center"> Name</th>
                                <th style="text-align: center"> Structure/ Category</th>
                                <th style="text-align: center">Description</th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($run)) {
                                ?>
                                <tr>
                                    <td style="padding: 10px">
                                        <a style="color: #1a1a1a" href=""> <?php
                                            echo $row['name'];
                                            ?>
                                        </a>
                                    </td>
                                    <td style="padding: 10px">

                                        <?php
                                        echo $row['structure_category'];
                                        ?>

                                    </td>
                                    <td style="padding: 10px"><?php echo $row['description']; ?></td>
                                </tr>


                                <?php
                            }




                            ?>
                        </table>
                        <?php
                    }
                    ?>

                </section>

                <section class="alignleft col-md-12">
                    <ul class="pagination">
                        <li><a href="?pageno=1">First</a></li>
                        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                        </li>
                        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                        </li>
                        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
                    </ul>
                </section>

            </div>
        </div>
    </div>

<?php
//sidebar();
footer();
?>