<?php

set_time_limit(300); // Increase time limit to 5 minutes

$servername = "mysql5049.site4now.net";
$dbname = "db_a9ec02_testone";
$username = "a9ec02_testone";
$password = "DOMA9080";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$csvFile = "Egypt-High-School-Grade-2023-Mohamedovic(2).csv"; // Replace with the path to your CSV file

$handle = fopen($csvFile, "r");

if ($handle !== FALSE) {
    $sql = "CREATE TABLE IF NOT EXISTS thanwia_3ma (
        student_name VARCHAR(255) NOT NULL,
        student_seat INT(11) NOT NULL,
        student_status VARCHAR(255) NOT NULL,
        student_degree FLOAT NOT NULL
    )";
    
    if (mysqli_query($conn, $sql)) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
        $sql = "INSERT INTO thanwia_3ma  (student_seat ,student_name, student_degree, student_status) VALUES ('" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "', '" . $data[4] . "')";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . mysqli_error($conn);
        }
    }    

    fclose($handle);
} else {
    echo "Failed to open CSV file";
}

mysqli_close($conn);

?>
