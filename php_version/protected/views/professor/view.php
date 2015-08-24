<?php /* @var $professor Professor */ ?>
<?php /* @var $media int */ ?>
<?php /* @var $depoimentos Depoimento */ ?>
<?php /* @var $depoimento Depoimento */ ?>
<?php /* @var $ensina Disciplina */ ?>
<?php /* @var $disciplina Disciplina */ ?>
<script type="text/javascript">
	$(function () {
		$('.star').click(function () {
			var nota = 'nota=' + this.id + '&id_professor=<?php echo $professor->id_professor; ?>';
			$.ajax('<?php echo Yii::app()->baseUrl; ?>/voto/computar/', {
				data: nota,
				type: 'post',
				success: function (data) {
					if (data == 'OK') { // Voto computado
						$('#status-voto').attr('src', "<?php echo Yii::app()->baseUrl; ?>/img/success.png");
						$('#status-voto').attr('title', "Voto computado");
						$('#status-voto').show();
					}
					if (data == 'PROIBIDO') { // Já votou
						$('#status-voto').attr('src', "<?php echo Yii::app()->baseUrl; ?>/img/ofensivo.gif");
						$('#status-voto').attr('title', "Apenas um voto por aluno");
						$('#status-voto').show();
					}
				},
			});
		});

		$('#edit-profile').submit(function(){
			if($('#depoimento').val().length <= 10){
				$('#validation').html('Digite no mínimo 10 caracteres!');
				$('#validation').show();

				return false;
			}
		});

		$('.gostei').click(function(){
			var id_depoimento = this.id.replace("g", "");
			var nota = 'id_depoimento=' + id_depoimento;
			$.ajax('<?php echo Yii::app()->baseUrl; ?>/depoimento/gostei/',{
				data : nota,
				type: 'post',
				success: function(data){
					if(data == 'OK'){ // Voto computado
						var atual = $('#qtdg'+id_depoimento).text();
						$('#g'+id_depoimento).fadeOut(300);
						var t = setTimeout(function(){
							$('#qtdg'+id_depoimento).text(parseInt(atual) + 1);
							$('#g'+id_depoimento).fadeIn(1000);
						}, 300);
					}else{
						$('#jaOpinou'+id_depoimento).show();
					}
				}
			});
			return false;
		});

		$('.naogostei').click(function(){
			var id_depoimento = this.id.replace("n", "");
			var nota = 'id_depoimento=' + id_depoimento;
			$.ajax('<?php echo Yii::app()->baseUrl; ?>/depoimento/naogostei/',{
				data : nota,
				type: 'post',
				success: function(data){
					if(data == 'OK'){ // Voto computado
						var atual = $('#qtdn'+id_depoimento).text();
						$('#n'+id_depoimento).fadeOut(300);
						var t = setTimeout(function(){
							$('#qtdn'+id_depoimento).text(parseInt(atual) + 1);
							$('#n'+id_depoimento).fadeIn(1000);
						}, 300);
					}else{
						$('#jaOpinou'+id_depoimento).show();
					}
				}
			});
			return false;
		});

		$('#anonimo').change(function(){
			if(typeof $('#anonimo').attr('checked') !== 'undefined'){
				$('#nome').val('');
				$('#nome').attr('disabled', 'disabled');
			}else{
				$('#nome').removeAttr('disabled');
			}
		});

		$('#div-votos').tooltip();
	});
</script>
<style>
	.rating-cancel {
		display: none !important;
	}
</style>
<div class="span6">
	<div class="widget">
		<div class="widget-header"><i class="icon-user"></i>

			<h3><?php echo $professor->nome; ?></h3>
		</div>
		<!-- /widget-header -->
		<div class="widget-content">
			<!-- /shortcuts -->
			<div style="display: table-cell;padding-right: 10px;">
				<img class="img-prof"
					 src="<?php echo Yii::app()->baseUrl; ?>/img/professores/<?php echo empty($professor->foto) ? "../semfoto.jpg" : $professor->foto; ?>">

				<div style="text-align: center;cursor: pointer;" id="div-votos" title="<?php echo $qtdVotos; ?> votos">
					<i class="icon-star"></i>
					<?php echo $media; ?>
				</div>
			</div>
			<div style="display: table-cell;vertical-align: top;">
				<?php foreach($ensina as $disciplina) {
					$disciplina = Disciplina::model()->findByPk($disciplina->id_disciplina);
					echo "<div><i class='icon-book'></i> $disciplina->nome</div>";
				}
				?>
			</div>
			<div>
				Votar: <img width="16px" height="16px" style="display: none;" id="status-voto">

				<div class="estrelas">
					<input type="radio" name="star" class="star" id="1"/>
					<input type="radio" name="star" class="star" id="2"/>
					<input type="radio" name="star" class="star" id="3"/>
					<input type="radio" name="star" class="star" id="4"/>
					<input type="radio" name="star" class="star" id="5"/>
				</div>
			</div>
		</div>
		<!-- /widget-content -->

	</div>
	<!-- /widget -->
