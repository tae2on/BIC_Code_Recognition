<?php  
    include "warning.php";
    
    // 테이블 구조 변경 쿼리 실행
    $query_alter = "ALTER TABLE bic MODIFY 작성시간 TIMESTAMP DEFAULT CURRENT_TIMESTAMP";   
    mysqli_query($connect, $query_alter);
?><!DOCTYPE html>
<html lang='ko'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Bic code 기록</title>
    <meta charset='UTF-8'>
    <style>
        body {
            font-family: Verdana, sans-serif;
        }
        .centered-title {
            font-size: 2.5em;  /* 글자 크기를 조금 더 키웁니다 */
            text-align: center; 
            padding-top: 50px;
            padding: 20px;  /* 주변에 패딩 추가 */
            border-radius: 10px;  /* 둥글게 만들기 */
            margin: 0 20%;  /* 좌우 여백을 추가 */
        }
        table {
            margin-top: 10px; /* 제목 아래 테이블에 대한 상단 여백 추가. 필요에 따라 값을 조정하세요. */
            width: 90%;  /* 표의 너비 설정 */
            margin: 20px auto;  /* 중앙 정렬 및 위아래 여백 추가 */
            border-collapse: collapse;  /* 테두리 간격 제거 */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);  /* 미묘한 그림자 효과 */
        }
        /* 테이블 헤더 스타일 */
        table th, table td {
            padding: 10px 20px;  /* 안쪽 여백 */
            border: 1px solid #e2e2e2;  /* 테두리 색상 */
        }
        table th {
            background-color: #f7f7f7;  /* 테이블 헤더 배경색 */
            color: #333;  /* 글자색 */
            font-weight: bold;  /* 글자 두께 */
        }
        table tr:nth-child(odd) {
            background-color: #f9f9f9;  /* 홀수 행 배경색 */
        }
        table tr:hover {
            background-color: #e2f0fc;  /* 마우스 오버 시 행 배경색 */
        }
        form {
            width: 100%; /* 전체 화면 너비를 차지하도록 설정 */
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
            display: flex;        /* form 내의 요소들을 flexbox 방식으로 정렬 */
            justify-content: center; /* 수평 방향으로 가운데 정렬 */
            align-items: center;  /* 수직 방향으로 가운데 정렬 */
            gap: 10px;            /* 요소들 사이의 간격 */
        }
        input[type="text"] {
            padding: 10px;
            font-size: 1em;
            width: 300px;
            border-radius: 20px; /* 이 부분을 추가했습니다 */
            border: 1px solid #ccc; /* 경계선을 더 부드럽게 표시하기 위해 추가 */
            outline: none; /* 클릭했을 때의 테두리 강조를 제거하기 위해 추가 */
        }

        input[type="submit"] {
        padding: 10px 20px;
        font-size: 1em;
        border-radius: 20px; /* 이 부분을 추가했습니다 */
        background-color: #007BFF; /* 버튼의 배경색을 추가 */
        color: white; /* 버튼의 글씨색을 흰색으로 설정 */
        border: none; /* 기본 경계선을 제거 */
        cursor: pointer; /* 마우스를 올렸을 때의 커서 모양을 손가락 모양으로 변경 */
        }
        .search-container {
            display: flex;        
            justify-content: center;
            align-items: center;  
            gap: 10px;            
        }

    </style>
</head>
<body>
    <h1 class="centered-title">Bic code 기록</h1>
    <form action="" method="get">
        <div class="search-container"> <!-- 검색창과 버튼을 감싸는 div 추가 -->
            <input type="text" name="search" placeholder="검색어를 입력하세요">
            <input type="submit" value="검색">
        </div>
    </form>
    <?php
    // 현재 페이지 번호 가져오기 (기본값은 1)
    $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;

    // 한 페이지당 표시될 레코드 수
    $records_per_page = 5;

    // 현재 페이지에 따라 LIMIT 및 OFFSET 설정
    $offset = ($current_page - 1) * $records_per_page;

    $search_term = isset($_GET['search']) ? $_GET['search'] : '';
    $search_term = mysqli_real_escape_string($connect, $search_term); // SQL injection 방지

    // 총 행 수를 얻기 위해 데이터베이스를 쿼리합니다
    if ($search_term) {
        $count_query = "SELECT COUNT(*) as total_rows FROM bic WHERE `유사한 Bic Code` LIKE '%$search_term%'";
    } else {
        $count_query = "SELECT COUNT(*) as total_rows FROM bic";
    }
    $count_result = mysqli_query($connect, $count_query);
    $row = mysqli_fetch_assoc($count_result);
    $total_rows = $row['total_rows'];

    // 총 페이지 수 계산
    $total_pages = ceil($total_rows / $records_per_page);

    // 데이터를 검색하여 결과 집합 가져오기
    if ($search_term) {
        $query = "SELECT * FROM bic WHERE `유사한 Bic Code` LIKE '%$search_term%' ORDER BY no LIMIT $records_per_page OFFSET $offset";
    } else {
        $query = "SELECT * FROM bic ORDER BY no LIMIT $records_per_page OFFSET $offset";
    }
    $result = mysqli_query($connect, $query);


    ?>
<table border=1>

    <tr>
        <td> No </td>
        <td> 경고 </td>
        <td> IMDG 종류 </td>
        <td> 유사한 Bic Code </td>
        <td> 유사도 점수 </td>
        <td> 해당 컨테이너 정보 </td>
        <td> 작성시간 </td>
        
    </tr>

    <?php 
        while($data = mysqli_fetch_array($result)){
    
    ?>
    <tr>
        <td> <?=$data['No']?> </td>
        <td> <?=$data['경고']?> </td>
        <td> <?=$data['IMDG 종류']?> </td>
        <td> <?=$data['유사한 Bic Code']?> </td>
        <td> <?=$data['유사도 점수']?> </td>
        <td> <?=$data['해당 컨테이너 정보']?> </td>
        <td> <?=$data['작성시간']?> </td>

    </tr>
    <?php
        }
    ?>
    </table>
    <div style="text-align:center; margin-top:20px;">
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
                echo $i . " ";
            } else {
                echo "<a href='?page=$i&search=$search_term'>$i</a> ";
            }
        }
        ?>
    </div>
</body>
</html>
