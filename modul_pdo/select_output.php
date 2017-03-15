<?php include_once('../config.php');

$data = explode(',',$_POST["data"]);
$ttl  = count($data);
$field = $values = $form = "";
for($i = 0; $i < $ttl; $i++){
	if($i == 0){
		$field 	= $data[$i];
		//$values = "'" . '" . $' . $data[$i] . ' . "' . "'";
		//$form 	= '$' . $data[$i] . " = " . '$_POST["' . $data[$i] . '"];';
	}else{
		$field 	= $field . ',' . $data[$i];
		//$values = $values . ",'" . '" . $' . $data[$i] . ' . "' . "'";
		//$form 	= $form . '$' . $data[$i] . " = " . '$_POST["' . $data[$i] . '"];';
	}
}?>

<div class="panel panel-default">
	<div class="panel-heading">Select Sql Çıktısı</div>
  	<div class="panel-body">
	<?php
	echo('<textarea class="form-control" rows="10">');
	echo('"select ' . $field . ' from ' . $_POST["table"] . '"');
	echo('</textarea>');
	?>
	</div>
</div>
