<?php
$configfile = 'config.php';
if (!file_exists($configfile)) {
    echo '<meta http-equiv="refresh" content="0; url=install" />';
    exit();
}
session_start();
include "config.php";
//Data Sanitization
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
function short_text($text, $length)
{
    $maxTextLenght = $length;
    $aspace = " ";
    if (strlen($text) > $maxTextLenght) {
        $text = substr(trim($text), 0, $maxTextLenght);
        $text = substr($text, 0, strlen($text) - strpos(strrev($text), $aspace));
        $text = $text . '...';
    }
    return $text;
}

function head()
{
    include "config.php";
    ?>
    <!DOCTYPE html>
    <html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?php
        $run = mysqli_query($connect, "SELECT * FROM `settings`");
        $site = mysqli_fetch_assoc($run);
        ?>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php
            echo $site['sitename']." | Medicinal Plants of Bangladesh";
            ?></title>
        <meta name="description" content="<?php
        echo $site['description'];
        ?>"/>
        <meta name="keywords" content="<?php
        echo $site['keywords'];
        ?>"/>
        <meta name="author" content="Antonov_WEB"/>

        <meta name="robots" content="index, follow, all"/>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <link rel="shortcut icon" href="assets/img/favicon.png" type="image/png"/>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css"
              rel="stylesheet"/>
        <link href="https://bootswatch.com/flatly/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css"
              rel="stylesheet"/>
        <link href="assets/css/style.css" type="text/css" rel="stylesheet"/>

        <link href="assets/plugins/datatables/datatables.min.css" rel="stylesheet">

        <link rel="stylesheet" href="ism/css/my-slider.css"/>
        <script src="ism/js/ism-2.2.min.js"></script>
        <script type="text/javascript" src="script.js"></script>

    </head>
    <body>
    <section id="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="index.php"><h1 style="font-size: 50px; vertical-align: middle;"><?php
                            echo $site['sitename'];
                            ?></h1></a>
                </div>
                <div class="col-md-4">
                     <div class="col-md-12 center">
                         <img style="float:left;padding-right:10px" src="assets/img/cu.png" height="95">
                        <img style="float:left;padding-right:10px" src="assets/img/echo.png">
                        <img style="float:left" src="assets/img/mpbd.png" width= "100">
                    </div>
                </div>
                <div class="col-md-4" align="right">
                    <a href="<?php
                    echo $site['facebook'];
                    ?>" target="_blank"><i class="fa fa-facebook-official fa-2x"></i></a>
                    <a href="<?php
                    echo $site['twitter'];
                    ?>" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a>
                    <a href="<?php
                    echo $site['youtube'];
                    ?>" target="_blank"><i class="fa fa-youtube-square fa-2x"></i></a>
                </div>
            </div>
        </div>
    </section>
    <header id="header">
        <div class="container">
            <br/>

            <nav style="background-color: #28A745" class="navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button id="nav-toggle-button" type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul id="nav-menu" class="nav navbar-nav">

                            <?php
    $runq = mysqli_query($connect, "SELECT * FROM `menu`");

    while ($row = mysqli_fetch_assoc($runq)) {
        if ($row['path'] == 'dictionary.php'){
            echo '<li class="dropdown';
            if (basename($_SERVER['SCRIPT_NAME']) == 'dictionary.php' || basename($_SERVER['SCRIPT_NAME']) == 'dictionary.php') {
                echo ' active';
            }
            echo '">
                <a href="dictionary.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa ' . $row['fa_icon'] . '"></i> ' . $row['page'] . ' <span class="caret"></span></a>
                <ul id="d-menu" class="dropdown-menu">';

            echo '<li><a href="botany.php">Botany</a></li>';
            echo '<li><a href="pharmacology.php">Pharmacology</a></li>';
            echo '<li><a href="page.php?id=3">Publications</a></li>';
            echo '</ul></li>';
        } else {
            echo '<li ';
            if (basename($_SERVER['SCRIPT_NAME']) == $row['path']) {
                echo 'class="active"';
            }
            echo '><a href="' . $row['path'] . '"><i class="fa ' . $row['fa_icon'] . '"></i> ' . $row['page'] . '</a></li>';
        }
    }
?>
                            <?php
                            echo '<li class="dropdown';
                            if (basename($_SERVER['SCRIPT_NAME']) == 'contributors.php' || basename($_SERVER['SCRIPT_NAME']) == 'contributors.php') {
                                echo ' active';
                            }
                            echo '">
                <a href="contributors.php" class="dropdown-toggle" data-toggle="dropdown"> Contributors & Advisors <span class="caret"></span></a>
                <ul id="d-menu" class="dropdown-menu">';

                            echo '<li><a href="page.php?id=4">Dr. Shaikh Bokhtear Uddin</a></li>';
                            echo '<li><a href="page.php?id=5">Dr. Mohammad Yusuf</a></li>';
                            echo '<li><a href="page.php?id=6">M. K. Pasha</a></li>';
                            echo '<li><a href="page.php?id=7">Dr. Mohammad Omar Faruque</a></li>';
                            echo '</ul></li>';
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
    </header>
    <?php
}

