<?php
/* @var $this DisciplinaController */
/* @var $model Disciplina */

$this->breadcrumbs=array(
	'Disciplinas'=>array('index'),
	'Sugerir',
);

$this->menu=array(
	array('label'=>'Cancelar', 'url'=>array('index')),
	// array('label'=>'Manage Disciplina', 'url'=>array('admin')),
);
?>

<h1>Sugerir Disciplina</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>