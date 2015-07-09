<?php
/* @var $this DepoimentoController */
/* @var $model Depoimento */

$this->breadcrumbs=array(
	'Depoimentos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Depoimento', 'url'=>array('index')),
	array('label'=>'Manage Depoimento', 'url'=>array('admin')),
);
?>

<h1>Create Depoimento</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>