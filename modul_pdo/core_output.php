<?php include_once('../config.php');

$data = explode(',',$_POST["data"]);
$ttl  = count($data);
$field = $values = $form = "";
for($i = 0; $i < $ttl; $i++){
	if($data[$i] != "id"){
		if($i == 0){
			
			$field 			= $data[$i];
			$value			= '?';
			$execute 		= '$' . $data[$i];
			$update			= $data[$i] . '= :' . $data[$i];
			$execute_array 	= '"' . $data[$i] . '" => $' . $data[$i] . '';
			
			$form 		= '$' . $data[$i] . " = " . '$db->escape(@$_POST["' . $data[$i] . '"]);';
		}else{
						
			$field 			= $field . ", " . $data[$i];
			$value			= $value . ', ?'; 
			$execute		= $execute . ", $" . $data[$i];
			$update			= $update . ', ' . $data[$i] . '= :' . $data[$i];
			
			$execute_array 	= $execute_array . ', "' . $data[$i] . '" => $' . $data[$i] . '';
			
			$form 		= $form . '
$' . $data[$i] . " = " . '@$_POST["' . $data[$i] . '"];';
		}
	}
}
?>
<div class="panel panel-default">
	<div class="panel-heading">Core Dosya Çıktısı</div>
  	<div class="panel-body">
  	<?php echo('<textarea class="form-control" rows="30"><?php');?>
  	
$id	= @$_POST["id"];
$process = @$_POST["process"];
<?php echo($form);?>


if($process == "insert"){

	<?php echo('$query = $db->prepare("insert into ' . $_POST["table"] . ' (' . $field . ') value(' . $value . ')");');?>
	
	<?php echo('$insert = $query->$execute(array(' . $execute . ') )');?>
	
	echo($db->lastInsertId()); //En son kayıt edilen id verir.
	
}else if($process == "update"){

	<?php echo('$query = $db->prepare("update ' . $_POST["table"] . ' set ' . $update . ' where id= :id");');?>
	
	<?php echo('$update = $query->$execute(array(' . $execute_array . ', "id" => $id ) )');?>


}else if($process == "delete"){

	<?php echo('$query = $db->prepare("delete from ' . $_POST["table"] . ' where id= :id");');?>
	
	<?php echo('$delete = $query->$execute(array("id" => $id ) )');?>
	
	
}

<?php echo('?></textarea>');?>	
	</div>
</div>
<hr>


