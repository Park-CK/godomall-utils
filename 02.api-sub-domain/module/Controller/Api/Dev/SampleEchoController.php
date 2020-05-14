<?php

namespace Controller\Api\Dev;

class SampleEchoController extends \Controller\Api\ApiController
{
    public function index()
    {
        if(empty($this->request)) {
            $this->exception(400);
        }

        echo json_encode($this->request, JSON_UNESCAPED_UNICODE);
        exit;
    }
}