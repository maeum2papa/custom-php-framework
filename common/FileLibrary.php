<?
namespace common;
class FileLibrary{

    private $exception_entry = array('@eaDir','admin','error','.','..');

    function __construct(){

        global $tpl,$db,$lib,$dev;

        $this->tpl = $tpl;
        $this->db = $db;
        $this->lib = $lib;
        $this->dev = $dev;

    }


    function getSub($dir){

        if(is_dir($dir)) {

            //$result['dir']='';
            //$result['file']='';

            if($dh = opendir($dir)) {
                while(($entry = readdir($dh)) !== false) {

                    if(in_array($entry,$this->exception_entry)) continue;

                    if(is_dir($dir.'/'.$entry)) {
                        $result['dir'][] = $entry;
                    } else {
                        $result['file'][] = $entry;
                    }
                }
                closedir($dh);
            }
        }


        $result['path'] = $dir;
        if($result['dir']) sort($result['dir']);
        if($result['file']) sort($result['file']);

        return $result;

    }


    function mkFile($path,$contents=array('')){

        $result = false;

        if(file_exists($path)){
            return $result;
        }

        $tmp = explode('/',$path);

        $file = fopen($path,"w");
        foreach($contents as $text){
                fwrite($file,$text);
        }
        fclose($file);

        if(file_exists($path)){
            $result = true;
        }

        return $result;

    }


    function chkExt($path,$permit){

        $result = false;
        $name = '';

        if(preg_match("/\//",$path)){
            $tmp = explode('/',$path);
            $name = end($tmp);
        }else{
            $name = $path;
        }

        $tmp = explode('.',$name);
        $ext = end($tmp);

        if(in_array($ext,$permit)){
            $result = true;
        }


        return $result;

    }


    function getExt($path){

        $name = '';

        if(preg_match("/\//",$path)){
            $tmp = explode('/',$path);
            $name = end($tmp);
        }

        $tmp = explode('.',$name);
        $ext = end($tmp);


        return $ext;

    }


    function copyDir($src,$dst){

        clearstatcache();

        $dir = opendir($src);
        if(!is_dir($dst)) mkdir($dst);

        while(false !== ( $file = readdir($dir)) ) {
            if(!in_array(substr($file,0,1),array('.','..','@'))){
                if ( is_dir($src . '/' . $file) ) {
                    copyDir($src . '/' . $file,$dst . '/' . $file);
                }else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }


    function rmDirAll($dir){
        $dirs = dir($dir);
        while(false !== ($entry = $dirs->read())) {
            if(($entry != '.') && ($entry != '..')) {
                if(is_dir($dir.'/'.$entry)) {
                    rmdirAll($dir.'/'.$entry);
                } else {
                    @unlink($dir.'/'.$entry);
                }
            }
        }
        $dirs->close();
        return rmdir($dir);
    }



}
