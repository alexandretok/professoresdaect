<?php
/* @var $this DisciplinaController */
/* @var $data Disciplina */
?>
<?php if($data->aprovado == 1){ ?>
	
	<div class="view" rel="<?php echo Yii::app()->baseUrl; ?>/disciplina/listarProfessores/<?php echo $data->id_disciplina; ?>">
		
			<?php echo CHtml::encode($data->nome); ?>
			
	</div>
	
<?php } ?>