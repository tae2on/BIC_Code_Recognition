<?php
    include "warning.php";


?>

<!DOCTYPE html>
<html lang='ko'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Bic code 기록</title>
    <meta charset='UTF-8'>
    <style>
        <!-- (이전 CSS 코드) -->
    </style>
</head>
<body>
<h1 class="centered-title">Bic code 기록</h1>
<form action="21Lih.php" method="get">
    <div class="search-container">
        <input type="text" name="search" placeholder="검색어를 입력하세요">
        <input type="submit" value="검색">
    </div>
</form>

<table border=1>
    <tr>
        <td> No </td>
        <td> 경고 </td>
        <td> IMDG 종류 </td>
        <td> 유사한 Bic Code </td>
        <td> 유사도 점수 </td>
        <td> 해당 컨테이너 정보 </td>
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
    </tr>
    <?php
    }
    ?>
</table>

<?php
// 전체 결과 수 계산
$total_results_query = "SELECT COUNT(*) AS total FROM bic";
$total_results = mysqli_query($connect, $total_results_query);
$total_results = mysqli_fetch_assoc($total_results)['total'];

// 전체 페이지 수 계산
$total_pages = ceil($total_results / $results_per_page);
?>

<div class="pagination">
    <?php
    for ($page = 1; $page <= $total_pages; $page++) {
        if ($page == $current_page) {
            echo "<span class='current-page'>$page</span>";
        } else {
            echo "<a href='21Lih.php?page=$page'>$page</a>";
        }
    }
    ?>
</div>
</body>
</html>