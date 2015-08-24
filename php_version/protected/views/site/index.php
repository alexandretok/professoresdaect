<?php /* @var $this CController */ ?>
<script type="text/javascript">
	$(function(){
		var lastLength = 0;
		var lastSearch;
		var timer;
		$('#nome').keyup(function(){
			if($('#nome').val().length > 2){
				$('.loading').remove();
				$('.control-group').append('<img style="float: right; margin: 20px 20px 0 0;" src="<?php echo Yii::app()->baseUrl; ?>/img/loading.gif" class="loading">');
				lastLength = $('#nome').val().length;
				clearTimeout(timer);
				timer = 0;
				timer = setTimeout(function(){
					if($('#nome').val().length == lastLength && lastSearch != $('#nome').val()){
						lastSearch = $('#nome').val();
						$.ajax("<?php echo Yii::app()->baseUrl; ?>/professor/pesquisa/search/"+$('#nome').val(), {
							success: function (data){
								$('.resultado-pesquisa').html(data);
								$('.loading').remove();
							}
						});
					}
				}, 500);
			}else
				$('.loading').remove();
		});
		$('#edit-profile').submit(function(){
			$('#nome').keyup();
			return false;
		});
	});
</script>
<div class="row">
<div class="span6">
	<div class="widget widget-nopad">
		<div class="widget-header"> <i class="icon-user"></i>
			<h3> Pesquisar Por Professor</h3>
		</div>
		<!-- /widget-header -->
		<div class="widget-content">
			<form class="form-horizontal" id="edit-profile">
				<fieldset>
					<br>
					<div class="control-group">
						<label for="nome" class="control-label">Nome:</label>
						<div class="controls">
							<input type="text" autofocus id="nome" name="nome" class="span4">
						</div> <!-- /controls -->
					</div> <!-- /control-group -->
				</fieldset>
			</form>
		</div>
	</div>
	<!-- /widget -->
</div>
	</div>
	<!-- /row -->
		<div class="row resultado-pesquisa">

			<!-- /widget-content -->

		</div>