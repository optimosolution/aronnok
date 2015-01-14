<?php
/* @var $this ResortController */
/* @var $model Resort */
?>

<?php
$this->pageTitle = $model->title . ' - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Resorts' => array('resort/index'),
    $model->title,
);
?>
<h3><?php echo $model->title; ?></h3>
<div class="row" style="margin-bottom: 20px;">
    <div class="span12">
        <?php echo Room::get_images($model->id); ?>       
    </div>	 
</div>
<div class="row">	 
    <div class="span12">        
        <p><span class="text-success"><strong>Location:</strong> <?php echo CHtml::link(Location::getLocation($model->location), array('location/view', 'id' => $model->location), array('target' => '_blank')); ?></span></p>
        <p><span class="text-success"><strong>Resort:</strong> <?php echo CHtml::link(Resort::getResort($model->resort), array('resort/view', 'id' => $model->resort), array('target' => '_blank')); ?></span></p>
        <p><span class="text-error">BDT <?php echo number_format($model->rent, 2, '.', ''); ?> </span> <span class="text-info">per night</span></p>       
        <p><?php echo $model->details; ?></p>
    </div>
</div>
<div class="row">
    <div class="span10"></div>
    <div class="span2">
        <?php echo CHtml::link('Book Now!', array('reservation/index'), array('class' => 'btn btn-primary btn-large check-availability')); ?>
    </div>
</div>