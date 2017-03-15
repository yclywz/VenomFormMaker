<div class="panel panel-default">
	<div class="panel-heading">Post İşlemleri</div>
  	<div class="panel-body">
  	<?php 
	echo('<textarea class="form-control" rows="10">');
	echo('$id = $_POST["id"];');
	echo('</textarea>');
	?>	
	</div>
</div>
<hr>
<div class="panel panel-default">
	<div class="panel-heading">Sql Sorgusu</div>
  	<div class="panel-body">
<?php echo('<textarea class="form-control" rows="10">'); ?>

<?php echo('$query = $db->prepare("delete from ' . $_POST["table"] . ' where id= :id");');?>
	
<?php echo('$delete = $query->$execute(array("id" => $id ) )');?>

<?php echo('</textarea>');?>
</div>