<?php

namespace Controller\Admin\Backup;

set_time_limit(300);

class BackupDownloadController extends \Controller\Admin\Controller {

	public function index()
    { 
        //-- 파일정보 확인
		$requestValue = \Request::request()->toArray();
        $backupDir = BackupManagerController::BACKUP_PATH;
        $file = $requestValue["fileName"];
        $down = $backupDir."/".$file;
        $filesize = filesize($down);

        //-- 스트림 다운로드 처리
        if(file_exists($down)){
            header("Content-Type:application/octet-stream");
            header("Content-Disposition:attachment;filename=$file");
            header("Content-Transfer-Encoding:binary");
            header("Content-Length:".$filesize);
            header("Cache-Control:cache,must-revalidate");
            header("Pragma:no-cache");
            header("Expires:0");
            if(is_file($down)){
                $fp = fopen($down,"r");
                while(!feof($fp)){
                    $buf = fread($fp,8096);
                    $read = strlen($buf);
                    print($buf);
                    flush();
                }
                fclose($fp);
            }
        } else {
            echo("<script>alert('요청한 백업파일이 없슴다.');</script>");
        }
        exit;
    }

}   