<?php 
include_once 'config.php';
include('header.php');
?>
<?php if(@$_SESSION["DataBaseName"] == ""){?>
<div class="panel panel-default">
  	<div class="panel-heading">Veritabanlari</div>
  	<div class="panel-body">
		<ul class="list-group">
			<?php 
			$res = mysql_query("SHOW DATABASES");
			$x = 0;
			while ($row = mysql_fetch_assoc($res)) {
				if($row['Database'] != "information_schema" && $row['Database'] != "mysql" && $row['Database'] != "performance_schema" && $row['Database'] != "phpmyadmin"){
			?>
		  		<li class="list-group-item">
		  			<input type="radio" class="DatabaseRadio" style="margin-top:5px !important; position:absolute;" name="databasenameradio" id="databasenameradio"
		  			<?php if($x == 0){echo(' checked="checked"');}?> data-name="<?php echo($row['Database']);?>" />
		  			<div style="margin-left:20px;"><?php echo($row['Database']);?> </div>
		  		</li>
			<?php $x++;} 
			}	
			?>
		</ul>
		<a class="btn btn-success btn-block" id="DatabaseBTN">Veritabanını Seç</a>
	</div>
</div>
<?php }else{?>
	<div class="col-sm-6">
	
		<div class="panel panel-default">
		  	<div class="panel-heading">Veritabanlari</div>
		  	<div class="panel-body">
				<ul class="list-group">
					<?php 
					$res = mysql_query("SHOW DATABASES");
					$x = 0;
					while ($row = mysql_fetch_assoc($res)) {
						if($row['Database'] != "information_schema" && $row['Database'] != "mysql" && $row['Database'] != "performance_schema" && $row['Database'] != "phpmyadmin"){
					?>
				  		<li class="list-group-item">
				  			<input type="radio" class="DatabaseRadio" style="margin-top:5px !important; position:absolute;" name="databasenameradio" id="databasenameradio"
				  			<?php if($_SESSION["DataBaseName"] == $row['Database']){echo(' checked="checked"');}?> data-name="<?php echo($row['Database']);?>" />
				  			<div style="margin-left:20px;"><?php echo($row['Database']);?> </div>
				  		</li>
					<?php $x++;} 
					}	
					?>
				</ul>
				<a class="btn btn-success btn-block" id="DatabaseBTN">Veritabanını Seç</a>
			</div>
		</div>

	</div> 


	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading"><strong><?php echo($_SESSION["DataBaseName"]);?></strong> Veritabanı Tablo Listesi</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<?php
			        $sql = mysql_query("show tables;");
					while ($row = mysql_fetch_row($sql)) {
					?>
					<tr>
						<td><?php echo($row[0]);?></td>
						<td style="width:105px;"><a class="btn btn-success" href="./tablo_detay/<?php echo($row[0]);?>">Tablo Seç</a></td>
					</tr>
					<?php }?>
				</table>
					
			</div>
		</div>
	</div>
<?php }
include('footer.php');
?>
<script>
$(document).ready(function(){
	$('#DatabaseBTN').click(function(){
		database = $('.DatabaseRadio:checked').attr("data-name");
		$.ajax({
			type	: 'POST',
			url		: 'DataBaseCore.php',
			data	: 'name=' + database,
			success : function(r){
				location.reload();
			}
		});
	});	
});
</script>

