<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

$servername = "mysql5049.site4now.net";
$dbname = "db_a9ec02_testone";
$username = "a9ec02_testone";
$password = "DOMA9080";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {  // Change to GET method
    $seatNumber = $_GET["seatNumber"];      // Change to retrieve from GET parameters

    $sql = "SELECT student_name, student_status, student_degree FROM thanwia_3maa WHERE student_seat = $seatNumber";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $studentName = $row["student_name"];
            $studentStatus = $row["student_status"];
            $studentDegree = $row["student_degree"];

            $percentage = ($studentDegree / 410) * 100;

            $response = [
                "Code" => 200,
                "Message" => "The student is found in the database",
                "Data" => [
                    "studentName" => $studentName,
                    "studentStatus" => $studentStatus,
                    "studentDegree" => $studentDegree,
                    "percentage" => $percentage
                ]
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response = [
                "Code" => 400,
                "Message" => "The student is not found in the database"
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    } else {
        $response = [
            "Code" => 500,
            "Message" => "Database error"
        ];

        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}

mysqli_close($conn);

?>
