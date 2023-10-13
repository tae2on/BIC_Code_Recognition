<? 

include "21Lih.php";

Squery = "insert into memo(경고, IMDG 종류, 유사한 Bic Code, 유사도 점수, 해당 컨테이너 정보)
         values("이 컨테이너는 IMDG(위험물) 컨테이너입니다.", "가스류(2급)",'TYSU, '8점', 'TYSU에 해당하는 컨테이너의 정보: 회사는 MITSUBISHI CHEMICAL TAIWAN Co., LTD, 주소는 N°62 - KUANG-FU RD, HU-KOU HSIANG, HSIN-CHU, Taiwan, China입니다. 연락처는 +886 3 598 5987이며, 팩스 번호는 +886 3 598 5977입니다. 웹사이트 주소는 no web site입니다.')" # 해당 값을 입력하면 웹 페이지에 저장되는 코드 

mysqli_query($connect, $query);