<?php
/* @var $this DepoimentoController */
/* @var $data Depoimento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_depoimento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_depoimento), array('view', 'id'=>$data->id_depoimento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_professor')); ?>:</b>
	<?php echo CHtml::encode($data->id_professor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('depoimento')); ?>:</b>
	<?php echo CHtml::encode($data->depoimento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aprovado')); ?>:</b>
	<?php echo CHtml::encode($data->aprovado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	<?php echo CHtml::encode($data->ip); ?>
	<br />


</div>