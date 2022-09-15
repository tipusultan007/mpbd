<?php
include "header.php";

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $query = mysqli_query($connect, "DELETE FROM `contributors` WHERE id='$id'");
}
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Pages</li>
        </ol>
      </div>
	  
	  <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Contributors</h4>
              <div class="box-container-toggle">
                  <div class="box-content">
				  <center><a href="add_contributors.php" class="btn btn-default"><i class="fa fa-edit"></i> Add Contributor</a></center><br />
<?php
$sql    = "SELECT * FROM contributors ORDER by id DESC";
$result = mysqli_query($connect, $sql);
$count  = mysqli_num_rows($result);
if ($count <= 0) {
    echo 'There are no contributors.';
} else {
    echo '
            <table class="table table-bordered table-striped table-hover">
                <thead>
				<tr>
                    <th>ID</th>
                    <th>Title</th>
					<th>Actions</th>
                </tr>
				</thead>
';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                <tr>
	                <td>' . $row['id'] . '</td>
	                <td>' . $row['title'] . '</td>
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
?></center>
                  </div>
              </div>
            </div>
        </div>
      </div>
 
<?php
if (isset($_GET['edit-id'])) {
    $id  = (int) $_GET["edit-id"];
    $sql = mysqli_query($connect, "SELECT * FROM `contributors` WHERE id = '$id'");
    $row = mysqli_fetch_assoc($sql);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=contributors.php">';
    }
    if (mysqli_num_rows($sql) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=contributors.php">';
    }
?>
    <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Edit Page</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
<center><form action="" method="post">
<p>
	<label>Title</label>
	<input name="title" type="text" class="form-control" value="<?php
    echo $row['title'];
?>" required>
</p>
<p>
	<label>Content</label>
	<textarea name="content" required><?php
    echo html_entity_decode($row['content']);
?></textarea>
</p>
<br /><input type="submit" class="btn btn-primary" name="submit" value="Update" /><br />
</form>
<?php
    if (isset($_POST['submit'])) {
        $title   = addslashes($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        
        $update = "UPDATE contributors SET title='$title', content='$content' WHERE id='$id'";
        $sql    = mysqli_query($connect, $update);
        echo '<meta http-equiv="refresh" content="0; url=contributors.php">';
    }
?></center>
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
    CKEDITOR.replace( 'content' );
</script>
<?php
include "footer.php";
?>