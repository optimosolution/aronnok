<?php
/* @var $this ContentController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Frequently Asked Questions (FAQ) - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Frequently Asked Questions (FAQ)',
);
?>
<h1>Frequently Asked Questions (FAQ)</h1>
<div class="row-fluid">
    <div class="span12">
        <?php
        $this->widget('bootstrap.widgets.TbListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_faq',
            'template' => '{items}{pager}',
        ));
        ?> 
    </div>           
</div>
