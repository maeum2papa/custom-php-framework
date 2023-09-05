<?
namespace model;
use common;
class Conf extends common\Library{

    function __construct(){

        parent::__construct();


    }

    function getData($data){
        // $query = "select count(sno) as cnt from ".$this->table." where sno=?";
        // $row = $this->db->query($query,"i",array($sno));
        
        // return $row[0]['cnt'];
    }


}
