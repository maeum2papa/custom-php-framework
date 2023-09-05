<?
namespace common;
class DBLibrary extends \mysqli{

    function __construct($path='') {

        if(!file_exists($_SERVER['DOCUMENT_ROOT']."/common/db.php")){
            echo 'Not find DB configuration file.';
            exit;
        }else{

            if($path!=''){
                include $_SERVER['DOCUMENT_ROOT'].'/'.$path;
            }else{
                include $_SERVER['DOCUMENT_ROOT']."/common/db.php";
            }

			parent::__construct($dbinfo['host'],$dbinfo['dbid'],$dbinfo['dbpw'],$dbinfo['dbnm']);

            if ($this->connect_error) {
                echo $this->connect_error;
                exit;
            }


            $table['config']    ='w_config';
            $table['member']    ='w_member';
            $table['level']     ='w_level';
            $table['log_login'] ='w_log_login';
            $table['notice'] ='w_notice';

            $custom = 'custom/conf/tables.php';
            if(file_exists($custom)){
                include $custom;
            }

            $this->tables = $table;

        }

    }


	/**
     *  :: 쿼리실행
     */
    function query($query,$type=null,$val=null){

        if($query && !$type && !$val){

            $stmt = @parent::prepare($query);
            if(!$stmt) return false;
            if(!$stmt->execute()) return false;

            if(preg_match("/^select/i",$query)){
                return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            }else{
                return true;
            }

        }else{

            if(!is_array($val)) $val = array($val);

            $stmt = @parent::prepare($query);
            if(!$stmt) return false;
            $params = array_merge(array($type),$val);
            $tmp = array();

            foreach($params as $k => $v) $tmp[$k] = &$params[$k];

            call_user_func_array(array($stmt,'bind_param'),$tmp);

            if(!$stmt->execute()) return false;


            if(preg_match("/^select/i",$query)){
                return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            }else{
                return true;
            }

        }


    }

    


	/**
     *  :: 데이터 수 가져오기
     */
    function rows($query,$type=null,$val=null){
        if(preg_match("/^select/",$query)){
            $res = $this->query($query,$type,$val);
            $result = count($res);
        }

        return $result;
    }

	function last(){
		return @$this->insert_id;
	}


	function escape($data){
		$data = $this->stripslashes_deep($data);
		$data = $this->mysql_real_escape_string_deep($data);

		return $data;
	}

	function stripslashes_deep($var){
		$var = is_array($var)?array_map(array($this,'stripslashes_deep'), $var) :stripslashes($var);
		return $var;
	}

	function mysql_real_escape_string_deep($var){
		$var = is_array($var)?array_map(array($this,'mysql_real_escape_string_deep'), $var):$this->real_escape_string($var);
		return $var;
	}
}
