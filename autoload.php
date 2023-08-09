<?

if(!file_exists('./.htaccess')){
    die('.htaccess 파일이 누락되었습니다.');
    exit;
}


if(!file_exists('./common/db.php')){
    //header('Location:install.php');
    die('DB가 연결되지 않았습니다.');
    exit;
}


function autoload($param){
    $param = str_replace('\\','/',$param).".php";

    if(file_exists($param)){
        require_once $param;
    }else{

        $msg = $param." 파일을 찾을 수 없습니다.";

        require_once 'data/skin/error/error404.htm';
        exit;
    }


}

spl_autoload_register('autoload');
