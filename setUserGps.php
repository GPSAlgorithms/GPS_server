<?php
    $con = mysqli_connect("localhost", "soeun01", "soeun01!", "gps");
    mysqli_query($con, 'SET NAMES utf8'); 
    
    $userId = $_POST["userId"]; //입력받음
    $gpsId = $_POST["gpsId"]; //입력받음

    // null 확인
    if ($userId == "" || $gpsId == ""){
        // data null
        $response = array("success" => false, "error" => "data is null");
    } else {
        $statement = mysqli_prepare($con, "INSERT INTO usergps(userId, gpsId) VALUES (?, ?)"); //DB에 값 저장
        mysqli_stmt_bind_param($statement, "si", $userId, $gpsId); 
        
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