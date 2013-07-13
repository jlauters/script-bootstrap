<?php

class psql_db {

     static $instance;

     function __construct() { }

     public static function factory() {
         if(!isset(self::$instance)) {
             self::$instance = new psql_db();
         }

         return self::$instance;
     }

     public function connect() {
         $host   = $config['psql_host']; 
         $user   = $config['psql_user'];
         $pass   = $config['psql_pass'];
         $port   = $config['psql_port'];
         $dbname = $config['psql_dbname'];
         
         return pg_connect("host=".$host." port=".$port." user=".$user." password=".$pass." dbname=".$dbname);
     }

     public function close($db_conn) {
         pg_close($db_conn);
     }

     // For Simple Queries
     public function query($db_conn, $sql) {
         $result = pg_query($db_conn, $sql);
         if(!$result) {
             return array('status' => 'error', 'msg' => 'An error with your sql occured.');
         }

         $arr = pg_fetch_all($result);
         return $arr;
     }
}
