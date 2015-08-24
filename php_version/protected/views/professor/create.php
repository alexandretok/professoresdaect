<?php
/* @var $this ProfessorController */
/* @var $model Professor */

$this->breadcrumbs=array(
	'Professors'=>array('index'),
	'Sugerir',
);

$this->menu=array(
	array('label'=>'Cancelar', 'url'=>array('index')),
	// array('label'=>'Manage Professor', 'url'=>array('admin')),
);
?>

<h1>Sugerir um professor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>