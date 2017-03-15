<?php
$loaders  = array(
	/* LOGIN */
	'tablo_detay'						=> 'tablo_detay.php',
	'veritabani'						=> 'veritabani.php'
);


$query      = ( isset($_SERVER['QUERY_STRING']) ) ? $_SERVER['QUERY_STRING'] : NULL;
$request    = str_replace($query, '', $_SERVER['REQUEST_URI']);
$request    = str_replace('?' .$query, '', $request);
$request    = explode('/', trim($request, '/'));
$kayit_sonu = 1;
$requesturl = $_SERVER['REQUEST_URI'];

if (isset($request[$kayit_sonu])) {
    $page   = $request[$kayit_sonu];
    
    if (isset($loaders[$page])) {
       require $loaders[$page];
    } else {
		require("404.php");
		die();
	}

} else {
	require("404.php");
    die();
}

?>
