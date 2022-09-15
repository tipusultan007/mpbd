<?php
include "header.php";
?>

    <div class="col-md-9">
        <div>
            <ol class="breadcrumb">
                <li>
                    <a href="dashboard.php">Home</a>
                </li>
                <li class="active">Add Plants</li>
            </ol>
        </div>

        <div class="row">

            <div class="col-md-12 column">
                <div class="box">
                    <h4 class="box-header round-top">Add Plants</h4>
                    <div class="box-container-toggle">
                        <div class="box-content">
                                <form action="" method="post">
                                    <p>
                                        <label>Scientific Name</label>
                                        <input class="form-control" name="scientific_name" value="" type="text"
                                               required>
                                    </p><br/>
                                    <p>
                                        <label>Synonym</label>
                                        <textarea class="form-control" name="synonym" ></textarea>
                                    </p><br/>
                                    <p>
                                        <label>Bangla Name</label>
                                        <input class="form-control" name="bangla_name" value="" type="text"
                                               >
                                    </p><br/>
                                    <p>
                                        <label>English Name</label>
                                        <input class="form-control" name="english_name" value="" type="text" >
                                    </p><br/>
                                    <p>
                                        <label>Family Name</label>
                                        <input class="form-control" name="family_name" value="" type="text"
                                               >
                                    </p><br/>
                                    <p>
                                        <label>Disease</label>
                                        <input class="form-control" name="disease" value="" type="text" >
                                    </p><br/>
                                    <p>
                                        <label>Description</label>
                                        <textarea class="form-control" name="description"></textarea>
                                    </p><br/>
                                    <p>
                                        <label>Distribution</label>
                                        <input class="form-control" name="distribution" value="" type="text" >
                                    </p><br/>
                                    <p>
                                        <label>Chemical Constituents</label>
                                        <input class="form-control" name="chemical_constituents" value="" type="text"
                                               >
                                    </p><br/>
                                    <p>
                                        <label>Uses</label>
                                        <input class="form-control" name="uses" value="" type="text" >
                                    </p><br/>
                                    <p>
                                        <label>Habit</label>
                                        <input class="form-control" name="habit" value="" type="text">
                                    </p><br/>
                                    <p>
                                        <label>Image</label>
                                        <input class="form-control" name="image" value="" type="file" >
                                    </p><br/>
                                    <div class="form-actions">
                                        <input type="submit" name="add" class="btn btn-primary" value="Add"/>
                                        <input type="reset" class="btn" value="Reset"/>
                                    </div>
                                </form>

                                <?php
                                if (isset($_POST['add'])) {
                                    $scientific_name = addslashes($_POST['scientific_name']);
                                    $synonym= htmlspecialchars($_POST['synonym']);
                                    $bangla_name = addslashes($_POST['bangla_name']);
                                    $english_name = addslashes($_POST['english_name']);
                                    $family_name = addslashes($_POST['family_name']);
                                    $disease = addslashes($_POST['disease']);
                                    $description = htmlspecialchars($_POST['description']);
                                    $distribution = addslashes($_POST['distribution']);
                                    $chemical_constituents = addslashes($_POST['chemical_constituents']);
                                    $uses = addslashes($_POST['uses']);
                                    $habit = addslashes($_POST['habit']);
                                    $image = addslashes($_POST['image']);

                                    $add = "INSERT INTO `medicinal_plants`(`scientific_name`, `synonym`, `bangla_name`, `english_name`, `family_name`, `disease`, `description`, `distribution`, `chemical_constituents`, `uses`, `habit`, `image`) VALUES (`$scientific_name`, `$synonym`, `$bangla_name`, `$english_name`, `$family_name`, `$disease`, `$description`, `$distribution`, `$chemical_constituents`, `$uses`, `$habit`, `$image`)";
                                    $sql = mysqli_query($connect, $add);

                                    $run = mysqli_query($connect, "SELECT * FROM `settings`");
                                    $site = mysqli_fetch_assoc($run);
                                    $from = $site['email'];
                                    $sitename = $site['sitename'];

                                    $run3 = mysqli_query($connect, "SELECT * FROM `medicinal_plants` WHERE scientific_name='$scientific_name'");
                                    $row3 = mysqli_fetch_assoc($run3);
                                    $id3 = $row3['id'];

                                    $run2 = mysqli_query($connect, "SELECT * FROM `newsletter`");
                                    while ($row = mysqli_fetch_assoc($run2)) {
                                        $emails = $row['email'];

                                        $to = $emails;

                                        $subject = $title;

                                        $message = '
<html>
<head>
  <title>' . $title . '</title>
</head>
<body>
  <center><a href="' . $site_url . '/post.php?id=' . $id3 . '" title="Read more"><h2>' . $title . '</h2></a></center><br />
  <center><img src="' . $image . '" width="600px" height="350px"/></center><br />
  ' . html_entity_decode($content) . '
</body>
</html>
';

                                        $headers = 'MIME-Version: 1.0' . "\r\n";
                                        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

                                        $headers .= 'To: ' . $emails . ' <' . $emails . '>' . "\r\n";
                                        $headers .= 'From: ' . $sitename . ' <' . $from . '>' . "\r\n";

                                        @mail($to, $subject, $message, $headers);
                                    }

                                    echo '<meta http-equiv="refresh" content="0;url=posts.php">';
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>

    <script>
        CKEDITOR.replace('synonym');
        CKEDITOR.replace('description');
    </script>
<?php
include "footer.php";
?>