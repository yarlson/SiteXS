<?php

class sql {

    var $conn_id;
    var $result;
    var $record;
    var $db = array();
    var $port;
    var $query_count=0;

    function sql() {
        global $DB;
        $this->db = $DB;
        if(ereg(":",$this->db['host'])) {
            list($host,$port) = explode(":",$this->db['host']);
            $this->port = $port;
        } else {
            $this->port = 3306;
        }
    }

    function connect() {
        $this->conn_id = mysql_pconnect($this->db['host'].":".$this->port,$this->db['user'],$this->db['pass']);
        if ($this->conn_id == 0) {
            $this->sql_error("Connection Error");
        }
        if (!mysql_select_db($this->db['dbName'], $this->conn_id)) {
            $this->sql_error("Database Error");
        }
        return $this->conn_id;
    }

    function query($query_string) {
        $this->result = mysql_query($query_string,$this->conn_id);
        $this->query_count++;
        if (!$this->result) {
            $this->sql_error($query_string);
        }
        return $this->result;
    }

    function fetch_array($query_id) {
        $this->record = mysql_fetch_array($query_id,MYSQL_ASSOC);
        return $this->record;
    }

    function num_rows($query_id) {
        return ($query_id) ? mysql_num_rows($query_id) : 0;
    }

    function num_fields($query_id) {
        return ($query_id) ? mysql_num_fields($query_id) : 0;
    }

    function free_result($query_id) {
        return mysql_free_result($query_id);
    }

    function affected_rows() {
        return mysql_affected_rows($this->conn_id);
    }
	
    function list_tables() {
        $res=mysql_list_tables($this->db['dbName']);
		for ($i = 0; $i < $this->num_rows($res); $i++)
		    $fields[$i]=mysql_tablename($res, $i);
		return $fields;
    }
	
    function list_fields($tableName) {
        $res=mysql_list_fields($this->db['dbName'], $tableName, $this->conn_id);
		return $res;
    }
	
	function get_fields($query_id){
	    $fields = $this->num_fields($query_id);
	    $rows   = $this->num_rows($query_id);
	    for ($i=0; $i < $fields; $i++) {
	        $field[$i]->type  = mysql_field_type($query_id, $i);
	        $field[$i]->name  = mysql_field_name($query_id, $i);
	        $field[$i]->len   = mysql_field_len($query_id, $i);
	        $field[$i]->flags = mysql_field_flags($query_id, $i);
		}
		return $field;
    }
    
	function seek ($result, $number) {
		mysql_data_seek ($result, $number);
	}
	
    function close_db() {
        if($this->conn_id) {
            return mysql_close($this->conn_id);
        } else {
            return false;
        }
    }

    function sql_error($message) {
        $description = mysql_error();
        $number = mysql_errno();
        $error ="MySQL Error : $message\n";
        $error.="Error Number: $number $description\n";
        $error.="Date        : ".date("D, F j, Y H:i:s")."\n";
        $error.="IP          : ".getenv("REMOTE_ADDR")."\n";
        $error.="Browser     : ".getenv("HTTP_USER_AGENT")."\n";
        $error.="Referer     : ".getenv("HTTP_REFERER")."\n";
        $error.="PHP Version : ".PHP_VERSION."\n";
        $error.="OS          : ".PHP_OS."\n";
        $error.="Server      : ".getenv("SERVER_SOFTWARE")."\n";
        $error.="Server Name : ".getenv("SERVER_NAME")."\n";
        $error.="Script Name : ".getenv("SCRIPT_NAME")."\n";
        echo "<b><font size=4 face=Arial>$message</font></b><hr>";
        echo "<pre>$error</pre>";
        exit();
    }

}

?>