<?php

namespace Controller\Api;

use Request;
use Framework\Utility\StringUtils;
use Framework\Http\Response;

class ApiController extends \Bundle\Controller\Api\Controller
{
	public $request;

	/**
     * 생성자
	 */
    public function __construct()
    {  
        parent::__construct();

        // 호출 메소드 구분
		switch($this->getMethod()){
			case 'GET':
				$this->request = $this->getValue();
				break;
			case 'POST':
			case 'PUT':
			case 'DELETE':
				if(strpos($this->getContentType(), "application/json") !== false){
					$this->request = $this->jsonValue();
				} else {
					$this->request = $this->postValue();
				}
				break;
		}
    }

	/**
	 * index() 오버라이드 되지 않았을 경우 403error
	 */
	public function index()
	{
		$this->exception(403);
	}

	/**
	 * REQUEST 호출 방식
     *
	 * @return string REQUEST_METHOD
	 */
	public function getMethod()
	{
		return Request::server()->get("REQUEST_METHOD");
	}

	/**
	 * CONTENT_TYPE 호출
	 *
	 * @return string CONTENT_TYPE
	 */
	public function getContentType()
	{
		return Request::server()->get("CONTENT_TYPE");
	}

	/**
	 * @return array @getValue
	 */
	public function getValue()
	{
		return Request::get()->xss()->injection()->toArray();
	}

	/**
	 * @return array @postValue
	 */
	public function postValue()
	{
		return Request::post()->xss()->injection()->toArray();
	}

	/**
	 * 송신데이터가 json일 경우 송신
	 * @return array @jsonValue
	 */
	public function jsonValue()
	{
		if(strpos($this->getContentType(), "application/json") !== false){
			$entityBody = trim(file_get_contents('php://input'));
			if(!empty($entityBody)){
				$jsonData = gd_isset(json_decode($entityBody, true), []);
				//$jsonData = StringUtils::xssArrayClean($jsonData);
				$jsonData = StringUtils::injectionArrayClean($jsonData);
			}
		}

		return $jsonData;
	}

	/**
	 * 에러 Exception
	 * $code -> http status 페이지 변환(REST)
	 */
	public function exception($code = 404)
	{
		$response = Response::create("", $code);
		$response->setCharset('utf-8');
		$response->getHeaders()->set('Content-Type', 'application/json');
		$response->send();
		exit;
	}
}