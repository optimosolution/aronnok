<?php
/* @var $this ContentController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Map and local attractions - ' . Yii::app()->name;
?>
<br /><br />
<h1>Map and local attractions</h1>
<div class="row">
    <?php
    $this->widget('bootstrap.widgets.TbListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_location',
        'template' => '{items}{pager}',
    ));
    ?>        
</div>