<?php
    include "warning.php";

    $caution = $_GET['경고'];
    $IMDG_type = $_GET['IMDG 종류'];
    $Similarity = $_GET['유사한 Bic Code'];
    $score = $_GET['유사도 점수'];
    $information = $_GET['해당 컨테이너 정보'];

    $query = "insert into memo(경고, IMDG 종류, 유사한 Bic Code, 유사도 점수, 해당 컨테이너 정보)
              values('$caution', '$IMDG_type', '$Similarity', '$score', '$information')"; 

    // echo $query;


    mysqli_query($connect, $query);

?>
<script>
    location.href='21memo.php';
    </script>

    