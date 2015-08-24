<?php
/* @var $this ProfessorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Professors',
);

$this->menu=array(
	array('label'=>'Sugerir um professor', 'url'=>array('create')),
	// array('label'=>'Manage Professor', 'url'=>array('admin')),
);
?>

<h1>Professores</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
