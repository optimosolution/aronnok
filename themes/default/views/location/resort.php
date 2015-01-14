<?php
/* @var $this LocationController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Resorts - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Resorts',
);
?>
<br /><br />
<h1>Resorts, Location: <?php echo Location::getLocation($_GET['id']); ?></h1>
<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_resort',
    'template' => '{items}{pager}',
));
?> 
