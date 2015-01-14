<?php
/* @var $this ContentController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = ContentCategory::getCategoryName($_GET['id']) . ' - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Contents',
);
?>
<h1><?php echo ContentCategory::getCategoryName($_GET['id']); ?></h1>
<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'template' => '{items}{pager}',
));
?>  