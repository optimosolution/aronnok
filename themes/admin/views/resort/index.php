<?php
/* @var $this ResortController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Resorts',
);

$this->menu=array(
	array('label'=>'Create Resort','url'=>array('create')),
	array('label'=>'Manage Resort','url'=>array('admin')),
);
?>

<h1>Resorts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>