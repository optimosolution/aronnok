<?php
/* @var $this BookController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Books',
);

$this->menu=array(
	array('label'=>'Create Book','url'=>array('create')),
	array('label'=>'Manage Book','url'=>array('admin')),
);
?>

<h1>Books</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>