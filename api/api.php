<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
$con = mysqli_connect("localhost", "root", "", "arbetsprov");
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
