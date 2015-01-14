<?php
/* @var $this LocationController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Rooms - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Rooms',
);
?>
<br /><br />
<h1>Rooms</h1>
<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_room',
    'template' => '{items}{pager}',
));
?> 
