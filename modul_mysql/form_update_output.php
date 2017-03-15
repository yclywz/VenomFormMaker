<div class="panel panel-default">
	<div class="panel-heading">Form Çıktısı</div>
  	<div class="panel-body">
	
	<?php include_once('../config.php');
	
	$data = explode(',',$_POST["data"]);
	$sel  = explode(',',$_POST["select"]);
	$sql  = explode(',',$_POST["sql"]);
	$zrn  = explode(',',$_POST["zrn"]);
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
	}
	
	echo('<textarea class="form-control" rows="20">');
	echo('<?php
$sql = mysql_query("select ' . $field . ' from ' . $_POST["table"] . ' where id=" . $id);
$row = mysql_fetch_array($sql);
?>

<form class="form-horizontal" onsubmit="return false;">
	<input type="hidden" id="id" name="id" value="<?php echo($row["id"]);?>">
');
	for($i = 0; $i < $ttl; $i++){
		if($sel[$i] == "Text"){
			echo('
	<div class="form-group">
		<label for="' . $data[$i] . '" class="col-sm-4 control-label">' . $data[$i] . ' :</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="' . $data[$i] . '" name="' . $data[$i] . '" value="<?php echo($row["' . $data[$i] . '"]);?>">
		</div>
	</div>
');
		 }
		 
		if($sel[$i] == "Select"){
			echo('
	<div class="form-group">
		<label for="' . $data[$i] . '" class="col-sm-4 control-label">' . $data[$i] . ' :</label>
		<div class="col-sm-8">
			<select class="form-control" id="' . $data[$i] . '" name="' . $data[$i] . '">
			<?php $sqls = mysql_query("select * from ' . $sql[$i] . '");
			while( $rows = mysql_fetch_array($sqls) ){?>
				<option value="<?php echo($rows["id"]);?>" <?if($rows["id"] == $row["' . $data[$i] . '"]){?>selected="selected"<?php }?>><?php echo($rows["adi"]);?></option>
			<?php }?>
			</select>
		</div>
	</div>
');
		 }
		 
		if($sel[$i] == "Textarea"){
			echo('
	<div class="form-group">
		<label for="' . $data[$i] . '" class="col-sm-4 control-label">' . $data[$i] . ' :</label>
		<div class="col-sm-8">
			<textarea class="form-control" id="' . $data[$i] . '" name="' . $data[$i] . '"><?php echo($row["' . $data[$i] . '"]);?>< /textarea>
		</div>
	</div>
');
		 }
		 
		if($sel[$i] == "Checkbox"){
			echo('
	<div class="form-group">
		<label for="' . $data[$i] . '" class="col-sm-4 control-label">' . $data[$i] . ' :</label>
		<div class="col-sm-8">
			<input type="checkbox" class="form-control" id="' . $data[$i] . '" name="' . $data[$i] . '" value="<?php echo($row["' . $data[$i] . '"]);?>">
		</div>
	</div>
');
		 }
		 
		if($sel[$i] == "Radio"){
			echo('
	<div class="form-group">
		<label for="' . $data[$i] . '" class="col-sm-4 control-label">' . $data[$i] . ' :</label>
		<div class="col-sm-8">
			<input type="radio" class="form-control" id="' . $data[$i] . '" name="' . $data[$i] . '" value="<?php echo($row["' . $data[$i] . '"]);?>">
		</div>
	</div>
');
		 }
		 
	}
	echo('
	<div class="form-group">
    	<div class="col-sm-offset-4 col-sm-8">
      		<button type="submit" id="FormSaveBTN" class="btn btn-success">Kaydet</button>
    	</div>
  	</div>
</form>');
	echo('</textarea>');


	
$jquery = "'process=update&id=' + $('#id').val() + '";
echo('<br>JQUERY CIKTISI<br>');
echo('<textarea class="form-control" rows="20">'); ?>
$(document).ready(function(){
	$test = 0;
	$('#FormSaveBTN').click(function(){
	
		if($test == 1){
			console.log('Test');
		}<?php 
for($i = 1; $i < ($ttl+1); $i++){
	$ext = explode(':',$zrn[$i]);
	if($ext[1] == 1){?>
		if($('#<?php echo($ext[0])?>').val() == ''){
			alertify.error("<?php echo($ext[0])?> alanını doldurunuz");
			$('#<?php echo($ext[0])?>').focus();
			return false;
		}
<?php }

	$jquery = $jquery . '&' .$ext[0] . "=' + $('#" . $ext[0] . "').val() + '";


}
?>
		else{
			$.ajax({
				type		: 'POST',
				url			: '<?php echo($_POST["table"]);?>Core',
				data		: <?php echo($jquery)?>',
				success 	: function(r){
					console.log( r );
				}
			});
		}
	});
<?php 

echo('});');
echo('</textarea>');
?>	
	</div>
</div>