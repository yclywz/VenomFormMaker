<!DOCTYPE html>
<html lang="en">
  <head>
  	<base href="<?php echo($adres);?>" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Venom Form Maker ||| Mysql Form Oluşturucu</title>

    <!-- Bootstrap core CSS -->
    <link href="media/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="media/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="media/js/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="media/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="media/js/jquery.min.js"></script>
    <script src="media/js/bootstrap.js"></script>
    <script src="media/js/ie10-viewport-bug-workaround.js"></script>
    
    <style>
    .sidebar .nav{margin: -15px -15px;}
    .sidebar .nav li{ margin: 0px 0px; }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid" style="position: relative;">
      	
          <select class="form-control" id="VeriTabani" style="position: absolute; top:8px; left:190px; width: 300px;" >
          	<option value="" selected="selected">Tablo Seçiniz</option>
          	<?php
          	$sql = mysql_query("show tables;");
		    while ($row = mysql_fetch_row($sql)) {
		    ?>
          	<option <?php if($row[0] == @$request[1+$rq]){echo(' selected="selected"');}?> value="<?php echo($row[0]);?>"><?php echo($row[0]);?></option>
          	<?php }?>
          </select>
          
          
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">VenomFormMaker</a>
          
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="./">Dashboard</a></li>
          </ul>
        </div>
      </div>
    </nav>

<div class="container-fluid" style="padding-top: 20px;">        	
        <div class="col-sm-12">