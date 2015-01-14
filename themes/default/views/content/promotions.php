<?php
/* @var $this ContentController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Special offers - ' . Yii::app()->name;
?>
<br /><br />
<h1>Special offers</h1>
<div class="row">
        <?php
        $this->widget('bootstrap.widgets.TbListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_promotions',
            'template' => '{items}{pager}',
        ));
        ?>
</div>