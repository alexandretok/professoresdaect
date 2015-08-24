<?php
/* @var $this DisciplinaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Disciplinas',
);

$this->menu=array(
	array('label'=>'Sugerir uma disciplina', 'url'=>array('create')),
	// array('label'=>'Manage Disciplina', 'url'=>array('admin')),
);
?>
<script type="text/javascript">
	$(function(){
		$('.view').click(function(){
			window.location.href = $(this).attr('rel');
		});
	});
</script>
<h1>Disciplinas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
