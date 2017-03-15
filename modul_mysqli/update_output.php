<?php include_once('../config.php');

$data = explode(',',$_POST["data"]);
$ttl  = count($data);
$field = $values = $form = "";
for($i = 0; $i < $ttl; $i++){
	if($data[$i] != "id"){
		if($i == 0){
			$field 	= $data[$i] . "='" . '"' . " . $" . $data[$i] . ' ."' ;
			
			$form 	= '$' . $data[$i] . " = " . 'mysqli_real_escape_string($_POST["' . $data[$i] . '"]);';
		}else{
			$field 	= $field . "', " . $data[$i] . "='" . '"' . " . $" . $data[$i] . ' . "' ;
			$form 	= $form . '
$' . $data[$i] . " = " . 'mysqli_real_escape_string($_POST["' . $data[$i] . '"]);';
		}
	}
}

?>
<div class="panel panel-default">
	<div class="panel-heading">Post İşlemleri</div>
  	<div class="panel-body">
  	<?php 
	echo('<textarea class="form-control" rows="10">');
	echo('$id = $_POST["id"];
' . $form);
	echo('</textarea>');
	?>	
	</div>
</div>
<hr>
<div class="panel panel-default">
	<div class="panel-heading">Update Sql Çıktısı</div>
  	<div class="panel-body">
  	<?php 
	echo('<textarea class="form-control" rows="10">');
	echo('"update ' . $_POST["table"] . " set " . $field . "'" .' where id=" . $id');
	echo('</textarea>');
	?>
</div>

