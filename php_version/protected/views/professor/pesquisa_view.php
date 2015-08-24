<?php /* @var $professor Professor */ ?>
<div class="widget-content span4" style="height: 240px;margin-bottom: 10px">
	<ul class="messages_layout">
		<li class="from_user left"> <a class="avatar" href="#"><img style="width: 70px; max-height: 100px" src="<?php echo Yii::app()->baseUrl; ?>/img/professores/<?php echo empty($professor->foto) ? "../semfoto.jpg" : $professor->foto; ?>"></a>
			<div class="message_wrap"> <span class="arrow"></span>
				<div class="info"> <a class="name"><?php echo $professor->nome; ?></a><br/><span class="time"><i class="icon-star"> <?php echo $media; ?></i></span>
				</div>
				<div class="text"> <?php echo is_null($depoimento) ? "<div class='alert'>Nenhum depoimento enviado.</div>" : (strlen($depoimento->depoimento) > 200 ? substr($depoimento->depoimento, 0 ,200) . "..." : $depoimento->depoimento); ?> </div>
			</div>
			<a class="btn btn-info" href="<?php echo Yii::app()->baseUrl; ?>/professor/<?php echo $professor->id_professor; ?>/<?php echo URLify::filter($professor->nome); ?>">Detalhes</a>
		</li>
	</ul>
</div>