</div>

<div class="span5">
	<div class="widget">
		<div class="widget-header"><i class="icon-pencil"></i>

			<h3>Escrever Depoimento</h3>
		</div>
		<!-- /widget-header -->
		<div class="widget-content">
			<form method="post" class="form-horizontal" id="edit-profile" action="<?php echo Yii::app()->baseUrl; ?>/depoimento/novo">
				<input type="hidden" name="Depoimento[id_professor]" value="<?php echo $professor->id_professor; ?>">
				<fieldset>

					<div class="control-group">
						<label for="nome" class="control-label">Nome:</label>

						<div class="controls">
							<input type="input" name="Depoimento[nome]" id="nome" class="span2">
							<label class="checkbox inline">
								<input type="checkbox" id="anonimo"> Anônimo
							</label>
						</div>
						<!-- /controls -->
					</div>
					<div class="control-group">
						<label for="id_disciplina" class="control-label">Disciplina que cursou:</label>

						<div class="controls">
							<select id="id_disciplina" name="Depoimento[id_disciplina]" class="span3">
								<option value="">Não desejo informar</option>
								<?php

								foreach($ensina as $disciplina) {
									$disciplina = Disciplina::model()->findByPk($disciplina->id_disciplina);
									echo "<option value='$disciplina->id_disciplina'>$disciplina->nome</option>";
								}


								?>
							</select>
						</div>
						<!-- /controls -->
					</div>
					<div class="control-group">
						<label for="depoimento" class="control-label">Depoimento:</label>

						<div class="controls">
							<textarea name="Depoimento[depoimento]" id="depoimento" class="span3"
								   rows="5"></textarea>
						</div>
					</div>
					<div class="alert" id="validation" style="display: none;"></div>
					<?php if(Yii::app()->user->hasFlash('success')): ?>
						<div class="alert"><?php echo Yii::app()->user->getFlash('success'); ?></div>
					<?php endif; ?>
					<!-- /control-group -->
					<div class="form-actions" style="background-color: inherit;border-top: 0px">
						<button class="btn btn-primary" type="submit">Enviar Depoimento</button>
					</div>
				</fieldset>
			</form>
		</div>
		<!-- /widget-content -->

	</div>
	<!-- /widget -->
</div>

<div class="span12">
	<div class="widget">
		<div class="widget-header"><i class="icon-comments"></i>

			<h3>Depoimentos</h3>
		</div>
		<!-- /widget-header -->
		<div class="widget-content">
			<!-- /shortcuts -->
			<ul class="messages_layout">
				<?php foreach($depoimentos as $depoimento) { ?>
				<li>
					<div class="message_wrap"> <span class="arrow"></span>
						<div class="info"> <a class="name"><b>Enviado por: <?php echo $depoimento->nome ?></a> <span class="time" style="margin-left: 20px;font-size: 13px;"> Disciplina: <?php echo empty($depoimento->id_disciplina) ? "Não informada" : $depoimento->disciplina->nome; ?></span></b>
						</div>
						<div class="text" style="margin-bottom: 20px;"> <?php echo $depoimento->depoimento; ?> </div>
						<div>
							<a class="gostei" id="g<?php echo $depoimento->id_depoimento; ?>" style="color: #0f9b00; margin-right: 40px;" href="#"><i class=" icon-thumbs-up icon-large"></i> Concordo! (<span id="qtdg<?php echo $depoimento->id_depoimento; ?>"><?php echo $depoimento->up; ?></span>)</a>
							<a class="naogostei" id="n<?php echo $depoimento->id_depoimento; ?>" style="color: #b50000;" href="#"><i class=" icon-thumbs-down icon-large"></i> Discordo! (<span id="qtdn<?php echo $depoimento->id_depoimento; ?>"><?php echo $depoimento->down; ?></span>)</a>
							<span id="jaOpinou<?php echo $depoimento->id_depoimento; ?>" style="margin-left: 40px; display: none;" class="alert">Você já deu sua opinião sobre esse depoimento.</span>
						</div>

					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
		<!-- /widget-content -->

	</div>
	<!-- /widget -->
</div>