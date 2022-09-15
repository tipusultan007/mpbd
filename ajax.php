<?php

//Including Database configuration file.

include "config.php";

//Getting value of "search" variable from "script.js".

if (isset($_POST['search'])) {

//Search box value assigning to $Name variable.

    $Name = $_POST['search'];

//Search query.

    $Query = "SELECT id, scientific_name FROM medicinal_plants WHERE scientific_name LIKE '%$Name%'";

//Query execution

    $ExecQuery = MySQLi_query($connect, $Query);

//Creating unordered list to display result.

    echo '

<ul>

   ';

    //Fetching result from database.

    while ($Result = MySQLi_fetch_array($ExecQuery)) {

        ?>

        <!-- Creating unordered list items.

             Calling javascript function named as "fill" found in "script.js" file.

             By passing fetched result as parameter. -->

        <li onclick='fill("<?php echo $Result['scientific_name']; ?>")'>

            <a href="details.php?id=<?php echo $Result['id']; ?>">

                <!-- Assigning searched result in "Search box" in "search.php" file. -->

                <?php echo $Result['scientific_name']; ?>

        </li></a>

        <!-- Below php code is just for closing parenthesis. Don't be confused. -->

        <?php

    }
}elseif (isset($_POST['searchfamily'])) {

//Search box value assigning to $Name variable.

    $Name = $_POST['searchfamily'];

//Search query.

    $Query = "SELECT DISTINCT family_name FROM medicinal_plants WHERE family_name LIKE '%$Name%'";

//Query execution

    $ExecQuery = MySQLi_query($connect, $Query);

//Creating unordered list to display result.

    echo '

<ul>

   ';

    //Fetching result from database.

    while ($Result = MySQLi_fetch_array($ExecQuery)) {

        ?>

        <!-- Creating unordered list items.

             Calling javascript function named as "fill" found in "script.js" file.

             By passing fetched result as parameter. -->

        <li onclick='fill("<?php echo $Result['family_name']; ?>")'>

            <a href="plants-by-family.php?family=<?php echo $Result['family_name']; ?>">

                <!-- Assigning searched result in "Search box" in "search.php" file. -->

                <?php echo $Result['family_name']; ?>

        </li></a>

        <!-- Below php code is just for closing parenthesis. Don't be confused. -->

        <?php

    }
}elseif (isset($_POST['searchhabit'])) {

//Search box value assigning to $Name variable.

    $Name = $_POST['searchhabit'];

//Search query.

    $Query = "SELECT id, habit FROM medicinal_plants WHERE habit LIKE '%$Name%'";

//Query execution

    $ExecQuery = MySQLi_query($connect, $Query);

//Creating unordered list to display result.

    echo '

<ul>

   ';

    //Fetching result from database.

    while ($Result = MySQLi_fetch_array($ExecQuery)) {

        ?>

        <!-- Creating unordered list items.

             Calling javascript function named as "fill" found in "script.js" file.

             By passing fetched result as parameter. -->

        <li onclick='fill("<?php echo $Result['habit']; ?>")'>

            <a href="plants-by-habit.php?habit=<?php echo $Result['habit']; ?>">

                <!-- Assigning searched result in "Search box" in "search.php" file. -->

                <?php echo $Result['habit']; ?>

        </li></a>

        <!-- Below php code is just for closing parenthesis. Don't be confused. -->

        <?php

    }
}elseif (isset($_POST['searchdisease'])) {

//Search box value assigning to $Name variable.

    $Name = $_POST['searchdisease'];

//Search query.

    $Query = "SELECT id, scientific_name FROM medicinal_plants WHERE disease LIKE '%$Name%'";

//Query execution

    $ExecQuery = MySQLi_query($connect, $Query);

//Creating unordered list to display result.

    echo '

<ul>

   ';

    //Fetching result from database.

    while ($Result = MySQLi_fetch_array($ExecQuery)) {

        ?>

        <!-- Creating unordered list items.

             Calling javascript function named as "fill" found in "script.js" file.

             By passing fetched result as parameter. -->

        <li onclick='fill("<?php echo $Result['scientific_name']; ?>")'>

            <a href="details.php?id=<?php echo $Result['id']; ?>">

                <!-- Assigning searched result in "Search box" in "search.php" file. -->

                <?php echo $Result['scientific_name']; ?>

        </li></a>

        <!-- Below php code is just for closing parenthesis. Don't be confused. -->

        <?php

    }
}


?>

</ul>