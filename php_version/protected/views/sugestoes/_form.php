<?php
/* @var $this SugestoesController */
/* @var $model Sugestoes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sugestoes-form',
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->textArea($model,'sugestao',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sugestao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->