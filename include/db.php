<?php
include_once("init.ini");

class DB_Connection {
 var $hostname; //Connect Hostname
 var $database; //Using DB
 var $username; //Login Name
 var $password; //Login Password
 var $conn; //Database link
 var $sql; //Quare String
 var $record; //Recordset
 
 function DB_Connection($db_host,$db_name,$db_user,$db_password) {
  $this->hostname = $db_host;
  $this->database = $db_name;
  $this->username = $db_user;
  $this->password = $db_password;
  $this->conn = false;
 }
 function connect() {
  $this->conn = mysql_pconnect($this->hostname, $this->username, $this->password) or trigger_error(mysql_error(), E_USER_ERROR);
 }

 function query($QueryString) {
  //Query Database
  mysql_select_db($this->database, $this->conn);
 
  $this->sql = $QueryString;
  $numofrows = 0;
  if ($this->conn == true) {
  	mysql_query("SET NAMES 'UTF8'");
    $this->record = mysql_query($this->sql, $this->conn) or die(mysql_error());
    while($r=mysql_fetch_assoc($this->record)){
        $res[]=$r;
    }
   $numofrows = mysql_num_rows($this->record);
  }
  return $res;
 }
}

/*
    public function connectDB() {        
        include_once("init.ini");
        $db_conn = @mysql_connect($db_host, $db_user, $db_password) or die ("Could not connect: " . mysql_error());
   		mysql_select_db($db_name, $db_conn);
   		 return $db_conn;
    }
    
    function queryDB($sql) {
      $this->connectDB();
      mysql_query("SET NAMES 'UTF8'");
      //print $sql;exit;
   		$result = mysql_query($sql);
      while($r=mysql_fetch_assoc($result)){
        $res[]=$r;
    	}
			return $res;
    }
    
    function freeDB($result) {
   		mysql_free_result($result);
    }
} 
*/

?>
