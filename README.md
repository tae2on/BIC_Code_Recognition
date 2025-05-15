# 🚢 BIC_Code_Recognition
> 항만 컨테이너 검수를 자동화해 물류 처리의 정확성과 효율을 높이는 AI 기반 시스템입니다.

## 프로젝트 개요 
최근 항만의 컨테이너 물동량이 지속적으로 증가하면서, 물류 처리 과정에서 다양한 문제가 나타나고 있습니다. 해양수산부에 따르면, 2025년 1분기 전국 항만의 컨테이너 처리 물동량은 전년 동기 대비 2.1% 증가한 794만 TEU를 기록하였고, 특히 부산항은 4.0% 증가한 626만 TEU로 역대 최대 물동량을 처리했습니다. 이처럼 증가하는 물량은 항만의 처리 능력을 초과시키며, 상하차 지연, 검수 비효율, 혼잡 등의 문제를 유발하고 있습니다. 기존에 사용되던 RFID 및 바코드 기반 시스템은 인건비 증가, 바코드 훼손, 정보 갱신의 번거로움 등으로 인해 물류 효율성 확보에 한계를 보이고 있습니다. 이러한 문제를 해결하고자 본 프로젝트는 BIC 코드(국제 컨테이너 식별 코드)와 IMDG 코드(국제 위험물 운송 코드)를 자동으로 인식하여 컨테이너 정보 및 위험물 정보를 자동으로 입력하고, 이를 기반으로 레포트를 생성함으로써 검수 효율을 획기적으로 향상시키는 것을 목표로 합니다.

## 팀원소개
- 최용훈: IMDG 태그 분류를 위한 머신러닝 모델 개발
- 이영훈: BIC 코드 영역 추출 및 OCR을 통한 텍스트 인식
- 임준혁: Yolo 모델을 활용한 컨테이너 라벨 실시간 탐지
- 황태언: BIC 텍스트 기반 기업 정보 자동 수집 및 문서 생성, SQL 연동 웹페이지 구현 


## 주요기능
1. 컨테이너 라벨 실시간 인식
<br>YOLOv5를 활용하여 다양한 컨테이너 클래스(BIC, DOOR, IMDG, TANK 등)를 실시간으로 탐지
2. BIC 코드 영역 탐지 및 텍스트 추출
<br>탐지된 BIC 코드 영역에서 OCR을 통해 텍스트 정보 추출
3. IMDG 태그 분류 모델 구축
<br>이미지 증강 및 Random Forest 모델 학습을 통해 위험물 태그 자동 분류
4. BIC 코드 기반 기업 정보 수집
<br>OCR 텍스트를 기반으로 기업명, 국가, 주소 등 관련 정보를 웹에서 자동 수집
5. 문서 자동 생성 및 웹페이지 제공
<br>수집된 정보를 바탕으로 문서를 자동 생성하고, SQL과 연동하여 웹에서 확인 가능하도록 구현

## 결과 
- YOLOv5x 모델을 활용한 객체 탐지 정확도 향상
  - 실시간 객체 인식에 적합한 YOLOv5x 모델을 사용하여 batch size 8, epochs 50으로 학습을 수행
  - YOLOv7 대비 mAP 값의 변동이 적고 안정적으로 수렴
  - 흐릿하거나 저화질 이미지에서도 BIC 및 IMDG 태그를 안정적으로 탐지
- OCR 기반 텍스트 인식 성공
  - 탐지된 BIC 영역에서 OCR을 통해 텍스트를 추출
  - 추출된 텍스트는 이후 웹 크롤링과 문서 자동화의 핵심 입력으로 활용
- IMDG 태그 분류 성능 확보
  - 이미지 증강을 통해 35개 각도와 기울기 데이터 확대
  - 학습된 Random Forest 모델을 통해 위험물 분류 정확도 약 91.4% 달성
- BIC 코드 정보 자동 수집 정확도 향상
  - OCR 텍스트를 기반으로 웹 크롤링을 통해 회사명, 주소, 국가, 연락처 등 정보 수집
  - 입력된 BIC 코드와 유사한 코드 탐색 기능을 통해 직접적인 정보가 없을 경우에도 참고 가능한 관련 정보 제시 및 문서 작성 지원
- 검수 효율 향상 및 문서 자동화 
  - 컨테이너 및 위험물 정보를 자동 문서화할 수 있도록 시스템 구축
  - SQL 연동을 통해 웹페이지에서 실시간 정보 확인 가능

### 활용 데이터 
커넥티드 항만을 위한 물류 인프라 데이터([AIHub](https://aihub.or.kr/aihubdata/data/view.do?currMenu=&topMenu=&aihubDataSe=data&dataSetSn=523))
## 프로젝트 구성
```
BIC_Code_Recognition/
├── machine_learning/             # IMDG 태그 분류 및 BIC 코드 확률 계산
│   ├── imdg_randomforest.ipynb           # Random Forest 기반 위험물 분류 모델
│   └── Shipping_code_probability_calculation.ipynb  # BIC 코드 등장 확률 계산
├── nlp/                          # BIC 코드 기반 기업 정보 수집 및 문서 자동화
│   ├── openAI_GPT-3.ipynb                  # GPT-3를 활용한 기업 정보 자동 생성 실험
│   ├── Report_writing(similarity)+database.ipynb  # 유사 BIC 코드 기반 문서 생성 및 DB 저장
│   ├── bic_test.csv                        # BIC 테스트용 CSV 데이터셋
│   └── pro_data.jsonl                      # 크롤링 및 예측용 JSONL 데이터셋
├── vision/                       # YOLOv5 기반 객체 탐지 및 OCR 추출
│   ├── front_best.pt                      # YOLOv5x 학습된 모델 가중치
│   ├── yolov5x_image_extraction.ipynb     # 탐지된 BIC, IMDG 영역 이미지 추출
│   ├── ocr_text_extraction.ipynb          # OCR로 BIC 텍스트 추출
│   └── json_converter.ipynb               # YOLO 출력 결과를 JSON으로 변환
├── web(mysql)/                   # 웹페이지 및 데이터베이스 연동을 위한 PHP 코드
│   ├── web_page.php                       # 메인 결과 조회 페이지
│   ├── memo_bic_code.php                  # 특정 BIC 문서 조회
│   ├── memo_practice_1.php                # 기능 테스트용 PHP
│   ├── memo_practice_2.php                # 기능 테스트용 PHP
│   └── warning.php                        # 오류/예외 안내 페이지
├── combined_code.ipynb           # 전체 파이프라인 통합 실행 
└── README.md                     # 프로젝트 설명 및 개요 문서
```

## 발표자료 
- [최종 발표자료 (PPT)](https://docs.google.com/presentation/d/1eA9aACSG0PI1mnosLV5sfqRTElEX4fi3/edit?usp=sharing&ouid=114648637082603627048&rtpof=true&sd=true)
- [프로젝트 결과 보고서 (HWP)](https://drive.google.com/file/d/1O8gSJX4w26o69AOzhc5MFu5N8eN5YCdZ/view?usp=sharing)
![프로젝트 포스터](https://github.com/tae2on/BIC_Code_Recognition/blob/main/%ED%94%84%EB%A1%9C%EC%A0%9D%ED%8A%B8%20%ED%8F%AC%EC%8A%A4%ED%84%B0.png?raw=true)
