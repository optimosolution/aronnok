<?php
$this->pageTitle = $model->title . ' - ' . Yii::app()->name;
$this->breadcrumbs = array(
    $model->title,
);
?>
<h1><?php echo $model->title; ?></h1>
<p>    
    <?php echo Content::get_images($model->id); ?>
    <?php echo $model->introtext; ?>
</p>
