<?php
/* @var $this DisciplinaController */
/* @var $model Disciplina */

$this->breadcrumbs=array(
	'Disciplinas'=>array('index'),
	$model->id_disciplina=>array('view','id'=>$model->id_disciplina),
	'Update',
);

$this->menu=array(
	array('label'=>'List Disciplina', 'url'=>array('index')),
	array('label'=>'Create Disciplina', 'url'=>array('create')),
	array('label'=>'View Disciplina', 'url'=>array('view', 'id'=>$model->id_disciplina)),
	array('label'=>'Manage Disciplina', 'url'=>array('admin')),
);
?>

<h1>Update Disciplina <?php echo $model->id_disciplina; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>