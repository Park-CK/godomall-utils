# API 서브 도메인 사용
개발시 api.* 형태의 서브도메인을 사용하고 싶을 때가 있습니다.<br>
고도몰에서 Controller/Api/ 하위에 작성할 경우 api 서브도메인으로 라우팅됩니다.<br>
해당 소스는 api 형태 예시입니다.<br>
실제 사용할 때는 조금 더 인터페이스와 예외처리에 신경써야할듯...<br>

# 간단한 테스트
경로에 맞게 고도몰에 업로드 (/module/...)<br>
http://api.{도메인}/dev/sample_echo 로 다양한 요청 보내며 동작 확인<br>

# 활용
API 개발에 활용 가능<br>

# 알려진 버그
좀 더 RESTful하게 만들고 싶었으나 고도몰 아파치 서버에서 PUT,DELETE Method를 허용하지 않는 것으로 보임.<br>
api 도메인 사용에 만족... <br>

