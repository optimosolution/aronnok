<?php
/* @var $this LocationController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Resorts - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Resorts',
);
?>
<h1>Resorts</h1>
<div class="row">
    <?php
    $this->widget('bootstrap.widgets.TbListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'template' => '{items}{pager}',
    ));
    ?> 
</div>