<?php

namespace Controller\Admin\Backup;

class BackupManagerController extends \Controller\Admin\Controller {
	
    const BACKUP_PATH    = "tmp/godo_backup";
    const BACKUP_PREFIX  = "backup";

    public function index()
    { 
		$requestValue = \Request::request()->toArray();
        $dir = self::BACKUP_PATH."/";

        //-- 백업경로의 파일리스트 읽기
        $fileList = [];
        if (is_dir($dir)){                              
            if ($dh = opendir($dir)){                     
                while (($file = readdir($dh)) !== false ){   
                    if($file != "." && $file != "..")  {
                        $modTimeStamp = filemtime($dir.$file);
                        $modDt = date("Y-m-d H:i:s", $modTimeStamp);
                        $fileSize = floor(filesize($dir.$file) / 1024);

                        $fileInfo = [
                            "fileName"  => $file,
                            "modDt"     => $modDt,
                            "modTimeStamp" => $modTimeStamp,
                            "fileSize"     => $fileSize."KB"
                        ];

                        $fileList[] = $fileInfo;
                    }
                }                                           
                closedir($dh);                              
            }                                             
        }
        
        //-- 파일 최종 수정일로 내림차순 정렬
        foreach ($fileList as $key => $row) {
          $sort[$key] = $row['modTimeStamp'];
        }
        array_multisort($sort, SORT_DESC, $fileList);
        
        $this->setData("fileList", $fileList);
        $this->getView()->setDefine('layout', 'layout_blank.php');

    }

}   