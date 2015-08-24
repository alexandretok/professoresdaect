<?php
/* @var $this DepoimentoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Depoimentos',
);

$this->menu=array(
	array('label'=>'Create Depoimento', 'url'=>array('create')),
	array('label'=>'Manage Depoimento', 'url'=>array('admin')),
);
?>

<h1>Depoimentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
