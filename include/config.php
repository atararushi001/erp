    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "erp_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed :");
    }

    ?>