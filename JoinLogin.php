<?php
    $con = mysqli_connect("localhost", "soeun01", "soeun01!", "gps");
    mysqli_query($con, 'SET NAMES utf8'); 
    
    $userId = $_POST["userId"]; // 입력받음
    $userPw = $_POST["userPw"]; // 입력받음
    $age = $_POST["age"]; // 입력받음

    // null 확인
    if ($userId == "" || $userPw == ""){
        // 아이디 혹은 비밀번호 null
        $result = false;
        $response = array("success" => $result, "error" => "userId or userPw is null");
    } else {
        $statement = mysqli_prepare($con, "INSERT INTO userinfo(userId, userPw, age) VALUES (?, ?, ?)"); // DB에 값 저장
        mysqli_stmt_bind_param($statement, "ssi", $userId, $userPw, $age); 
        
        // 쿼리 실행
        if (mysqli_stmt_execute($statement)) {
            // 쿼리 성공
            $result = true;
            $response = array("success" => $result);
        } else {
            // 쿼리 실패
            $result = false;
            $response = array("success" => $result, "error" => mysqli_stmt_error($statement));
        }
    }

    // 결과 출력
    echo json_encode($response);    
?>