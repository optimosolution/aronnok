<?php
/* @var $this LocationController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Locations - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Locations',
);
?>
<br /><br />
<h1>Locations</h1>
<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'template' => '{items}{pager}',
));
?> 
