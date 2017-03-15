<?php include_once 'config.php';?>
<?php include('header.php');?>
<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-default">
  			<div class="panel-heading"><?php echo($request[2])?> - Tablo İçeriği</div>
  			<div class="panel-body">
				<div class="row">
					<div class="col-sm-6">
						<a id="Listehepsinisec" class="btn btn-success">Hepsini Seç</a>
						<a id="Listevazgec" class="btn btn-danger">Vazgeç</a>
					</div>
					<div class="com-sm-6 text-right">
						<div class="btn-group" role="group" style="margin-right:15px;">
    						<button type="button" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      							İşlemler
      							<span class="caret"></span>
    						</button>
						    <ul class="dropdown-menu">
						      	<li><a id="SelectBTN" data-process="select" class="IslemBTN">SELECT</a></li>
						      	<li role="separator" class="divider"></li>
						      	<li><a id="InsertBTN" data-process="insert" class="IslemBTN">INSERT</a></li>
  								<li><a id="UpdateBTN" data-process="update" class="IslemBTN">UPDATE</a></li>
  								<li><a id="DeleteBTN">DELETE</a></li>
  								<li role="separator" class="divider"></li>
  								<li><a id="FormNEWBTN">FORM NEW</a></li>
  								<li><a id="FormUpdateBTN">FORM UPDATE</a></li>
  								<li><a id="FormCoreBTN">CORE</a></li>
						    </ul>
  						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<hr>
  				<table class="table">
				<?php $sql = mysql_query("SHOW COLUMNS FROM " . $request[2]);
				while ($row = mysql_fetch_array($sql)) {
				?>
					<tr id="table_<?php echo( $row[0] );?>">
						<td style="width: 15px;"><input type="checkbox" class="ListeCheckbox" id="<?php echo( $row[0] );?>" data-name="<?php echo( $row[0] );?>" ></td>
						<td><?php echo( $row[0] );?></td>
						<td style="width: 100px;">
							<select class="form-control input-sm SelectedBTN" data-name="<?php echo( $row[0] );?>">
								<option value="Text"> Text</option>
								<option value="Select">Select</option>
								<option value="Textarea">Textarea</option>
								<option value="Checkbox">Checkbox</option>
								<option value="Radio">Radio</option>
							</select>
						</td>
						<td style="width: 170px;" id="table_tr_<?php echo( $row[0] );?>">
							
						</td>
						<td>
							<input type="checkbox" class="zorunlu" data-name="<?php echo( $row[0] );?>" value="<?php echo( $row[0] );?>"> Zorunlu Alan
						</td>
					</tr>
				<?php }?>
				</table>
				
			</div>
		</div>
	</div>
	
	
	<div class="col-sm-6" id="IslemCiktisi">
	
	</div>
	
</div>

