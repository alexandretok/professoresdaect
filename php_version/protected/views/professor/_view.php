<?php
/* @var $this ProfessorController */
/* @var $data Professor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_professor')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_professor), array('view', 'id'=>$data->id_professor)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aprovado')); ?>:</b>
	<?php echo CHtml::encode($data->aprovado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('foto')); ?>:</b>
	<?php echo CHtml::encode($data->foto); ?>
	<br />


</div>