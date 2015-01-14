<?php
/* @var $this ContentController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Resorts - ' . Yii::app()->name;
?>
<br /><br />
<h1>Resorts</h1>
<div class="row">
    <?php
    $this->widget('bootstrap.widgets.TbListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_resort',
        'template' => '{items}{pager}',
    ));
    ?>        
</div>