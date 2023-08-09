<?
namespace common;
use common;
class FrontLibrary extends common\Template{


    function __construct(){

        global $tpl,$db,$lib,$dev;

        $this->tpl = $tpl;
        $this->db = $db;
        $this->lib = $lib;
        $this->dev = $dev;


        $this->define('header', $this->lib->cfg['skin'].'/_header.htm');
		$this->define('footer', $this->lib->cfg['skin'].'/_footer.htm');

        $this->lib->cfg['skin'] = 'front';


        if($this->lib->segment[2]){

            $tmpSegment = $this->lib->segment;
            unset($tmpSegment[0],$tmpSegment[1]);
            //$jsFile = implode("_",$tmpSegment).".js";
            $jsFile = $tmpSegment[2]."_".$tmpSegment[3].".js";
            if(!$tmpSegment[3]) $jsFile = $tmpSegment[2].".js";

            if(file_exists('./data/skin/'.$this->lib->cfg['skin'].'/js/'.$jsFile)){
                $this->assign('page_script', '<script src="/data/skin/'.$this->lib->cfg['skin'].'/js/'.$jsFile.'"></script>');
            }

        }else{
            if(file_exists('./data/skin/'.$this->lib->cfg['skin'].'/js/main.js')){
                $this->assign('page_script', '<script src="/data/skin/'.$this->lib->cfg['skin'].'/js/main.js"></script>');
            }
        }

    }


}
