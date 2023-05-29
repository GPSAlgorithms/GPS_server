<?php
    $con = mysqli_connect("localhost", "soeun01", "soeun01!", "gps");
    mysqli_query($con, 'SET NAMES utf8');
    
    $userId = $_POST["userId"]; // 입력받은 userId
    
    $statement = mysqli_prepare($con, "SELECT userId, age FROM userinfo WHERE userId = ?");
    mysqli_stmt_bind_param($statement, "s", $userId);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $resultUserId, $resultAge);
    
    $result = array(); // 결과를 담을 배열
    
    while (mysqli_stmt_fetch($statement)) {
        $row = array(
            "userId" => $resultUserId,
            "age" => $resultAge
        );
        $result = $row;
    }
    
    mysqli_stmt_close($statement);
    mysqli_close($con);
    
    if (!empty($result)) {
        //  검색 성공
        $response = array("success" => true, "userinfo" => $result);
    } else {
        // 검색 실패
        $response = array("success" => false, "error" => "No results found");
    }

    header('Content-Type: application/json; charset=utf8');
    echo json_encode($response, JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
?>