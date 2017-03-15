<?php include_once('../config.php');

$data = explode(',',$_POST["data"]);
$ttl  = count($data);
$field = $values = $form = "";
for($i = 0; $i < $ttl; $i++){
	if($data[$i] != "id"){
		if($i == 0){
			$field 	= $data[$i] . "='" . '"' . " . $" . $data[$i] . ' ."' ;
			
			$form 	= '$' . $data[$i] . " = " . 'mysql_real_escape_string(@$_POST["' . $data[$i] . '"]);';
		}else{
			$field 	= $field . "', " . $data[$i] . "='" . '"' . " . $" . $data[$i] . ' . "' ;
			$form 	= $form . '
$' . $data[$i] . " = " . 'mysql_real_escape_string(@$_POST["' . $data[$i] . '"]);';
		}
	}
}
?>
<div class="panel panel-default">
	<div class="panel-heading">Core Dosya Çıktısı</div>
  	<div class="panel-body">
  	<?php echo('<textarea class="form-control" rows="30"><?php');?>
  	
$id	= $db->escape(@$_POST["id"]);
$process = $db->escape(@$_POST["process"]);
<?php echo($form);?>


if($process == "insert"){

	<?php echo('mysql_query("insert into ' . $_POST["table"] . ' set ' . $field . "'" . '");');?>
	
	echo($db->son_id()); //En son kayıt edilen id verir.
	
}else if($process == "update"){

	<?php echo('mysql_query("update ' . $_POST["table"] . " set " . $field . "'" .' where id=" . $id );');?>


}else if($process == "delete"){

	<?php echo('mysql_query("delete from ' . $_POST["table"] . ' where id=" . $id );');?>
	
	
}

<?php echo('?></textarea>');?>	
	</div>
</div>
<hr>


