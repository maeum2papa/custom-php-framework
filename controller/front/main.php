<?
namespace controller\front;
use common;
use model\Conf as ConfModel;
class Main extends common\FrontLibrary{

    function __construct(){

        parent::__construct();

        $this->conf = new ConfModel;

        if(!$this->lib->segment[3]) $this->index_();

    }

    function index_(){

        $data = Null;
        // $data = $this->conf->getData(1);

        $data['name'] = 'j';

        $data['list'][] = array("title"=>"제목1");
        $data['list'][] = array("title"=>"제목2");

        $tpl = $this->lib->cfg['skin'].'/main.htm';
        $this->define('tpl', $tpl);
		$this->assign(array('data'=>$data));
		$this->print_('tpl');
    }
}
