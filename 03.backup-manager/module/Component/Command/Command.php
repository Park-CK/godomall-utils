<?php

namespace Component\Command;

class Command
{
    private $db;

    public function __construct()
    {
        if (!is_object($this->db)) {
            $this->db = \App::load('DB');
        }
    }

   /**
    *   function executeCommand
    *   @param  $command    string
    *   @param  $startMsg   string  message before execute command
    *   @param  $endMsg     string  message after execute command  
    *   @return $status     int     command exit code (0 == completed execute command, else == error)         
    */
    public function executeCommand($command, $startMsg = null, $endMsg = null) {
        echo("<pre>");
        if($startMsg){
            echo("<span style='color:blue;'> - ".$this->_getCurrentDate()." | $startMsg </span>\n");
            ob_flush();
        }
        
        echo("<span style='color:blue;'> - ".$this->_getCurrentDate()." | Execute command \"$command\"</span>\n");
        ob_flush();
        passthru($command, $status);   
        echo("<span style='color:green;'> - ".$this->_getCurrentDate()." | Complete command \"$command\"</span>\n");
        ob_flush();
        if($endMsg){
            echo("<span style='color:green;'> - ".$this->_getCurrentDate()." | $endMsg </span>\n");
            ob_flush();
        }    
        echo("</pre>");
        
        if($status == 0) {
            //gd_debug("정상적으로 실행되었습니다. \n실행 명령 : $command");
        } else {
            gd_debug("명령 실행에 실패했습니다. \n실행 명령 : $command\n반환 코드 : $status\n코드 설명 : http://www.tldp.org/LDP/abs/html/exitcodes.html");
        }
        
        return $status;
    }
    
    // @return  string  Formatted time string, included micro seconds.
    private function _getCurrentDate() {
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $d = new \DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
        return $d->format("Y-m-d H:i:s.u"); 
    }

}