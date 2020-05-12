# GZip 압축 사용 활성화
<a href="https://stackoverflow.com/questions/16691506/what-is-gzip-compression">What is GZip compression?</a>
고도몰은 Apache-PHP 기반입니다.<br>
Apache, PHP 기반의 커뮤니티 사이트 및 쇼핑몰 사이트들 대부분 GZip압축이 활성화 되어있으나, 고도몰의 경우 활성화 되어있지 않습니다.<br>
고도몰 아파치 설정에 관련 옵션이 설정 되어 있으므로 코드 단 한 줄로 GZip 압축을 활성화 할 수 있습니다.<br>
솔루션 특성상 웹팩등의 기술 적용에 어려운 부분이 있으므로, 손쉽게 사이트 성능을 향상시키고자 한다면 고려해볼 수 있습니다.<br>

# 전역적으로 활성화 하고자 할 때
Common Controller에서 활성화

# 특정 페이지만 활성화 하고자 할 때
해당 페이지 컨트롤러에서 활성화

# 알려진 버그
관리자 페이지에서 활성화 할 경우 엑셀 출력이 안 됨