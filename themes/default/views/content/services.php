<?php
/* @var $this ContentController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Facilities & Services - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Facilities & Services',
);
?>
<h1>Facilities & Services</h1>
<div class="row">
    <?php
    $this->widget('bootstrap.widgets.TbListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_services',
        'template' => '{items}{pager}',
    ));
    ?>        
</div>