<script>
$(document).ready(function(){

	$('#FormCoreBTN').click(function(){
		data   = "";
		if($('.ListeCheckbox:checked').length != 0){
			$('.ListeCheckbox').each(function(i){
				id 		= $(this).attr("id");
				checked = $(this).prop("checked");
				if( checked == true ){
					if(data == ""){
						data = id;
					}else{
						data = data + ',' + id;
					}
				}
			});
			
			$.ajax({
				type	: 'POST',
				url		: 'modul_<?php echo($MysqlType);?>/core_output.php' ,
				data	: 'table=<?php echo($request[2]);?>&data=' + data,
				success : function(e){
					console.log( e );
					$('#IslemCiktisi').html(e);
				}
			});
		}else{
			alert('Lütfen tablo içeriği seçiniz.');
		}
	});

	

	$('.SelectedBTN').change(function(){
		id  = $(this).attr('data-name');
		val = $(this).val();
		html = "";
		if( val == "Select"){
			$.ajax({
				type	: 'POST',
				url		: 'tablo_list.php',
				success : function(r){
					$('#table_tr_' + id).html(r);
				}
			});
		}else{
			$('#table_tr_' + id).html('');
		}
	});

	$('#FormUpdateBTN').click(function(){
		data = "";
		select = "";
		zrn     = "";
		if($('.ListeCheckbox:checked').length != 0){
			$('.ListeCheckbox').each(function(i){
				id 		= $(this).attr("id");
				checked = $(this).prop("checked");
				sel     = $('#table_' + id + ' select option:selected').val();
				if( checked == true ){
					
					
					
					if(data == ""){
						data 	= id;
						select 	= sel

						if(sel == "Select"){
							ss  = $('#table_tr_' + id + ' select option:selected').val();
							sql = ss;
						}else{
							ss  = $('#table_tr_' + id + ' select option:selected').val();
							sql = '';
						}
					}else{
						data 	= data + ',' + id;
						select 	= select + ',' + sel;

						if(sel == "Select"){
							ss  = $('#table_tr_' + id + ' select option:selected').val();
							sql = sql + ',' + ss;
						}else{
							ss  = $('#table_tr_' + id + ' select option:selected').val();
							sql = sql + ',';
						}
					}

					zorunlu = $('.zorunlu').eq(i).prop("checked");
					if(zorunlu == true ){
						zrn = zrn + ',' + $('.zorunlu').eq(i).attr("data-name") + ':1'
					}else{
						zrn = zrn + ',' + $('.zorunlu').eq(i).attr("data-name") + ':0'
					}
				}

			});

			$.ajax({
				type	: 'POST',
				url		: 'modul_<?php echo($MysqlType);?>/form_update_output.php',
				data	: 'table=<?php echo($request[2]);?>&data=' + data + '&select=' + select + '&sql=' + sql + '&zrn=' + zrn,
				success : function(e){
					$('#IslemCiktisi').html(e);
				}
			});
			
		}else{
			alert('Lütfen tablo içeriği seçiniz.');
		}
	});
	
	$('#FormNEWBTN').click(function(){
		data   = "";
		select = "";
		sql    = "";
		zrn    = "";
		if($('.ListeCheckbox:checked').length != 0){
			$('.ListeCheckbox').each(function(i){
				id 		= $(this).attr("id");
				checked = $(this).prop("checked");
				sel     = $('#table_' + id + ' select option:selected').val();
				if( checked == true ){
					
					
					
					if(data == ""){
						data 	= id;
						select 	= sel

						if(sel == "Select"){
							ss  = $('#table_tr_' + id + ' select option:selected').val();
							sql = ss;
						}else{
							ss  = $('#table_tr_' + id + ' select option:selected').val();
							sql = '';
						}
					}else{
						data 	= data + ',' + id;
						select 	= select + ',' + sel;

						if(sel == "Select"){
							ss  = $('#table_tr_' + id + ' select option:selected').val();
							sql = sql + ',' + ss;
						}else{
							ss  = $('#table_tr_' + id + ' select option:selected').val();
							sql = sql + ',';
						}
					}

					zorunlu = $('.zorunlu').eq(i).prop("checked");
					if(zorunlu == true ){
						zrn = zrn + ',' + $('.zorunlu').eq(i).attr("data-name") + ':1'
					}else{
						zrn = zrn + ',' + $('.zorunlu').eq(i).attr("data-name") + ':0'
					}
				}
			});

			
			$.ajax({
				type	: 'POST',
				url		: 'modul_<?php echo($MysqlType);?>/form_new_output.php',
				data	: 'table=<?php echo($request[2]);?>&data=' + data + '&select=' + select + '&sql=' + sql + '&zrn=' + zrn,
				success : function(e){
					$('#IslemCiktisi').html(e);
				}
			});
			
		}else{
			alert('Lütfen tablo içeriği seçiniz.');
		}
	});
	
	$('.IslemBTN').click(function(){
		process = $(this).attr("data-process");
		url     = 'modul_<?php echo($MysqlType);?>/' + process + '_output.php';
		console.log( url );
		data = "";
		
		if($('.ListeCheckbox:checked').length != 0){
			$('.ListeCheckbox').each(function(i){
				id 		= $(this).attr("id");
				checked = $(this).prop("checked");
				if( checked == true ){
					if(data == ""){
						data = id;
					}else{
						data = data + ',' + id;
					}
				}
			});
			
			$.ajax({
				type	: 'POST',
				url		: url ,
				data	: 'table=<?php echo($request[2]);?>&data=' + data,
				success : function(e){
					$('#IslemCiktisi').html(e);
				}
			});
		}else{
			alert('Lütfen tablo içeriği seçiniz.');
		}
		
		
	});

	$('#DeleteBTN').click(function(){
		$.ajax({
			type	: 'POST',
			url		: 'modul_<?php echo($MysqlType);?>/delete_output.php',
			data	: 'table=<?php echo($request[2]);?>' ,
			success : function(e){
				$('#IslemCiktisi').html(e);
			}
		});
	});

	
	$('#Listehepsinisec').click(function(){
		$('.ListeCheckbox').each(function(i){
			$(this).prop('checked',true );
		});
	});
	$('#Listevazgec').click(function(){
		$('.ListeCheckbox').each(function(i){
			$(this).prop('checked',false);
		});
	});
});
</script>
  
<?php include('footer.php');?>
