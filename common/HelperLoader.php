<?

$segment = explode('/',$_SERVER['PHP_SELF']);
$dir = ($segment[2]=='admin')?'./helper/admin':'./helper/front';
if(file_exists($dir)) {
    if($dh = opendir($dir)) {
        while(($entry = readdir($dh)) !== false) {

            if(in_array($entry,array('.','..'))) continue;

            if(is_dir($dir.'/'.$entry)) {
            } else {
                include $dir.'/'.$entry;
            }
        }
        closedir($dh);
    }

}
