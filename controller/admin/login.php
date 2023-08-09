<?
namespace controller\admin;
use common;
class Login extends common\AdminLibrary{

    function __construct(){

        global $lib,$cfg,$dev,$segment,$db;

        $this->lib = $lib;
        $this->db = $db;
        $this->cfg = $cfg;
        $this->dev = $dev;
        $this->segment = $segment;


        if(!$this->lib->segment[4]) $this->index_();

    }

    function index_(){

        $tpl = $this->lib->cfg['skin'].'/login.htm';

        $this->define('tpl', $tpl);
        $this->assign(array('data'=>$data,'cfg'=>$this->cfg));
        $this->print_('tpl');

    }

}
