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
                    <h3>Plants List</h3>
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



                $total_pages_sql = "SELECT COUNT(*) FROM medicinal_plants";
                $result = mysqli_query($connect,$total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);



                $sql = "SELECT * FROM medicinal_plants LIMIT $offset, $no_of_records_per_page";
                //$sql = "SELECT * FROM medicinal_plants";

                $run   = mysqli_query($connect, $sql);
                $count = mysqli_num_rows($run);
                if ($count <= 0) {
                    echo '<br><center>There are no published posts</center><br>';
                } else {

                    ?>
                    <!--<table width="100%" border="1">
                        <tr>
                            <th style="text-align: center;padding: 10px">Scientific Name</th>
                            <th style="text-align: center;padding: 10px">Synonym</th>
                            <th style="text-align: center;padding: 10px">Family</th>
                        </tr>-->


                        <table class="table table-bordered table-striped table-hover" id="dt-basic">
                            <thead>
                            <tr>
                                
                                <th>Scientific Name</th>
                                <th>Synonym</th>
                                <th>Family</th>
                            </tr>
                            </thead>
                    <?php
                    $serial=1;
                    while ($row = mysqli_fetch_assoc($run)) {
                        ?>
                            <tr>
                                <td style="padding: 5px">
                                   <a style="color: #1a1a1a" href="details.php?id=<?php echo $row['id']; ?>"> <?php
                                    $values=explode(' ',$row['scientific_name']);
                                    $values[0]=strtolower($values[0]);
                                    $values[1]=strtolower($values[1]);
                                    $values[0]=ucfirst($values[0]);
                                    echo '<em>' .
                                        (isset($values[0]) ? $values[0] : '') .
                                        ' ' . (isset($values[1]) ? $values[1] : '') . '</em>'.' ';
                                    for ($i = 2; $i < count($values); $i++)
                                    {
                                        echo $values[$i] ." ";
                                    }
                                    ?>
                                   </a>
                                </td>
                                <td style="padding: 5px">

                                      <?php
                                      $text =$row['synonym'];
                                      $text = isset( $text ) ? trim( $text ) : false;
                                      if ( ! empty( $text ) ) {
                                          $synonyms = explode( ',', $text );
                                          foreach ( $synonyms as $synonym ) {
                                              $values = explode( ' ', ltrim( $synonym ) );

                                              echo '<em>' .
                                                  ( isset( $values[0] ) ? $values[0] : '' ) .
                                                  ' ' . ( isset( $values[1] ) ? $values[1] : '' ) . ' </em>' . ' ';
                                              for ( $i = 2; $i < count( $values ); $i ++ ) {
                                                  echo $values[ $i ] . " ";
                                              }
                                              echo "<br>";
                                          }
                                      } else {
                                          echo "";
                                      }

                                      ?>

                                </td>
                                <td style="padding: 5px"><?php echo $row['family_name']; ?></td>
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
    <script>
        $(document).ready(function () {

            $('#dt-basic').dataTable({
                "responsive": true,
                "language": {
                    "paginate": {
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "next": '<i class="fa fa-angle-right"></i>'
                    }
                }
            });
        });
    </script>
    <br>
<?php
//sidebar();
footer();
?>