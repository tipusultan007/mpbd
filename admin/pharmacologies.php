<?php
include "header.php";

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $query = mysqli_query($connect, "DELETE FROM `pharmacologies` WHERE id='$id'");
}
?>

    <div class="col-md-9">
        <div>
            <ol class="breadcrumb">
                <li>
                    <a href="dashboard.php">Home</a>
                </li>
                <li class="active">pharmacologies</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md-12 column">
                <div class="box">
                    <h4 class="box-header round-top">Pharmacologies</h4>
                    <div class="box-container-toggle">
                        <div class="box-content">
                            <center><a href="add_botany.php" class="btn btn-default"><i class="fa fa-edit"></i> Add Pharmacology Term</a></center><br />
                            <table class="table table-striped table-bordered bootstrap-datatable" id="datatable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = mysqli_query($connect, "SELECT * FROM pharmacologies ORDER by id ASC");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    echo '
                            <tr>
                                <td>' . $row['id'] . '</td>
                                <td>' . $row['name'] . '</td>
                                <td>
                                    <a class="btn btn-primary" href="?edit-id=' . $row['id'] . '">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger" href="?delete-id=' . $row['id'] . '">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_GET['edit-id'])) {
        $id  = (int) $_GET["edit-id"];
        $sql = mysqli_query($connect, "SELECT * FROM `pharmacologies` WHERE id = '$id'");
        $row = mysqli_fetch_assoc($sql);
        if (empty($id)) {
            echo '<meta http-equiv="refresh" content="0; url=pharmacologies.php">';
        }
        if (mysqli_num_rows($sql) == 0) {
            echo '<meta http-equiv="refresh" content="0; url=pharmacologies.php">';
        }
        ?>
        <div class="row">
            <div class="col-md-12 column">
                <div class="box">
                    <h4 class="box-header round-top">Edit Pharmacology - <?php
                        echo $row['name'];
                        ?></h4>
                    <div class="box-container-toggle">
                        <div class="box-content">
                            <center><form action="" method="post">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Name: </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="name" class="form-control" value="<?php
                                            echo $row['name'];
                                            ?>" required>
                                        </div>
                                    </div><br />
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Description: </label>
                                        <div class="col-sm-8">
                                            <textarea name="description" class="form-control"><?php
                                                echo $row['description'];
                                                ?></textarea>
                                        </div>
                                    </div>
                                    <br />
                                    <br>
                                    <div class="form-actions">
                                        <input type="submit" name="edit" class="btn btn-primary" value="Save" />
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['edit'])) {
                                    $name = $_POST['name'];
                                   // $structure = $_POST['structure_category'];
                                    $description = $_POST['description'];

                                    $query = mysqli_query($connect, "UPDATE `pharmacologies` SET name='$name', description='$description' WHERE id='$id'");

                                    echo '<meta http-equiv="refresh" content="0;url=pharmacologies.php">';
                                }
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

<?php
include "footer.php";
?>