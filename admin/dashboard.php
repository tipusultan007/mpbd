<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li><a href="dashboard.php">Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </div>

	  <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Shortcuts</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
				  <ul class="shortcut-list">
							<li><a href="add_post.php"><i class="fa fa-edit fa-2x"></i><br /><br /> Add Plant</a></li>
							<li><a href="settings.php"><i class="fa fa-cogs fa-2x"></i><br /><br /> Settings</a></li>

							<li><a href="menu_editor.php"><i class="fa fa-bars fa-2x"></i><br /><br /> Menu Editor</a></li>
							<li><a href="add_page.php"><i class="fa fa-file-text-o fa-2x"></i><br /><br /> Add Page</a></li>
							<li><a href="add_widget.php"><i class="fa fa-archive fa-2x"></i><br /><br /> Add Widget</a></li>
							<li><a href="upload_file.php"><i class="fa fa-upload fa-2x"></i><br /><br /> Upload File</a></li>

						</ul>
				  </div>
              </div>
            </div>
        </div>
      </div>
	  
	  <div class="row">

         <div class="col-md-6 column">
             <div class="box">
              <h4 class="box-header round-top">Statistics</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
					<ul class="dashboard-statistics">
<?php
$query = mysqli_query($connect, "SELECT id FROM medicinal_plants");
$total = mysqli_num_rows($query);
?>
                      <li>
                        <a href="posts.php">
						    <i class="fa fa-list"></i>
						    <span class="green"><?php
echo $total;
?></span>
                            Medicinal Plants
                        </a>
                      </li>


<?php
$query = mysqli_query($connect, "SELECT id FROM gallery");
$total = mysqli_num_rows($query);
?>
					  <li>
                        <a href="gallery.php">
						    <i class="fa fa-picture-o"></i>
						    <span class="green"><?php
echo $total;
?></span>
                            Images
                        </a>
                      </li>
<?php
$query = mysqli_query($connect, "SELECT id FROM pages");
$total = mysqli_num_rows($query);
?>
					  <li>
                        <a href="pages.php">
						    <i class="fa fa-file-text-o"></i>
						    <span class="green"><?php
echo $total;
?></span>
                            Pages
                        </a>
                      </li>
<?php
$query = mysqli_query($connect, "SELECT id FROM widgets");
$total = mysqli_num_rows($query);
?>
					  <li>
                        <a href="widgets.php">
						    <i class="fa fa-archive"></i>
						    <span class="green"><?php
echo $total;
?></span>
                            Widgets
                        </a>
                      </li>
<?php
$query = mysqli_query($connect, "SELECT id FROM files");
$total = mysqli_num_rows($query);
?>
					  <li>
                        <a href="files.php">
						    <i class="fa fa-files-o"></i>
						    <span class="green"><?php
echo $total;
?></span>
                            Files
                        </a>
                      </li>


                    </ul>
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