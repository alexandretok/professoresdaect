<?php
/* @var $this DepoimentoController */
/* @var $model Depoimento */

$this->breadcrumbs=array(
	'Depoimentos'=>array('index'),
	$model->id_depoimento=>array('view','id'=>$model->id_depoimento),
	'Update',
);

$this->menu=array(
	array('label'=>'List Depoimento', 'url'=>array('index')),
	array('label'=>'Create Depoimento', 'url'=>array('create')),
	array('label'=>'View Depoimento', 'url'=>array('view', 'id'=>$model->id_depoimento)),
	array('label'=>'Manage Depoimento', 'url'=>array('admin')),
);
?>

<h1>Update Depoimento <?php echo $model->id_depoimento; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>