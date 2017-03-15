<?php
@session_start();

$MysqlHost			= "localhost";
$MysqlUser			= "root";
$MysqlPass			= "";
$MysqlType			= "pdo"; // Mysql bağlantı türleri (pdo,mysql,mysqli)

$adres 				= "http://localhost/VenomFormMaker/";

$bag = mysql_connect($MysqlHost,$MysqlUser,$MysqlPass); 

if(@$_SESSION["DataBaseName"] == ""){
	mysql_select_db("mysql",$bag);
}else{
	mysql_select_db($_SESSION["DataBaseName"],$bag);
}
mysql_query("SET NAMES 'utf8'");
$rq    = 1;

?>