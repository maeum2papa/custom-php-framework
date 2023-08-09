<?
namespace model\admin;
use common;
class Conf extends common\Library{

    function __construct(){

        parent::__construct();


    }

    function getData($data){
        $query = "select * from ".$this->db->tables['config']." set sno='".$data."'";
        return $this->db->fetch($query);
    }


}
