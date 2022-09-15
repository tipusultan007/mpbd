<?php
include "header.php";

if (isset($_GET['delete-id'])) {
    $id = (int)$_GET["delete-id"];
    $query = mysqli_query($connect, "DELETE FROM `medicinal_plants` WHERE id='$id'");
}
?>

    <div class="col-md-9">
        <div>
            <ol class="breadcrumb">
                <li>
                    <a href="dashboard.php">Home</a>
                </li>
                <li class="active">Posts</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md-12 column">
                <div class="box">
                    <h4 class="box-header round-top">Posts</h4>
                    <div class="box-container-toggle">
                        <div class="box-content">
                            <a href="add_post.php" class="btn btn-default"><i class="fa fa-edit"></i> Add
                                Plants</a><br/>
                            <?php
                            $i = 1;
                            $sql = "SELECT * FROM medicinal_plants ORDER by id asc";
                            $result = mysqli_query($connect, $sql);
                            $count = mysqli_num_rows($result);
                            if ($count <= 0) {
                                echo 'There are no posts.';
                            } else {
                            echo '
            <table class="table table-responsive table-bordered table-striped table-hover" id="dt-basic">
                <thead>
				<tr>
				    <th>ID</th>
                   
                    <th>Scientific Name</th>
                    <th>Synonym</th>
					<th>Family</th>
					<th>Actions</th>
                </tr>
				</thead>
';
                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>

                            <tr>
                                <td><?php echo $i++; ?></td>

                                <td>
                                    <?php
                                    $values = explode(' ', $row['scientific_name']);
                                    $values[0] = strtolower($values[0]);
                                    $values[1] = strtolower($values[1]);
                                    $values[0] = ucfirst($values[0]);
                                    echo '<em>' .
                                        (isset($values[0]) ? $values[0] : '') .
                                        ' ' . (isset($values[1]) ? $values[1] : '') . '</em>' . ' ';
                                    for ($i = 2; $i < count($values); $i++) {
                                        echo $values[$i] . " ";
                                    }
                                    ?>

                                </td>
                                <td> <?php
                                    $text = $row['synonym'];
                                    $text = isset($text) ? trim($text) : false;
                                    if (!empty($text)) {
                                        $synonyms = explode(',', $text);
                                        foreach ($synonyms as $synonym) {
                                            $values = explode(' ', ltrim($synonym));

                                            echo '<em>' .
                                                (isset($values[0]) ? $values[0] : '') .
                                                ' ' . (isset($values[1]) ? $values[1] : '') . ' </em>' . ' ';
                                            for ($i = 2; $i < count($values); $i++) {
                                                echo $values[$i] . " ";
                                            }
                                            echo "<br>";
                                        }
                                    } else {
                                        echo "";
                                    }

                                    ?> </td>

                                <td><?php echo $row['family_name']; ?></td>

                                <?php

                                echo '
                    
					<td>
					    <a href="?edit-id=' . $row['id'] . '" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
						<a href="?delete-id=' . $row['id'] . '" title="Delete" class="btn btn-danger"><i class="fa fa-remove"></i> Delete</a>
					</td>
                </tr>
';
                                }
                                echo '
            </table>
';
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_GET['edit-id'])) {
            $id = (int)$_GET["edit-id"];
            $sql = mysqli_query($connect, "SELECT * FROM `medicinal_plants` WHERE id = '$id'");
            $row = mysqli_fetch_assoc($sql);
            if (empty($id)) {
                echo '<meta http-equiv="refresh" content="0; url=posts.php">';
            }
            if (mysqli_num_rows($sql) == 0) {
                echo '<meta http-equiv="refresh" content="0; url=posts.php">';
            }
            ?>
            <div class="row">
                <div class="col-md-12 column">
                    <div class="box">
                        <h4 class="box-header round-top">Edit Post</h4>
                        <div class="box-container-toggle">
                            <div class="box-content">
                                <center>
                                    <form action="" method="post">
                                        <p>
                                            <label>Scientific Name</label>
                                            <input class="form-control" name="scientific_name" value="<?php
                                            echo $row['scientific_name'];
                                            ?>" type="text"
                                                   required>
                                        </p><br/>
                                        <p>
                                            <label>Synonym</label>
                                            <textarea class="form-control" name="synonym"><?php
                                                echo $row['synonym'];
                                                ?></textarea>
                                        </p><br/>
                                        <p>
                                            <label>Bangla Name</label>
                                            <input class="form-control" name="bangla_name" value="<?php
                                            echo $row['bangla_name'];
                                            ?>" type="text"
                                            >
                                        </p><br/>
                                        <p>
                                            <label>English Name</label>
                                            <input class="form-control" name="english_name" value="<?php
                                            echo $row['english_name'];
                                            ?>" type="text">
                                        </p><br/>
                                        <p>
                                            <label>Family Name</label>
                                            <input class="form-control" name="family_name" value="<?php
                                            echo $row['family_name'];
                                            ?>" type="text"
                                            >
                                        </p><br/>
                                        <p>
                                            <label>Disease</label>
                                            <input class="form-control" name="disease" value="<?php
                                            echo $row['disease'];
                                            ?>" type="text">
                                        </p><br/>
                                        <p>
                                            <label>Description</label>
                                            <textarea class="form-control" name="description"><?php
                                                echo $row['description'];
                                                ?></textarea>
                                        </p><br/>
                                        <p>
                                            <label>Distribution</label>
                                            <input class="form-control" name="distribution" value="<?php
                                            echo $row['distribution'];
                                            ?>" type="text">
                                        </p><br/>
                                        <p>
                                            <label>Chemical Constituents</label>
                                            <input class="form-control" name="chemical_constituents" value="<?php
                                            echo $row['chemical_constituents'];
                                            ?>"
                                                   type="text"
                                            >
                                        </p><br/>
                                        <p>
                                            <label>Uses</label>
                                            <input class="form-control" name="uses" value="<?php
                                            echo $row['uses'];
                                            ?>" type="text">
                                        </p><br/>
                                        <p>
                                            <label>Habit</label>
                                            <input class="form-control" name="habit" value="<?php
                                            echo $row['habit'];
                                            ?>" type="text">
                                        </p><br/>
                                        <p>
                                            <label>Image</label>
                                            <input class="form-control" name="image" value="" type="file">
                                        </p><br/>
                                        <div class="form-actions">
                                            <input type="submit" name="add" class="btn btn-primary" value="Add"/>
                                            <input type="reset" class="btn" value="Reset"/>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $title = addslashes($_POST['title']);
                                        $image = addslashes($_POST['image']);
                                        $active = addslashes($_POST['active']);
                                        $category_id = addslashes($_POST['category_id']);
                                        $content = htmlspecialchars($_POST['content']);

                                        $edit = "UPDATE posts SET title='$title', image='$image', active='$active', category_id='$category_id', content='$content' WHERE id='$id'";
                                        $sql = mysqli_query($connect, $edit);
                                        echo '<meta http-equiv="refresh" content="0;url=posts.php">';
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
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
    <script>
        CKEDITOR.replace('content');
    </script>
<?php
include "footer.php";
?>