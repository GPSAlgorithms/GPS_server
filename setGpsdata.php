<?php
    $con = mysqli_connect("localhost", "soeun01", "soeun01!", "gps");
    mysqli_query($con, 'SET NAMES utf8'); 
    
    $gpsId = $_POST["gpsId"]; //입력받음
    $gpsName = $_POST["gpsName"]; //입력받음
    $gpsTime = $_POST["gpsTime"]; //입력받음
    $latitude = $_POST["latitude"]; //입력받음
    $longitude = $_POST["longitude"]; //입력받음

    // null 확인
    if ($gpsId == "" || $gpsName == "" || $gpsTime == "" || $latitude == "" || $longitude == ""){
        // null
        $response = array("success" => false, "error" => "data is null");
    } else {
        $statement = mysqli_prepare($con, "INSERT INTO gpsdatabase(gpsId, gpsName, gpsTime, latitude, longitude) VALUES (?, ?, ?, ?, ?)"); //DB에 값 저장
        mysqli_stmt_bind_param($statement, "issdd", $gpsId, $gpsName, $gpsTime, $latitude, $longitude); 
        
        // 쿼리 실행
        if (mysqli_stmt_execute($statement)) {
            // 쿼리 성공
            $response = array("success" => true);
        } else {
            // 쿼리 실패
            $response = array("success" => false, "error" => mysqli_stmt_error($statement));
        }
    }

    header('Content-Type: application/json; charset=utf8');
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>