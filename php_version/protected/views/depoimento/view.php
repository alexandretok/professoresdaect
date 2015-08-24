<?php
/* @var $this DepoimentoController */
/* @var $model Depoimento */

$this->breadcrumbs=array(
	'Depoimentos'=>array('index'),
	$model->id_depoimento,
);

$this->menu=array(
	array('label'=>'List Depoimento', 'url'=>array('index')),
	array('label'=>'Create Depoimento', 'url'=>array('create')),
	array('label'=>'Update Depoimento', 'url'=>array('update', 'id'=>$model->id_depoimento)),
	array('label'=>'Delete Depoimento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_depoimento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Depoimento', 'url'=>array('admin')),
);
?>

<h1>View Depoimento #<?php echo $model->id_depoimento; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_depoimento',
		'id_professor',
		'nome',
		'depoimento',
		'aprovado',
		'ip',
	),
)); ?>