function sidebar()
{
    include "config.php";
    ?>
    <aside id="sidebar" class="col-md-4">

        <div class="title-divider">
            <h3>Quick Links</h3>
            <div class="divider-arrow"></div>
        </div>

        <section class="block-grey">
            <div class="block-light wrap15"><br/>
                <ul class="list-group">
                    <li class="list-group-item"><a href="botany.php"><i class="fa fa-arrow-right""></i>&nbsp;
                            Botany</a></li>
                    <li class="list-group-item"><a href="pharmacology.php"><i class="fa fa-arrow-right""></i>&nbsp;
                            Pharmacology</a></li>
                    <li class="list-group-item"><a href="/page.php?id=3"><i class="fa fa-arrow-right""></i>&nbsp;
                            Publications</a></li>
                           
                </ul>


                </ul>
            </div>
        </section>


        <div class="title-divider">
            <h3>Search by Scientific Name</h3>
            <div class="divider-arrow"></div>
        </div>
        <section class="block-grey">
            <div class="block-light">

                    <div class="input-group">
                        <input type="text" id="search" class="form-control" placeholder="Type here to search..." name="q" required>
                        <span class="input-group-btn">
                                        <button class="btn btn-success" type="submit"><i
                                                    class="fa fa-search"></i></button>
                                    </span>
                    </div>
                <div style="max-height: 300px;overflow-y: scroll" id="display"></div>
            </div>
        </section>


        <div class="title-divider">
            <h3>Search by Family</h3>
            <div class="divider-arrow"></div>
        </div>
        <section class="block-grey">
            <div class="block-light">

                    <div class="input-group">
                        <input type="text" id="searchfamily" class="form-control" placeholder="Type here to search..." name="searchfamily" required>
                        <span class="input-group-btn">
                                        <button class="btn btn-success" type="submit"><i
                                                    class="fa fa-search"></i></button>
                                    </span>
                    </div>
               <div style="max-height: 300px;overflow-y: scroll" id="display-family"></div>
            </div>
        </section>

        <div class="title-divider">
            <h3>Search by Habit</h3>
            <div class="divider-arrow"></div>
        </div>
        <section class="block-grey">
            <div class="block-light">

                    <div class="input-group">
                        <input type="text" id="searchhabit" class="form-control" placeholder="Type here to search..." name="searchhabit" required>
                        <span class="input-group-btn">
                                        <button class="btn btn-success" type="submit"><i
                                                    class="fa fa-search"></i></button>
                                    </span>
                    </div>
                <div style="max-height: 300px;overflow-y: scroll" id="display-habit"></div>
            </div>
        </section>


        <div class="title-divider">
            <h3>Search by Disease</h3>
            <div class="divider-arrow"></div>
        </div>
        <section class="block-grey">
            <div class="block-light">

                    <div class="input-group">
                        <input type="text" id="searchdisease" class="form-control" placeholder="Type here to search..." name="searchdisease" required>
                        <span class="input-group-btn">
                                        <button class="btn btn-success" type="submit"><i
                                                    class="fa fa-search"></i></button>
                                    </span>
                    </div>
               <div style="max-height: 300px;overflow-y: scroll" id="display-disease"></div>
            </div>
        </section>

    </aside>

    <?php
}

function footer()
{
    include "config.php";
    ?>

    <section id="footer-menu">
        <div class="container aligncenter">
            <div class="row">
               <div class="col-md-8">
                <p><span>All rights reserved &copy; 2012 <span
                                style="color:#28A745">  Ethnobotany & Pharmacognosy.</span></span></p>
               </div>
               <div class="col-md-4">
                <p>Developed by  <a style="color: #31708f;font-size: 15px;font-weight: 600;" href="http://tentechsoft.com">Tentechsoft</a></p>
               </div>
            </div>
        </div>
    </section>


    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="assets/plugins/datatables/datatables.min.js"></script>
   
</body>
    </html>
    <?php
}

?>