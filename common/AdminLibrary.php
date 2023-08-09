<?
namespace common;
use common;
class AdminLibrary extends common\Template{


    function __construct(){

        global $tpl,$db,$lib,$dev;

        $this->tpl = $tpl;
        $this->db = $db;
        $this->lib = $lib;
        $this->dev = $dev;

        $this->lib->cfg['front_skin'] = $this->lib->cfg['skin'];
        $this->lib->cfg['skin'] = 'admin';

        $this->define('header', $this->lib->cfg['skin'].'/_header.htm');
		$this->define('footer', $this->lib->cfg['skin'].'/_footer.htm');


        #로그인 상태가 아니면 접근할 수 없게 하는 코드 추가


    }

}
