<?php
/* @var $this ContentController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Rooms and Suites - ' . Yii::app()->name;
?>
<br /><br />
<h1>Rooms and Suites</h1>
<div class="row-fluid">
    <?php
    $this->widget('bootstrap.widgets.TbListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_rooms',
        'template' => '{items}{pager}',
    ));
    ?>        
</div>
