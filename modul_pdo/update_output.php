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
<?php echo('<textarea class="form-control" rows="10">');?>
	
<?php echo('$query = $db->prepare("update ' . $_POST["table"] . ' set ' . $update . ' where id= :id");');?>
	
<?php echo('$update = $query->$execute(array(' . $execute_array . ', "id" => $id ) )');?>

<?php echo('</textarea>');?>
</div>

