<?php /* @var $this CController */ ?>
<?php /* @var $professores Professor */ ?>
<?php /* @var $professor Professor */ ?>

<div class="widget-header"> <i class="icon-group"></i>
	<h3> Professores Encontrados</h3>
</div>


<?php
$i = 0;
if(count($professores) == 0)
	echo "<div class='alert'><b><h4>Nenhum professor encontrado.</h4></b></div>";

foreach($professores as $key => $professor) { ?>
		<?php if($i == 0): ?>
			<div class="span12">
		<?php endif; ?>

		<?php
			$depoimentosMaisRelevante = Depoimento::model()->findByAttributes(array('id_professor' => $professor->id_professor), array('order' => 'up DESC'));
			$mediaVotos = floor(Voto::model()->model()->findBySql("SELECT AVG(voto) as voto FROM voto WHERE id_professor = '$professor->id_professor'")->attributes['voto'] * 100) / 100;
	$this->renderPartial('pesquisa_view', array('professor'=>$professor, 'depoimento' => $depoimentosMaisRelevante, 'media' => $mediaVotos));
		?>
	<?php if($i == 1): $i=-1; ?>
			</div>
		<?php endif; ?>
	<?php $i++; ?>
<?php } ?>