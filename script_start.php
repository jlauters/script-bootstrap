<?php

/* starter file for script */

$config = array(
    'db_type'     => 'mysql|psql' // pick one
   ,'mysql_host'  => 'localhost'
   ,'mysql_user'  => 'sample-user'
   ,'mysql_pass'  => 'sample-pass'
   ,'psql_host'   => 'localhost'
   ,'psql_user'   => 'sample-user'
   ,'psql_pass'   => 'sample-pass'
   ,'psql_port'   => '1234'
   ,'psql_dbname' => 'sample-db'
   ,'environment' => 'local|staging|prod' // pick one
);

/* if local take it all */
if('local' == $config['environment']) {
    ini_set('memory_limit', -1);
}

if('mysql' == $config['db_type']) {
    require_once 'mysql_connect.php';

    $db_conn = mysql_db::factory()->connect($config);
}

if('psql' == $config['db_type']) {
    require_once 'postgres_connect.php';

    $db_conn = psql_db::factory()->connect($config);
}

