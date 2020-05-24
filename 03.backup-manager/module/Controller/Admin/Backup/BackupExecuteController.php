<?php

namespace Controller\Admin\Backup;

set_time_limit(300);

class BackupExecuteController extends \Controller\Admin\Controller {
	
    public function index()
    { 
		$requestValue = \Request::request()->toArray();
        
        //--- skin 정보
        $skinAll = gd_policy('design.skin');

        //-- 백업 할 디렉토리
        $include = [
            "./data/skin/front/".$skinAll['frontLive'],
            "./data/skin/front/".$skinAll['frontWork'],
            "./data/skin/mobile/".$skinAll['mobileLive'],
            "./data/skin/mobile/".$skinAll['mobileWork'],
            "./module",
            "./data/module",
            "./admin",
        ];

        //-- 제외 규칙
        $exclude = [
            "*.htaccess*",
            "*admin/gd_share*",
        ];

        $strInclude     = implode(" ", $include);
        $strExclude    = implode(" --exclude=", $exclude);
        $backupDir    = BackupManagerController::BACKUP_PATH;

        //-- 백업파일 이름 지정시 해당 이름으로 생성 
        if(empty($requestValue["fileName"])) {
            $fileName = BackupManagerController::BACKUP_PREFIX.date("YmdHis", time());
        } else {
            $fileName = (str_replace(" ", "_", $requestValue["fileName"]));
        }

        $fullPath = $backupDir."/".$fileName;

        //-- 중복이름의 파일 존재할 경우 순번 붙여 네이밍
        $duplicateIdx = "";
        while(file_exists($fullPath.(empty($duplicateIdx) ? "" : "_".$duplicateIdx).".zip")) {
            $duplicateIdx++;
        }
        $fullPath .= (empty($duplicateIdx) ? "" : "_".$duplicateIdx).".zip";

        $command = \App::load('\\Component\\Command\\Command');
        $command->executeCommand("mkdir -p -m 777 $backupDir", "필요한 폴더가 없다면 생성합니다.", "폴더가 준비됐습니다.");
        $command->executeCommand("zip -r $fullPath $strInclude --exclude=$strExclude", "백업 압축을 시작합니다.", "백업 압축이 완료되었습니다.");
        exit;
    }
    
}   