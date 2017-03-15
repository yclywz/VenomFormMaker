<?php include('config.php');?>
<select class="form-control input-sm">
	<?php $sql = mysql_query("show tables;");
	while ($row = mysql_fetch_row($sql)) {
	?>
	<option value="<?php echo($row[0]);?>"><?php echo($row[0]);?></option>
	<?php }?>
</select>