<?php
/* @var $this DepoimentoController */
/* @var $model Depoimento */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'depoimento-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_depoimento'); ?>
		<?php echo $form->textField($model,'id_depoimento'); ?>
		<?php echo $form->error($model,'id_depoimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_professor'); ?>
		<?php echo $form->textField($model,'id_professor'); ?>
		<?php echo $form->error($model,'id_professor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'depoimento'); ?>
		<?php echo $form->textArea($model,'depoimento',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'depoimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aprovado'); ?>
		<?php echo $form->textField($model,'aprovado'); ?>
		<?php echo $form->error($model,'aprovado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->