<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

$response = array();

if ($con) {
    $sql = "select * from routes";
    $result = mysqli_query($con, $sql);
    if ($result) {

        header("Content-Type: JSON");
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $response[$i]['routeId'] = $row['routeId'];
            $response[$i]['licensePlate'] = $row['licensePlate'];
            $response[$i]['timeStart'] = $row['timeStart'];
            $response[$i]['timeEnd'] = $row['timeEnd'];
            $response[$i]['distance'] = $row['distance'];
            $response[$i]['travelTime'] = $row['travelTime'];
            $response[$i]['startAddress'] = $row['stopAddress'];
            $response[$i]['routeType'] = $row['routeType'];
            $response[$i]['liters'] = $row['liters'];
            $response[$i]['cost'] = $row['cost'];
            $response[$i]['firstLat'] = $row['firstLat'];
            $response[$i]['firstLon'] = $row['firstLon'];
            $response[$i]['lastLat'] = $row['lastLat'];
            $response[$i]['lastLon'] = $row['lastLon'];
            $response[$i]['odometerStart'] = $row['odometerStart'];
            $response[$i]['odometerStop'] = $row['odometerStop'];
            $i++;
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
} else {
    echo "Database connection failed";
}
