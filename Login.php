<?php
    $con = mysqli_connect("localhost", "soeun01", "soeun01!", "gps");
    mysqli_query($con, 'SET NAMES utf8'); 
    
    $userId = $_POST["userId"]; //입력받음
    $userPw = $_POST["userPw"]; //입력받음

    $statement = mysqli_prepare($con, "SELECT userPw FROM userinfo WHERE userId = ?");
    mysqli_stmt_bind_param($statement, "s", $userId); 
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $userPass);
    mysqli_stmt_fetch($statement);

    if ($userPass !== null) {
        // 입력한 비번이 맞는지 확인
        if($userPass == $userPw) {
            // 로그인 성공
            $response = array("success" => true);
        } else {
            // 로그인 실패
            $response = array("success" => false, "error" => "login failed");
        }
    } else {
        // 로그인 실패
        $response = array("success" => false, "error" => "login failed");
    }

    header('Content-Type: application/json; charset=utf8');
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>