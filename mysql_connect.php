<?php

class mysql_db {

     static $instance;

     function __construct() { }

     public static function factory() {
         if(!isset(self::$instance)) {
             self::$instance = new mysql_db();
         }

         return self::$instance;
     }

     public function connect($config) {

         if(!isset($config['mysql_host']) || !isset($config['mysql_user']) || !isset($config['mysql_pass'])) {
             die('Please supply `mysql_host`, `mysql_user`, `mysql_pass`');
         }

         $host = $config['mysql_host'];
         $user = $config['mysql_user'];
         $pass = $config['mysql_pass'];

         $db_conn = mysql_connect($host, $user, $pass);
         if(!$db_conn) {
             die('could not connect: '.mysql_error());
         }

         return $db_conn;
     }

     public function close($db_conn) {
         mysql_close($db_conn);
     }

     public static function query($db_conn, $sql) {
         
         $ret_arr = array();
         $results = mysql_query($sql);

         if($results) {
             while($row = mysql_fetch_array($results, MYSQL_ASSOC)) {
                 $ret_arr[] = $row;
             }
         } else {
             error_log('bad query. no resource returned.');
             error_log('sql: '.$sql);
         }

         return $ret_arr;
     }

     public static function insert($db_conn, $sql) {

         $results = mysql_query($sql);
         if($results) {
             $insert_id = mysql_insert_id();
             return $insert_id;
         } else {
             error_log('bad query. insert was not successful: '.$sql);
             return false;
         }
     }
}
