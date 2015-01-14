<?php
$this->pageTitle = $model->location . ' - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Resorts' => array('resort/index'),
    $model->location,
);
?>
<h3><?php echo $model->location; ?></h3>
<div class="row" style="margin-bottom: 20px;">
    <div class="span12">
        <?php echo Location::get_images($model->id); ?>       
    </div>	 
</div>
<div class="row">	 
    <div class="span12">        
        <p><?php echo $model->details; ?></p>
        <p><?php echo $model->map; ?></p>
    </div>
</div>
<div class="row">
    <div class="span10"></div>
    <div class="span2">
        <?php echo CHtml::link('Book Now!', array('reservation/index'), array('class' => 'btn btn-primary btn-large check-availability')); ?>
    </div>
</div>