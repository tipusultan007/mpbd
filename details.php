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
                        echo '<meta http-equiv="refresh" content="0; url=plants.php">';
                    }

                    $runq = mysqli_query($connect, "SELECT * FROM `medicinal_plants` WHERE id='$id'");
                    if (mysqli_num_rows($runq) == 0) {
                        echo '<meta http-equiv="refresh" content="0; url=plants.php">';
                    }

                    //mysqli_query($connect, "UPDATE `medicinal_plants` SET views = views + 1 WHERE id='$id'");
                    $row = mysqli_fetch_assoc($runq);
                    //$post_id = $row['id'];
                   // $runq3 = mysqli_query($connect, "SELECT * FROM `comments` WHERE post_id='$post_id' AND approved='Yes'");
                    //$uNum = mysqli_num_rows($runq3);
                    //$category_id = $row['category_id'];
                    //$runq4 = mysqli_query($connect, "SELECT * FROM `categories` WHERE id='$category_id'");
                    //$cat = mysqli_fetch_array($runq4);

                    ?>

                    <article class="blog-post">
                        <div class="block-grey">
                            <div class="block-light">
                                <div class="wrapper-img">
                                    <img src="<?php echo $row['image'] ; ?>" width="100%" height="260"/>
                                </div>
                                <div class="wrapper">
                                    <h2 class="post-title">
                                        <?php
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

                                    </h2><hr />
                                    <table>

                                        <tr style="border-bottom: 1px solid #e0e0e0"><th style="width: 15%"><strong>Synonym :</strong></th><td style="padding:10px;"> <?php

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
									</tr>
                                        <tr style="border-bottom: 1px solid #e0e0e0"><th style="width: 15%"><strong>Bangla Name : </strong></th><td style="padding:10px;"><?php echo html_entity_decode($row['bangla_name']) ; ?></td></tr>
                                        <tr style="border-bottom: 1px solid #e0e0e0"><th style="width: 15%"><strong>English Name : </strong></th><td style="padding:10px;"><?php echo html_entity_decode($row['english_name']) ; ?></td></tr>
                                        <tr style="border-bottom: 1px solid #e0e0e0"><th style="width: 15%"><strong>Family : </strong></th><td style="padding:10px;"><?php echo html_entity_decode($row['family_name']) ; ?></td></tr>
                                        <tr style="border-bottom: 1px solid #e0e0e0"><th style="width: 15%"><strong>Disease : </strong></th><td style="padding:10px;"><?php echo html_entity_decode($row['disease']) ; ?></td></tr>
                                        <tr style="border-bottom: 1px solid #e0e0e0"><th style="width: 15%"><strong>Description : </strong></th><td style="padding:10px;"><?php echo html_entity_decode($row['description']) ; ?></td></tr>
                                        <tr style="border-bottom: 1px solid #e0e0e0"><th style="width: 15%"><strong>Distribution : </strong></th><td style="padding:10px;"><?php echo html_entity_decode($row['distribution']) ; ?></td></tr>
                                        <tr style="border-bottom: 1px solid #e0e0e0"><th style="width: 15%"><strong>Chemical Constituents : </strong></th><td style="padding:10px;"><?php echo html_entity_decode($row['chemical_constituents']) ; ?></td></tr>
                                        <tr style="border-bottom: 1px solid #e0e0e0"><th style="width: 15%"><strong>Uses : </strong></th><td style="padding:10px;"><?php echo html_entity_decode($row['uses']) ; ?></td></tr>
                                        <tr style="border-bottom: 1px solid #e0e0e0"><th style="width: 15%"><strong>Habit : </strong></th><td style="padding:10px;"><?php echo html_entity_decode($row['habit']) ; ?></td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>
            </div>
        </div>
    </div>



<?php
//sidebar();
footer();
?>