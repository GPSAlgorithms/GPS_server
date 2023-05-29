<?php
    $con = mysqli_connect("localhost", "soeun01", "soeun01!", "gps");
    mysqli_query($con, 'SET NAMES utf8'); 
    
    $gpsId = $_POST["gpsId"]; //입력받음

    $statement = mysqli_prepare($con, "SELECT * FROM gpsdatabase WHERE gpsId = ?"); //DB에 값 저장
    mysqli_stmt_bind_param($statement, "i", $gpsId);
    mysqli_stmt_execute($statement);

    // 결과를 담을 배열 초기화
    $results = array();

    // 결과 집합을 받아옴
    $resultSet = mysqli_stmt_get_result($statement);

    // 각 행을 배열로 변환하여 결과 배열에 추가
    while ($row = mysqli_fetch_assoc($resultSet)) {
        $results[] = $row;
    }

    // 쿼리 실행 결과 확인
    if (!empty($results)) {
        $response = array("success" => true, "gpsdata" => $results);
    } else {
        $response = array("success" => false, "error" => "No results found");
    }

    header('Content-Type: application/json; charset=utf8');
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
