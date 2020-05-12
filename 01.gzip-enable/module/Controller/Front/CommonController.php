<?php

namespace Controller\Front;

/**
 * Class pro 사용자들이 모든 컨트롤러에 공통으로 사용할 수 있는 컨트롤러
 * 컨트롤러에서 지원하는 메소드들을 사용할 수 있습니다. http://doc.godomall5.godomall.com/Godomall5_Pro_Guide/Controller
 */
class CommonController
{
    public function index($controller) {
        ob_start("ob_gzhandler");
	}
}